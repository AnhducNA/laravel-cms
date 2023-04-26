<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FileUploadController;
use App\Http\Controllers\Admin\LogController;
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

Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])->prefix('admin')->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('file-upload', [FileUploadController::class, 'getFileUploadForm'])->name('get.fileupload');
    Route::post('file-upload', [FileUploadController::class, 'store'])->name('store.file');

    // user
    Route::get('user', [UserController::class, 'index'])->name('user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('user/edit/{id}', [UserController::class, 'edit'])->name('user.edit');
    Route::post('user/update/{id}', [UserController::class, 'update'])->name('user.update');
    Route::get('user/destroy/{id}', [UserController::class, 'destroy'])->name('user.destroy');
    Route::get('user/find', [UserController::class, 'find_select2'])->name('user.find');

//    Role
    Route::resource('role', RoleController::class)->only('index', 'create', 'store', 'edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('role.update');
    Route::get('role/destroy/{id}', [RoleController::class, 'destroy'])->name('role.destroy');
//    Permission
    Route::resource('permission', PermissionController::class)->only('index', 'create', 'store', 'edit');
    Route::post('permission/update/{id}', [PermissionController::class, 'update'])->name('permission.update');
    Route::get('permission/destroy/{id}', [PermissionController::class, 'destroy'])->name('permission.destroy');

    Route::resource('/post', PostController::class)->only('index', 'show', 'create', 'store', 'edit');
    Route::post('post/update/{id}', [PostController::class, 'update'])->name('post.update');
    Route::get('post/destroy/{id}', [PostController::class, 'destroy'])->name('post.destroy');

    Route::resource('/category', CategoryController::class)->only('index', 'create', 'store', 'edit');
    Route::post('category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
    Route::get('category/destroy/{id}', [CategoryController::class, 'destroy'])->name('category.destroy');
    Route::get('category/find', [CategoryController::class, 'find_select2'])->name('category.find');

    Route::resource('/tag', TagController::class)->only('index', 'create', 'store', 'edit');
    Route::post('tag/update/{id}', [TagController::class, 'update'])->name('tag.update');
    Route::get('tag/destroy/{id}', [TagController::class, 'destroy'])->name('tag.destroy');
    Route::get('tag/find', [TagController::class, 'find_select2'])->name('tag.find');
    Route::get('tag/show/{id}', [TagController::class, 'show'])->name('tag.show');

    Route::get('/logs', [LogController::class, 'index'])->name('log.index');
    Route::get('/logs/{file}', [LogController::class, 'preview'])->name('log.preview');
    Route::get('/shows/{file}', [LogController::class, 'show'])->name('log.show');
    Route::get('/logs2', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);
});
