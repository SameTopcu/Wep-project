<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;

class AdminAuthController extends Controller
{
    public function login()
    {
        return view('admin.login');
    }

    public function login_submit(Request $request){
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ], [
            'email.required' => 'Email adresi gereklidir.',
            'email.email' => 'Geçerli bir email adresi giriniz.',
            'password.required' => 'Şifre gereklidir.',
        ]);
    
        $data = [
            'email' => $request->email,
            'password' => $request->password
        ];
    
        if(Auth::guard('admin')->attempt($data)) {
            return redirect()->route('admin_dashboard')->with('success', 'Giriş başarılı!');
        } else {
            return redirect()->route('admin_login')->with('error','Girdiğiniz bilgiler hatalı! Lütfen tekrar deneyiniz!');
        } 
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin_login')->with('success','Logout is successful!');
    }
    public function profile(){
        return view('admin.profile');
    }

    public function profile_submit(Request $request) {
        $admin = Admin::where('email', Auth::guard('admin')->user()->email)->first();
    
        $request->validate([
            'name' => 'required',
            'email' => 'required|email'
        ]);
    
        // Şifre değiştirilmek isteniyorsa
        if($request->password != '') {
            $request->validate([
                'password' => 'required',
                'confirm_password' => 'required|same:password'
            ]);
            $admin->password = Hash::make($request->password);
        }
    
        // Fotoğraf yükleme işlemi (Eğer dosya seçildiyse)
        if($request->hasFile('photo')) {
            $request->validate([
                'photo' => 'image|mimes:jpg,jpeg,png,gif'
            ]);
    
            // Eski fotoğrafı klasörden silme (Opsiyonel ama temizlik iyidir)
            if($admin->photo && file_exists(public_path('uploads/'.$admin->photo))) {
                unlink(public_path('uploads/'.$admin->photo));
            }
    
            $ext = $request->file('photo')->extension();
            $final_name = 'admin_'.time().'.'.$ext;
            $request->file('photo')->move(public_path('uploads/'), $final_name);
            $admin->photo = $final_name;
        }
    
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->update();
        Auth::guard('admin')->setUser($admin);
        return redirect()->back()->with('success', 'Profil bilgileriniz başarıyla güncellendi.');
    }

    public function forget_password(){
        return view('admin.forget-password');
    }
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        $admin = Admin::where('email',$request->email)->first();
        if(!$admin) {
            return redirect()->back()->with('error','Email is not found');
        }
    
        $token = hash('sha256',time());
        $admin->token = $token;
        $admin->update();
    
        $reset_link = url('admin/reset-password/'.$token.'/'.$request->email);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";
    
        Mail::to($request->email)->send(new Websitemail($subject,$message));
    
        return redirect()->back()->with('success','We have sent a password reset link to your email. Please check your email. If you do not find the email in your inbox, please check your spam folder.');
    }


    public function reset_password(string $token, string $email){
        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Invalid or expired reset link.');
        }

        return view('admin.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, string $token, string $email)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'confirm_password' => ['required', 'same:password'],
        ], [
            'password.required' => 'Şifre gereklidir.',
            'confirm_password.required' => 'Şifre doğrulama gereklidir.',
            'confirm_password.same' => 'Şifreler uyuşmuyor.',
        ]);

        $admin = Admin::where('email', $email)->where('token', $token)->first();
        if (!$admin) {
            return redirect()->route('admin_login')->with('error', 'Invalid or expired reset link.');
        }

        $admin->password = Hash::make($request->password);
        $admin->token = null;
        $admin->save();

        return redirect()->route('admin_login')->with('success', 'Şifreniz başarıyla güncellendi. Giriş yapabilirsiniz.');
    }
}




