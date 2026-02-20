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
use App\Http\Controllers\Admin\AdminFaqController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminPostController;
use App\Http\Controllers\Admin\AdminDestinationController;
use App\Http\Controllers\Admin\AdminPackagesController;
use App\Http\Controllers\Admin\AdminAmenityController;
use App\Http\Controllers\Admin\AdminTourController;

Route::get('/',[FrontController::class,'home'])->name('home');
Route::get('/about',[FrontController::class,'about'])->name('about');
Route::get('/team-members',[FrontController::class,'team_members'])->name('team_members');
Route::get('/team-member/{slug}',[FrontController::class,'team_member'])->name('team_member');
Route::get('/registration',[FrontController::class,'registration'])->name('registration');
Route::get('/login',[FrontController::class,'login'])->name('login');
Route::post('/login',[FrontController::class,'login_submit'])->name('login_submit');
Route::get('/faq',[FrontController::class,'faq'])->name('faq');
Route::get('/blog',[FrontController::class,'blog'])->name('blog');
Route::get('/post/{slug}',[FrontController::class,'post'])->name('post');
Route::get('/category/{slug}',[FrontController::class,'category'])->name('category');
Route::get('/destinations',[FrontController::class,'destinations'])->name('destinations');
Route::get('/destination/{slug}',[FrontController::class,'destination'])->name('destination');
Route::get('/packages/{slug}',[FrontController::class,'package'])->name('package');


Route::post('/payment',[FrontController::class,'payment'])->name('payment');

// Payment Routes - PayPal
Route::get('/paypal/success', [FrontController::class, 'paypal_success'])->name('paypal_success');
Route::get('/paypal/cancel', [FrontController::class, 'paypal_cancel'])->name('paypal_cancel');

// Payment Routes - Stripe
Route::get('/stripe/success', [FrontController::class, 'stripe_success'])->name('stripe_success');
Route::get('/stripe/cancel', [FrontController::class, 'stripe_cancel'])->name('stripe_cancel');


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


    //faq routes : 
    Route::get('/faq/index',[AdminFaqController::class,'index'])->name('admin_faq_index');
    Route::get('/faq/create',[AdminFaqController::class,'create'])->name('admin_faq_create');
    Route::post('/faq/create',[AdminFaqController::class,'create_submit'])->name('admin_faq_create_submit');
    Route::get('/faq/edit/{id}',[AdminFaqController::class,'edit'])->name('admin_faq_edit');
    Route::post('/faq/edit/{id}',[AdminFaqController::class,'edit_submit'])->name('admin_faq_edit_submit');
    Route::get('/faq/delete/{id}',[AdminFaqController::class,'delete'])->name('admin_faq_delete');

    //blog category routes : 
    Route::get('/blog-category/index',[AdminBlogController::class,'index'])->name('admin_blog_category_index');
    Route::get('/blog-category/create',[AdminBlogController::class,'create'])->name('admin_blog_category_create');
    Route::post('/blog-category/create',[AdminBlogController::class,'create_submit'])->name('admin_blog_category_create_submit');
    Route::get('/blog-category/edit/{id}',[AdminBlogController::class,'edit'])->name('admin_blog_category_edit');
    Route::post('/blog-category/edit/{id}',[AdminBlogController::class,'edit_submit'])->name('admin_blog_category_edit_submit');
    Route::get('/blog-category/delete/{id}',[AdminBlogController::class,'delete'])->name('admin_blog_category_delete');


    //post routes : 
    Route::get('/post/index',[AdminPostController::class,'index'])->name('admin_post_index');
    Route::get('/post/create',[AdminPostController::class,'create'])->name('admin_post_create');
    Route::post('/post/create',[AdminPostController::class,'create_submit'])->name('admin_post_create_submit');
    Route::get('/post/edit/{id}',[AdminPostController::class,'edit'])->name('admin_post_edit');
    Route::post('/post/edit/{id}',[AdminPostController::class,'edit_submit'])->name('admin_post_edit_submit');
    Route::get('/post/delete/{id}',[AdminPostController::class,'delete'])->name('admin_post_delete');


    //destination routes : 
    Route::get('/destination/index',[AdminDestinationController::class,'index'])->name('admin_destination_index');
    Route::get('/destination/create',[AdminDestinationController::class,'create'])->name('admin_destination_create');
    Route::post('/destination/create',[AdminDestinationController::class,'create_submit'])->name('admin_destination_create_submit');
    Route::get('/destination/edit/{id}',[AdminDestinationController::class,'edit'])->name('admin_destination_edit');
    Route::post('/destination/edit/{id}',[AdminDestinationController::class,'edit_submit'])->name('admin_destination_edit_submit');
    Route::get('/destination/delete/{id}',[AdminDestinationController::class,'delete'])->name('admin_destination_delete');

    //destination photos routes : 
    Route::get('/destination_photos/{id}',[AdminDestinationController::class,'destination_photos'])->name('destination_photos');
    Route::post('/destination-photo-submit/{id}',[AdminDestinationController::class,'destination_photo_submit'])->name('destination_photo_submit');
    Route::get('/destination-photo-delete/{id}',[AdminDestinationController::class,'destination_photo_delete'])->name('destination_photo_delete');


    //destination videos routes : 
    Route::get('/destination-videos/{id}',[AdminDestinationController::class,'destination_videos'])->name('destination_videos');
    Route::post('/destination-video-submit/{id}',[AdminDestinationController::class,'destination_video_submit'])->name('destination_video_submit');
    Route::get('/destination-video-delete/{id}',[AdminDestinationController::class,'destination_video_delete'])->name('destination_video_delete');

    //packages routes : 
    Route::get('/package/index',[AdminPackagesController::class,'index'])->name('admin_package_index');
    Route::get('/package/create',[AdminPackagesController::class,'create'])->name('admin_package_create');
    Route::post('/package/create',[AdminPackagesController::class,'create_submit'])->name('admin_package_create_submit');
    Route::get('/package/edit/{id}',[AdminPackagesController::class,'edit'])->name('admin_package_edit');
    Route::post('/package/edit/{id}',[AdminPackagesController::class,'edit_submit'])->name('admin_package_edit_submit');
    Route::get('/package/delete/{id}',[AdminPackagesController::class,'delete'])->name('admin_package_delete');

    //package amenities routes : 
    Route::get('/package/amenities/{id}',[AdminPackagesController::class,'package_amenities'])->name('admin_package_amenities');
    Route::post('/package/amenities-submit/{id}',[AdminPackagesController::class,'amenities_submit'])->name('admin_package_amenities_submit');
    Route::get('/package/amenities-delete/{id}',[AdminPackagesController::class,'amenities_delete'])->name('admin_package_amenities_delete');

    //amenities routes : 
    Route::get('/amenity/index',[AdminAmenityController::class,'index'])->name('admin_amenity_index');
    Route::get('/amenity/create',[AdminAmenityController::class,'create'])->name('admin_amenity_create');
    Route::post('/amenity/create',[AdminAmenityController::class,'create_submit'])->name('admin_amenity_create_submit');
    Route::get('/amenity/edit/{id}',[AdminAmenityController::class,'edit'])->name('admin_amenity_edit');
    Route::post('/amenity/edit/{id}',[AdminAmenityController::class,'edit_submit'])->name('admin_amenity_edit_submit');
    Route::get('/amenity/delete/{id}',[AdminAmenityController::class,'delete'])->name('admin_amenity_delete');

    //package itineraries routes : 
    Route::get('/package/itineraries/{id}',[AdminPackagesController::class,'package_itineraries'])->name('admin_package_itineraries');
    Route::post('/package/itineraries-submit/{id}',[AdminPackagesController::class,'itineraries_submit'])->name('admin_package_itineraries_submit');
    Route::get('/package/itineraries-delete/{id}',[AdminPackagesController::class,'itineraries_delete'])->name('admin_package_itineraries_delete');

    //package photos routes : 
    Route::get('/package/photos/{id}',[AdminPackagesController::class,'package_photos'])->name('admin_package_photos');
    Route::post('/package/photos-submit/{id}',[AdminPackagesController::class,'photos_submit'])->name('admin_package_photos_submit');
    Route::get('/package/photos-delete/{id}',[AdminPackagesController::class,'photos_delete'])->name('admin_package_photos_delete');


    //package videos routes : 
    Route::get('/package/videos/{id}',[AdminPackagesController::class,'package_videos'])->name('admin_package_videos');
    Route::post('/package/videos-submit/{id}',[AdminPackagesController::class,'videos_submit'])->name('admin_package_videos_submit');
    Route::get('/package/videos-delete/{id}',[AdminPackagesController::class,'videos_delete'])->name('admin_package_videos_delete');

    //package faqs routes : 
    Route::get('/package/faqs/{id}',[AdminPackagesController::class,'package_faqs'])->name('admin_package_faqs');
    Route::post('/package/faqs-submit/{id}',[AdminPackagesController::class,'faqs_submit'])->name('admin_package_faqs_submit');
    Route::get('/package/faqs-delete/{id}',[AdminPackagesController::class,'faqs_delete'])->name('admin_package_faqs_delete');

    //tours routes :
    Route::get('/tour/index',[AdminTourController::class,'index'])->name('admin_tour_index');
    Route::get('/tour/create',[AdminTourController::class,'create'])->name('admin_tour_create');
    Route::post('/tour/create',[AdminTourController::class,'create_submit'])->name('admin_tour_create_submit');
    Route::get('/tour/edit/{id}',[AdminTourController::class,'edit'])->name('admin_tour_edit');
    Route::post('/tour/edit/{id}',[AdminTourController::class,'edit_submit'])->name('admin_tour_edit_submit');
    Route::get('/tour/delete/{id}',[AdminTourController::class,'delete'])->name('admin_tour_delete');
});

