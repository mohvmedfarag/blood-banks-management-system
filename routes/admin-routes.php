<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SendNotifyController;
use App\Http\Controllers\Auth\Admin\AdminAuthController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(['prefix' => LaravelLocalization::setLocale()], function(){

	Route::group(['middleware' => ['web']], function () {

		################## Admin Auth ###################
		Route::get('login', [AdminAuthController::class, 'showLogin'])->name('showLogin');
		Route::post('login', [AdminAuthController::class, 'login'])->name('login.post');
		Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');

		######################### Dashboard Routes ###########################

		Route::controller(ProfileController::class)->group( function(){

			Route::get('dashboard', 'index')->name('dashboard');

			Route::get('dashboard/bloodbanks', 'bloodbanks')->name('dashboard.bloodbanks');
			Route::get('dashboard/bloodbanks/create', 'showCreateBankForm')->name('dashboard.bloodbanks.create');
			Route::post('dashboard/bloodbanks/create', 'storeBank')->name('dashboard.bloodbanks.create.post');
			Route::get('dashboard/bloodbanks/edit/{id}', 'showFormEditBank')->name('dashboard.bloodbanks.showFormEditBank');
			Route::post('dashboard/bloodbanks/edit/{id}', 'updateBank')->name('dashboard.bloodbanks.updateBank.post');
			Route::post('dashboard/bloodbanks/delete/{id}', 'deleteBank')->name('dashboard.bloodbanks.delete');

			Route::get('dashboard/donations', 'donations')->name('dashboard.donations');
			Route::post('dashboard/donations/accept/{id}', 'acceptDonation')->name('dashboard.donations.accept');
			Route::post('dashboard/donations/reject/{id}', 'rejectDonation')->name('dashboard.donations.reject');


			Route::get('dashboard/bloodrequests', 'bloodRequests')->name('dashboard.bloodRequests');
			Route::post('dashboard/requests/accept/{id}', 'acceptRequest')->name('dashboard.requests.accept');
			Route::post('dashboard/requests/reject/{id}', 'rejectRequest')->name('dashboard.requests.reject');
			Route::get('dashboard/requests/{id}', 'showRequest')->name('dashboard.showRequest');

			Route::get('dashboard/donors', 'donors')->name('dashboard.donors');
			Route::post('dashboard/donors/block/{id}', 'blockDonor')->name('dashboard.donors.block');


			Route::get('dashboard/patients', 'patients')->name('dashboard.patients');
			Route::post('dashboard/patients/block/{id}', 'blockPatient')->name('dashboard.patients.block');

			Route::get('admins', 'showAdmins')->name('show.admins');
			Route::get('add/admin', 'addAdminForm')->name('add.admin.show');
			Route::post('add/admin', 'addAdmin')->name('add.admin.post');
			Route::delete('delete/admin/{id}', 'deleteAdmin')->name('delete.admin');

			Route::get('contacts', 'contacts')->name('contacts');
			Route::post('contacts/{id}', 'deleteContact')->name('deleteContact');
		});

		Route::controller(SendNotifyController::class)->group(function(){
			Route::get('notifications/send', 'index')->name('notifications.send');
			Route::post('notifications/send', 'sendNotification')->name('notifications.send.post');
		});
	});

});
