<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use Illuminate\View\View;

Route::get('/', function () {
    return view('welcome');
});

// Route::view('/exemple-page','exemple-page');
// Route::view('/exemple-auth','exemple-auth');

// Début des Routes Qui Gère L'authentification de L'utilisateur

Route::prefix('admin')->name('admin.')->group(function(){
        Route::middleware(['guest','BlockRetour'])->group(function(){
            Route::controller(AuthController::class)->group(function(){
                Route::get('/login','loginForm')->name('login');
                Route::Post('/login','loginHandler')->name('login_handler');
                Route::get('/forgot-password','forgotForm')->name('forgot');
                Route::post('/send-password-reset-link','sendPasswordResetLink')->name('send_password_reset_link');
                Route::get('/password/reset/{token}','resetForm')->name('reset_password_form');
                Route::post('/reset-password-handler','resetPasswordHandler')->name('reset_password_handler');
            });
        });
        Route::middleware(['auth','BlockRetour'])->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/dashboard','adminDashboard')->name('dashboard');
                Route::post('/logout','logoutHandler')->name('logout');
                Route::get('/profile','profileView')->name('profile');
                Route::post('/update-profile-picture','updateProfilePicture')->name('update_profile_picture');




                 Route::get('/settings','generalSettings')->name('settings');
                 Route::post('/update-logo','updateLogo')->name('update_logo');
                 Route::post('/update-favicon','updateFavicon')->name('update_favicon');
            });
        });
});

// Fin du codes
