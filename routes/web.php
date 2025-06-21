<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatbotController;
use App\Http\Controllers\Home\HomeController;
use App\Http\Controllers\Donor\DonorController;
use App\Http\Controllers\Auth\AuthTypeController;
use App\Http\Controllers\Home\BloodBanksController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\Auth\Donor\DonorAuthController;
use App\Http\Controllers\Auth\Donor\ResetPasswordController;
use App\Http\Controllers\Auth\Patient\PatientAuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use App\Http\Controllers\Auth\Donor\ForgetPasswordController;
use App\Http\Controllers\Auth\Patient\PatientResetPasswordController;
use App\Http\Controllers\Auth\Patient\PatientForgetPasswordController as PatientPatientForgetPasswordController;


Route::get('/', function () {
    // بدال redirect ثابت، استخدم setLocale() عشان يختار اللغة من الـ .env أو من الـ browser
    return redirect(LaravelLocalization::setLocale());
});

Route::group([
    'prefix'        => LaravelLocalization::setLocale(),
    'middleware'    => [
        'localeSessionRedirect', 
        'localizationRedirect', 
        'localeViewPath'
    ]
], function () {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/', [HomeController::class, 'index'])->name('welcome');
    Route::post('/contact', [HomeController::class, 'contact'])->name('welcome.contact');


    Route::get('/chatbot', [ChatbotController::class, 'chat'])->name('chatbot.chat');
    Route::post('/chatbot', [ChatbotController::class, 'handle'])->name('chatbot.handle');


    Route::get('home/blood-banks', [BloodBanksController::class, 'index'])->name('welcome.bloodBanks');
    Route::get('home/search', [BloodBanksController::class, 'search'])->name('welcome.bloodBanks.search');
    // Route::get('home/search/maps/{address}', [BloodBanksController::class, 'getCoordinatesFromAddress'])->name('welcome.bloodBanks.search.maps');


    ########################### Auth Donor ###########################

    Route::middleware('guest:donor')->group(function () {

        Route::controller(AuthTypeController::class)->group(function () {
            Route::get('chooseRegistration', 'registerType')->name('chooseRegistration');
            Route::get('chooseLogin', 'loginType')->name('chooseLogin');
        });

        Route::controller(DonorAuthController::class)->group(function () {
            Route::get('auth/donor/registerForm', 'showRegisterForm')->name('donor.showRegisterForm');
            Route::post('auth/donor/register', 'register')->name('donor.register');
            Route::get('auth/donor/loginForm', 'showLoginForm')->name('donor.showLoginForm');
            Route::post('auth/donor/login', 'login')->name('donor.login');
        });
    });
    Route::post('', [DonorAuthController::class, 'logout'])->name('donor.logout');

    ####################### Forget Password ###########################
    Route::group(['prefix' => 'donor/password', 'as' => 'donor.password.'], function () {
        Route::controller(ForgetPasswordController::class,)->group(function () {
            Route::get('email', 'showEmailForm')->name('email');
            Route::post('email', 'sendOtp')->name('email.post');
            Route::get('verify/{email}', 'showOtpForm')->name('verify');
            Route::post('verify', 'verifyOtp')->name('verify.post');
        });
        Route::controller(ResetPasswordController::class)->group(function () {
            Route::get('reset/{email}', 'showResetForm')->name('reset');
            Route::post('reset', 'resetPassword')->name('reset.post');
        });
    });

    ########################### Dashboard Donor ###########################
    Route::middleware('auth:donor')->group(function () {

        Route::group(['prefix' => 'donor/', 'as' => 'donor.'], function () {

            Route::controller(DonorController::class)->group(function () {

                Route::get('dashboard', 'index')->name('dashboard');
                Route::get('new/donate/request', 'showFormRequest')->name('new.donate.request');
                Route::post('new/donate/request', 'donateBlood')->name('new.donate.post');
                Route::get('donations', 'donations')->name('donations');
                Route::get('donation/edit/{id}', 'showEdit')->name('donation.show.edit');
                Route::post('donation/edit/{id}', 'edit')->name('donation.show.edit.post');
                Route::get('settings', 'showSetting')->name('setting');
                Route::put('settings', 'changeImageProfile')->name('updateProfile.changeImageProfile');
                Route::post('settings/edit/profile', 'editProfile')->name('editProfile');
                Route::post('settings/change/password', 'changePassword')->name('changePassword');
                Route::post('delete/{id}', 'delete')->name('delete');
                Route::get('donor/notifications', 'showNotifications')->name('showNotifications');
                Route::delete('donor/notifications/{id}', 'deleteNotification')->name('deleteNotification');
            });
        });
    });


    ########################### Auth Patient ###########################
    Route::controller(PatientAuthController::class)->group(function () {
        Route::get('auth/patient/registerForm', 'showRegisterForm')->name('patient.showRegisterForm');
        Route::post('auth/patient/register', 'register')->name('patient.register');
        Route::get('auth/patient/loginForm', 'showLoginForm')->name('patient.showLoginForm');
        Route::post('auth/patient/login', 'login')->name('patient.login');
        Route::post('auth/patient/logout', 'logout')->name('patient.logout');
    });

    ####################### Forget Password ###########################
    Route::group(['prefix' => 'patient/password', 'as' => 'patient.password.'], function () {
        Route::controller(PatientPatientForgetPasswordController::class)->group(function () {
            Route::get('email', 'showEmailForm')->name('email');
            Route::post('email', 'sendOtp')->name('email.post');
            Route::get('verify/{email}', 'showOtpForm')->name('verify');
            Route::post('verify', 'verifyOtp')->name('verify.post');
        });
        Route::controller(PatientResetPasswordController::class)->group(function () {
            Route::get('reset/{email}', 'showResetForm')->name('reset');
            Route::post('reset', 'resetPassword')->name('reset.post');
        });
    });

    ########################### Dashboard Patient ###########################
    Route::middleware('auth:patient')->group(function () {
        Route::group(['prefix' => 'patient/', 'as' => 'patient.'], function () {

            Route::controller(PatientController::class)->group(function () {

                Route::get('dashboard', 'index')->name('dashboard');
                Route::get('new/blood/request', 'showFormRequest')->name('new.blood.request');
                Route::post('new/blood/request', 'bloodRequest')->name('new.blood.post');
                Route::get('BloodRequests', 'BloodRequests')->name('BloodRequests');
                Route::get('requests/edit/{id}', 'showEdit')->name('requests.show.edit');
                Route::post('requests/edit/{id}', 'edit')->name('requests.show.edit.post');
                Route::get('settings', 'showSetting')->name('setting');
                Route::put('settings', 'changeImageProfile')->name('updateProfile.changeImageProfile');
                Route::post('settings/edit/profile', 'editProfile')->name('editProfile');
                Route::post('settings/change/password', 'changePassword')->name('changePassword');
                Route::post('delete/{id}', 'delete')->name('delete');
                Route::get('patient/notifications', 'showNotifications')->name('showNotifications');
                Route::delete('patient/notifications/{id}', 'deleteNotification')->name('deleteNotification');
            });
        });
    });
});

/** OTHER PAGES THAT SHOULD NOT BE LOCALIZED **/
