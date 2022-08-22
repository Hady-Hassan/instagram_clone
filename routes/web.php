<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;  
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\profileController;

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

 

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');


// group middleware auth 
Route::group(['middleware'=>'auth'],function(){

    Route::get('/',[HomeController::class,'index'])->name('home');
    Route::post('get_all_comments',[HomeController::class,'get_all_comments'])->name('get_all_comments');



    // Route::get('/user',[UserController::class,'index'])->name('users.index');
    // Route::get('/user/create',[UserController::class,'create'])->name('users.create')->middleware(['auth']);
    // Route::post('/user',[UserController::class,'store'])->name('users.store')->middleware(['auth']);
    
     Route::get('/user/{user}',[UserController::class,'show'])->name('users.show');
    // Route::get('/user/{user}/edit',[UserController::class,'edit'])->where('user', '[0-9]+')->name('users.edit')->middleware(['auth']);
    // Route::put('/user/{user}',[UserController::class,'update'])->where('user', '[0-9]+')->name('users.update')->middleware(['auth']);
    // Route::delete('/user/{user}',[UserController::class,'destroy'])->where('user', '[0-9]+')->name('users.destroy')->middleware(['auth']);
    

    Route::get('/user/{user}/post/{post}',[PostController::class,'show'])->where('post', '[0-9]+')->name('post.show');


       //Route::get('/editpage',[profileController::class,'index'])->name('users.index');
       Route::get('/users/edit', [profileController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
       Route::put('/users/update', [profileController::class, 'update'])->where('id', '[0-9]+')->name('users.update');


    // comments
    Route::post('/user/{user}/post/{post}',[PostController::class,'makeComment'])->where('post', '[0-9]+')->name('post.make_comment');

    
});

require __DIR__.'/auth.php';