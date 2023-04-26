<?php

use App\Http\Controllers\Client\FullTextSearchController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\Client\UserController;
use App\Http\Controllers\CrawlController;
use App\Http\Controllers\FaceBookController;
use App\Http\Controllers\GoogleController;
use App\Http\Middleware\IsClient;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//Google login url
Route::get('auth/google', [GoogleController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

// Facebook Login URL
Route::prefix('facebook')->name('facebook.')->group(function () {
    Route::get('auth', [FaceBookController::class, 'loginUsingFacebook'])->name('login');
    Route::get('callback', [FaceBookController::class, 'callbackFromFacebook'])->name('callback');
});

Route::get('/login', [UserController::class, 'login'])->name('client.login');
Route::post('/login', [UserController::class, 'store'])->name('client.store');

Route::get('/logout', [UserController::class, 'logout'])->name('client.logout');

Route::middleware('auth')->group(function () {
    Route::get('/profile/{id}', [UserController::class, 'create_profile'])->name('client.profile');
    Route::post('/profile/{id}/update', [UserController::class, 'store_profile'])->name('client.store_profile');
    Route::post('/profile/{id}/change-password', [UserController::class, 'change_password'])->name('client.change_password');
});

Route::middleware('client')->group(function () {
    Route::get('/', [HomeController::class, 'index']);
    Route::get('/category/{slug}', [HomeController::class, 'category'])->name('client.category');
    Route::get('/post/{slug}', [HomeController::class, 'detail_post'])->name('client.post');
    Route::get('/full-text-search', [FullTextSearchController::class, 'index'])->name('client.search');
    Route::get('/search/store', [FullTextSearchController::class, 'search']);
});

Route::get('/crawl/category', [CrawlController::class, 'category']);
Route::get('/crawl', [CrawlController::class, 'test']);

