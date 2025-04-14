<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::name("admin.")->prefix('/admin')->middleware(['auth', 'role:admin'])->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('provinces', ProvinceController::class);
    Route::post('provinces/{province}/assign-staff', [ProvinceController::class, 'assignStaff'])->name('provinces.assign-staff');
    Route::delete('provinces/{province}/staff/{user}', [ProvinceController::class, 'removeStaff'])->name('provinces.remove-staff');

    Route::get('/posts/export', [AdminPostController::class, 'export'])->name('posts.export');
    Route::resource('/posts', AdminPostController::class);
    Route::post('/posts/update-status/{post}', [AdminPostController::class, 'updateStatus'])->name('posts.update-status');

    Route::resource('/comments', CommentController::class);

    Route::resource('/users', UserController::class);
});

Route::name("staff.")->prefix('/staff')->middleware(['auth', 'role:admin,staff'])->name('staff.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/posts/export', [AdminPostController::class, 'export'])->name('posts.export');
    Route::resource('/posts', AdminPostController::class)->except(['create', 'store']);
    Route::post('/posts/update-status/{post}', [AdminPostController::class, 'updateStatus'])->name('posts.update-status');

    Route::resource('/comments', CommentController::class);
});

Route::name('posts.')->prefix('/posts')->group(function () {
    Route::get('/', [PostController::class, 'index'])->name('index');
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::post('/', [PostController::class, 'store'])->name('store');
    Route::get('/{post}', [PostController::class, 'show'])->name('show');
    Route::get('/{post}/edit', [PostController::class, 'edit'])->name('edit');
    Route::put('/{post}', [PostController::class, 'update'])->name('update');
    Route::delete('/{post}', [PostController::class, 'destroy'])->name('destroy');
    Route::post('/{post}/like', [PostController::class, 'like'])->name('like');
});



Route::middleware(['auth'])->group(function () {
    Route::post('/comments/{post?}', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});
require __DIR__ . '/auth.php';
