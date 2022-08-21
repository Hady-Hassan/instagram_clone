<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/users',[UserController::class,'index'])->name('users.index');
Route::get('/users/create',[UserController::class,'create'])->name('users.create')->middleware(['auth']);
Route::post('/users',[UserController::class,'store'])->name('users.store')->middleware(['auth']);

Route::get('/users/{user}',[UserController::class,'show'])->where('user', '[0-9]+')->name('users.show');
Route::get('/users/{user}/edit',[UserController::class,'edit'])->where('user', '[0-9]+')->name('users.edit')->middleware(['auth']);
Route::put('/users/{user}',[UserController::class,'update'])->where('user', '[0-9]+')->name('users.update')->middleware(['auth']);
Route::delete('/users/{user}',[UserController::class,'destroy'])->where('user', '[0-9]+')->name('users.destroy')->middleware(['auth']);

// Route::get('/posts',[PostController::class,'index'])->name('posts.index');
// Route::get('/posts/create',[PostController::class,'create'])->name('posts.create')->middleware(['auth']);
// Route::post('/posts',[PostController::class,'store'])->name('posts.store')->middleware(['auth']);

// Route::get('/posts/{post}',[PostController::class,'show'])->where('post', '[0-9]+')->name('posts.show');
// Route::get('/posts/{post}/edit',[PostController::class,'edit'])->where('post', '[0-9]+')->name('posts.edit')->middleware(['auth']);
// Route::put('/posts/{post}',[PostController::class,'update'])->where('post', '[0-9]+')->name('posts.update')->middleware(['auth']);
// Route::delete('/posts/{post}',[PostController::class,'destroy'])->where('post', '[0-9]+')->name('posts.destroy')->middleware(['auth']);
// Route::get('/posts/deleted',[PostController::class,'deletepost'])->where('post', '[0-9]+')->name('posts.delete')->middleware(['auth']);
// Route::post('/posts/deleted/{post}',[PostController::class,'restorepost'])->where('post', '[0-9]+')->name('posts.restore')->middleware(['auth']);

require __DIR__.'/auth.php';
