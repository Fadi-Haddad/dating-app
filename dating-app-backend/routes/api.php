<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;


Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');
});

Route::group(["middleware" => "auth:api"], function () {
    Route::post('/users', [UserController::class, 'getUsers']);
    Route::post('/profile', [UserController::class, 'getUserProfile']);
    Route::post('/editprofile', [UserController::class, 'editProfile']);
    Route::post('/user/{id}', [UserController::class, 'viewSomeProfile']);
    Route::post('/filterUsers', [UserController::class, 'filterUsers']);
    Route::post('/like/{id}', [UserController::class, 'likeUser']);
    Route::post('/block/{id}', [UserController::class, 'blockUser']);
    Route::post('/unlike/{id}', [UserController::class, 'unlikeUser']);
    Route::post('/unblock/{id}', [UserController::class, 'unBlockUser']);
    Route::get('/users/search', [UserController::class, 'search']);
    Route::post('/notifications', [UserController::class, 'viewNotifications']);
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});