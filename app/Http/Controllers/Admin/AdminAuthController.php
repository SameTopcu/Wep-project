<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function forget_password(){
        return view('admin.forget-password');
    }

    public function reset_password(){
        return view('admin.reset-password');
    }
}




