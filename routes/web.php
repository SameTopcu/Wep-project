<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;


Route::get('/',[FrontController::class,'home'])->name('home');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/registration',[FrontController::class,'registration'])->name('registration');
Route::get('/login',[FrontController::class,'login'])->name('login');
Route::post('/login',[FrontController::class,'login_submit'])->name('login_submit');

Route::get('/forget-password',[FrontController::class,'forget_password'])->name('forget_password');
Route::post('/forget_password',action: [FrontController::class,'forget_password_submit'])->name('forget_password_submit');

Route::get('/reset-password/{token}/{email}',[FrontController::class,'reset_password'])->name('reset_password');
Route::post('/reset-password/{token}/{email}',[FrontController::class,'reset_password_submit'])->name('reset_password_submit');


Route::post('/registration',[FrontController::class,'registration_submit'])->name('registration_submit');
Route::get('/registration-verify-email/{email}/{token}', action: [FrontController::class, 'registration_verify'])->name('registration_verify');
Route::get('/logout', [FrontController::class,'logout'])->name('logout');


// User
// User
Route::middleware('auth')->prefix('user')->group(function () { 
    Route::get('/dashboard',[UserController::class,'dashboard'])->name('user_dashboard');
    Route::get('/logout', [UserController::class, 'logout'])->name('user_logout');
    
    // 1. Profil Sayfasını Görme (GET)
    Route::get('/profile', [UserController::class,'profile'])->name('user_profile');
    
    // 2. Profili Kaydetme (POST) - Adres veya Method farklı olmalı
    Route::post('/profile', [UserController::class,'profile_submit'])->name('user_profile_submit'); 
});








Route::middleware('admin')->prefix('admin')->group(callback: function () {
    Route::get('/dashboard',[AdminDashboardController::class,'dashboard'])->name('admin_dashboard');
    Route::get('/profile', [AdminDashboardController::class, 'profile'])->name('admin_profile');
    Route::post('/profile_submit', [AdminAuthController::class, 'profile_submit'])->name('admin_profile_submit');
});// Admin
Route::prefix('admin')->group(callback: function () {

    Route::get('/login',[AdminAuthController::class,'login'])->name('admin_login');
    Route::post('/login',[AdminAuthController::class,'login_submit'])->name('admin_login_submit');
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin_logout');
    Route::get('/forget-password',[AdminAuthController::class,'forget_password'])->name('admin_forget_password');
    Route::post('/forget_password_submit',action: [AdminAuthController::class,'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password_submit'])->name('admin_reset_password_submit');

});

