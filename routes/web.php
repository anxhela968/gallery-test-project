<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\FavoriteController;

Route::middleware('guest')->group(function () {
    Route::get('/register', [UserController::class, 'showRegisterForm']);
    Route::post('/register', [UserController::class, 'register']);

    Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [UserController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'showProfile']);
    Route::post('/profile',[UserController::class, 'updateProfile']);

    Route::get('/image', [ImageController::class, 'showImageForm']);
    Route::post('/image',[ImageController::class, 'uploadImageForm']);

    Route::get('/favorites',[FavoriteController::class, 'index']);
    Route::post('/favorite',[FavoriteController::class, 'markAsFavorite']);
    Route::post('/unfavorite',[FavoriteController::class, 'markAsUnfavorite']);

    Route::get('/', [ImageController::class, 'index']);
});
