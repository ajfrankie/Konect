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



Route::view('/', 'index');

//login
Route::view('login', 'login');
Route::post('authenticate', [LoginController::class, ('authenticate')])->name('authenticate');;
Route::get('logout', [LoginController::class, 'logout']);

//registration
Route::view('registration', 'registration');
Route::post('/store', [RegisterController::class, 'store']);
Route::get('/', function () {
    return view('index');
})->name('index');


//blog
Route::view('blog', 'blog');
// In your routes/web.php file
Route::get('/blog', [PostController::class, 'index'])->name('blog');


//postblog
Route::view('post', 'post');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');


// Route to display the blog posts
Route::get('/posts/create', [PostController::class, 'create']);
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');
Route::delete('/posts/{id}', [PostController::class, 'destroy'])->name('posts.destroy');
Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
