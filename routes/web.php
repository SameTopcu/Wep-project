<?php

use App\Http\Controllers\Admin\AdminAuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminSliderController;
use App\Http\Controllers\Front\FrontController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminWelcomeItemController;
use App\Http\Controllers\Admin\AdminFeatureController;
use App\Http\Controllers\Admin\AdminCounterItemController;
use App\Http\Controllers\Admin\AdminTestimonialController;
use App\Http\Controllers\Admin\AdminTeamMemberController;

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
});




// Admin
Route::prefix('admin')->group(callback: function () {

    Route::get('/login',[AdminAuthController::class,'login'])->name('admin_login');
    Route::post('/login',[AdminAuthController::class,'login_submit'])->name('admin_login_submit');
    Route::get('/logout',[AdminAuthController::class,'logout'])->name('admin_logout');
    Route::get('/forget-password',[AdminAuthController::class,'forget_password'])->name('admin_forget_password');
    Route::post('/forget_password_submit',action: [AdminAuthController::class,'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password/{token}/{email}',[AdminAuthController::class,'reset_password_submit'])->name('admin_reset_password_submit');
    Route::get('/slider/index',[AdminSliderController::class,'index'])->name('admin_slider_index');
    Route::get('/slider/create',[AdminSliderController::class,'create'])->name('admin_slider_create');
    Route::post('/slider/create',[AdminSliderController::class,'create_submit'])->name('admin_slider_create_submit');
    Route::get('/slider/edit/{id}',[AdminSliderController::class,'edit'])->name('admin_slider_edit');
    Route::post('/slider/edit/{id}',[AdminSliderController::class,'edit_submit'])->name('admin_slider_edit_submit');
    Route::get('/slider/delete/{id}',[AdminSliderController::class,'delete'])->name('admin_slider_delete');
    Route::get('/welcome-item/index',[AdminWelcomeItemController::class,'index'])->name('admin_welcome_item_index');
    Route::post('/welcome-item/update',[AdminWelcomeItemController::class,'update'])->name('admin_welcome_item_update');


    //features routes : 
    Route::get('/feature/index',[AdminFeatureController::class,'index'])->name('admin_feature_index');
    Route::get('/feature/create',[AdminFeatureController::class,'create'])->name('admin_feature_create');
    Route::post('/feature/create',[AdminFeatureController::class,'create_submit'])->name('admin_feature_create_submit');
    Route::get('/feature/edit/{id}',[AdminFeatureController::class,'edit'])->name('admin_feature_edit');
    Route::post('/feature/edit/{id}',[AdminFeatureController::class,'edit_submit'])->name('admin_feature_edit_submit');
    Route::get('/feature/delete/{id}',[AdminFeatureController::class,'delete'])->name('admin_feature_delete');


    //counter routes : 
    Route::get('/counter-item/index',[AdminCounterItemController::class,'index'])->name('admin_counter_index');
    Route::post('/counte-item/update',[AdminCounterItemController::class,'update'])->name('admin_counter_update');

    //testimonial routes : 
    Route::get('/testimonial/index',[AdminTestimonialController::class,'index'])->name('admin_testimonial_index');
    Route::get('/testimonial/create',[AdminTestimonialController::class,'create'])->name('admin_testimonial_create');
    Route::post('/testimonial/create',[AdminTestimonialController::class,'create_submit'])->name('admin_testimonial_create_submit');
    Route::get('/testimonial/edit/{id}',[AdminTestimonialController::class,'edit'])->name('admin_testimonial_edit');
    Route::post('/testimonial/edit/{id}',[AdminTestimonialController::class,'edit_submit'])->name('admin_testimonial_edit_submit');
    Route::get('/testimonial/delete/{id}',[AdminTestimonialController::class,'delete'])->name('admin_testimonial_delete');

    //team member routes : 
    Route::get('/team-member/index',[AdminTeamMemberController::class,'index'])->name('admin_team_member_index');
    Route::get('/team-member/create',[AdminTeamMemberController::class,'create'])->name('admin_team_member_create');
    Route::post('/team-member/create',[AdminTeamMemberController::class,'create_submit'])->name('admin_team_member_create_submit');
    Route::get('/team-member/edit/{id}',[AdminTeamMemberController::class,'edit'])->name('admin_team_member_edit');
    Route::post('/team-member/edit/{id}',[AdminTeamMemberController::class,'edit_submit'])->name('admin_team_member_edit_submit');
    Route::get('/team-member/delete/{id}',[AdminTeamMemberController::class,'delete'])->name('admin_team_member_delete');   




});

