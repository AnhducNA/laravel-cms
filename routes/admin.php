<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create']);
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('admin.login');

    Route::get('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

});
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    // user
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
//    Role
    Route::resource('role', RoleController::class)->only('index', 'create', 'store', 'edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
//    Permission
    Route::resource('permission', PermissionController::class)->only('index', 'create', 'store','edit');
    Route::post('permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::resource('/post', PostController::class)->only('index', 'create', 'store', 'edit');
    Route::post('post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('post/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::resource('/category', CategoryController::class)->only('index', 'create', 'store', 'edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');

    Route::resource('/tag', TagController::class);
    Route::post('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
    Route::get('tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');

    Route::get('/logs', [\App\Http\Controllers\Admin\LogController::class, 'index'])->name('log.index');
});
