<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\Websitemail;
use Illuminate\Support\Facades\Auth;
use App\Models\Slider;
use App\Models\WelcomeItem;
class Frontcontroller extends Controller
{
    public function home(){
        $sliders = Slider::get();
        $welcome_item = WelcomeItem::where('id', 1)->first();
        return view("front.home",compact('sliders','welcome_item'));
    }

    public function about(){
        $welcome_item = WelcomeItem::where('id',1)->first();
        return view("front.about",compact('welcome_item'));
    }

    public function registration(){
        return view("front.registration");
    }

    public function registration_submit(Request $request) {
        // 1. Validasyon: Email'in benzersiz (unique) olduğunu kontrol et
        $request->validate([
            "name" => "required",
            "email" => "required|email|unique:users,email",
            "password" => "required|min:6",
            "retype_password" => "required|same:password",
        ], [
            // Türkçe hata mesajları (İsteğe bağlı)
            "email.unique" => "Bu email adresi zaten sistemde kayıtlı.",
            "retype_password.same" => "Şifreler birbiriyle uyuşmuyor."
        ]);
    
        // 2. Güvenli Token Oluşturma
        $token = hash('sha256', time());
    
        // 3. Kullanıcı Kaydı
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password); // bcrypt yerine Hash::make daha standarttır
        $user->token = $token;
        $user->status = 0; // Kullanıcıyı başlangıçta onaylanmamış (pasif) yapıyoruz
        $user->save();
    
        // 4. Doğrulama Linki Oluşturma
        // Not: web.php dosyasında bu rotanın parametrelerini kontrol etmelisin
        $verification_link = route('registration_verify', ['email' => $request->email, 'token' => $token]);
    
        // 5. E-posta Gönderimi
        $subject = "User Account Verification";
        $message = 'Please click the following link to verify your email address:<br>';
        $message .= '<a href="'.$verification_link.'">Verify Email</a>';
    
        try {
            Mail::to($request->email)->send(new Websitemail($subject, $message));
        } catch (\Exception $e) {
            // Mail gitmezse kullanıcıyı bilgilendirebilir veya kaydı silebilirsin
            return redirect()->back()->with('error', 'Mail gönderilirken bir sorun oluştu.');
        }
    
        return redirect()->route('login')->with('success', 'Registration is successful, but you have to verify your address to login so please check your email to confirm the verification link.');
    }
    public function registration_verify($email,$token){
         $user = User::where('token',$token)->where('email',$email)->first();
         if(!$user) {
             return redirect()->route('login');
         }
         $user->token = '';
         $user->status = 1;
         $user->update();
     
         return redirect()->route('login')->with('success', 'Your email is verified. You can login now.');
    }
    public function login(){
        return view ("front.login");
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
            'password' => $request->password,
            'status'=>1,
        ];
    
        if(Auth::guard('web')->attempt($data)) {
            return redirect()->route('user_dashboard')->with('success', 'Giriş başarılı!');
        } else {
            return redirect()->route('login')->with('error','Girdiğiniz bilgiler hatalı! Lütfen tekrar deneyiniz!')->withInput();

        } 
    }


    public function logout(){
        Auth::guard('web')->logout();
        return redirect()->route('login')->with('success','Logout is successfull');
    }

    public function forget_password(){
        return view('front.forget-password');
    }
    public function forget_password_submit(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);
    
        $user = User::where('email',$request->email)->first();
        if(!$user) {
            return redirect()->back()->with('error','Email is not found');
        }
    
        $token = hash('sha256',time());
        $user->token = $token;
        $user->update();
    
        $reset_link=route('reset_password',['token'=> $token,'email'=>$request->email]);
        $subject = "Password Reset";
        $message = "To reset password, please click on the link below:<br>";
        $message .= "<a href='".$reset_link."'>Click Here</a>";
    
        Mail::to($request->email)->send(new Websitemail($subject,$message));
    
        return redirect()->back()->with('success','We have sent a password reset link to your email. Please check your email.');
    }


    public function reset_password(string $token, string $email){
        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Invalid or expired reset link.');
        }

        return view('front.reset-password', compact('token', 'email'));
    }

    public function reset_password_submit(Request $request, string $token, string $email)
    {
        $request->validate([
            'password' => ['required', 'min:6'],
            'retype_password' => ['required', 'same:password'],
        ], [
            'password.required' => 'Şifre gereklidir.',
            'confirm_password.required' => 'Şifre doğrulama gereklidir.',
            'confirm_password.same' => 'Şifreler uyuşmuyor.',
        ]);

        $user = User::where('email', $email)->where('token', $token)->first();
        if (!$user) {
            return redirect()->route('login')->with('error', 'Geçersiz veya süresi dolmuş link.');
        }
    
        // DÜZELTME: Hash::make() KALDIRILDI.
        // User modelindeki 'casts' özelliği bunu otomatik şifreleyecek.
        $user->password = $request->password; 
        
        $user->token = ''; 
        $user->save();
    
        return redirect()->route('login')->with('success', 'Şifreniz başarıyla güncellendi. Giriş yapabilirsiniz.');
}

}