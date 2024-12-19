<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::view('/', 'index')->name('home');

// Authentication 
Route::view('login', 'login')->name('login');
Route::post('authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');

// Registration 
Route::view('registration', 'registration')->name('registration');
Route::post('/store', [RegisterController::class, 'store'])->name('registration.store');

// Blog 
Route::get('/blog', [PostController::class, 'index'])->name('blog');


Route::middleware(['auth'])->group(function () {
    // Create 
    Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');
    Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

    // View 
    Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');

    // Edit 
    Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
    Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');

    // Delete 
    Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
});

Route::fallback(function () {
    return response()->view('errors.404', [], 404); // Ensure a 404 page exists in resources/views/errors/404.blade.php
});


//search
Route::get('/posts/search', [PostController::class, 'search'])->name('posts.search');
