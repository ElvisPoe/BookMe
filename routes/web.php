<?php

use App\Http\Controllers\PostsLikeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Admin Page - Only for superuser
Route::get('/administrator', function () {
    return view('admin.admin');
})->name('admin');

// Welcome Page - No login required
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Home Page
Route::get('/home', [HomeController::class, 'index'])->name('home');


// Profile
Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::get('/profile/{user_id}', [ProfileController::class, 'show'])->name('profile.show');


// Posts
Route::get('/posts', [PostsController::class, 'index'])->name('posts');
Route::post('/posts', [PostsController::class, 'store'])->name('posts.store');
Route::delete('/posts/{post}/delete', [PostsController::class, 'destroy'])->name('posts.destroy');


// Posts Likes
Route::post('/posts/{post}/likes', [PostsLikeController::class, 'store'])->name('posts.like');
Route::delete('/posts/{post}/likes', [PostsLikeController::class, 'destroy'])->name('posts.like');