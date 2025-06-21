<?php

use App\Http\Controllers\Api\Auth\DonorAuthController;
use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('auth/donor/login', [DonorAuthController::class, 'login']);
Route::post('auth/donor/logout', [DonorAuthController::class, 'logout']);
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/bloodbanks', [HomeController::class, 'bloodbanks']);
Route::post('/contacts/store', [ContactController::class, 'storeContact']);
