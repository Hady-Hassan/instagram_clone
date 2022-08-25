<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\profileController;
use App\Http\Controllers\tagController;
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

    Route::get('/',[PostController::class,'index'])->name('home');
    Route::post('get_all_comments',[PostController::class,'get_all_comments'])->name('get_all_comments');



    Route::post('/',[PostController::class,'store'])->name('posts.store');

     Route::get('/user/{user}',[UserController::class,'gprof'])->name('users.show');
  


    Route::get('/user/{user}/post/{post}',[PostController::class,'show'])->where('post', '[0-9]+')->name('post.show');


       //Routes of editProfile
       Route::get('/users/profile', [profileController::class, 'profile'])->where('id', '[0-9]+')->name('users.profile');

       Route::get('/users/edit', [profileController::class, 'edit'])->where('id', '[0-9]+')->name('users.edit');
       Route::put('/users/update', [profileController::class, 'update'])->where('id', '[0-9]+')->name('users.update');
       Route::get('/users/editpassword', [profileController::class, 'editpassword'])->name('users.editpassword');
       Route::put('/users/updatepassword', [profileController::class, 'updatepassword'])->name('users.updatepassword');
       Route::put('/users/editemail', [profileController::class, 'editemail'])->name('users.editemail');
       Route::get('/users/blocked', [profileController::class, 'blocked'])->name('users.blocked');

       // Block & UnBlock
       Route::post('/users/unblock', [profileController::class, 'unblock'])->name('users.unblock');
       Route::post('/users/block', [UserController::class, 'block'])->name('users.block');

       Route::POST('/users/request_email_validation', [profileController::class, 'request_email_validation'])->name('users.request_email_validation');

        //Remove Follow
       Route::post('/users/remove',[UserController::class,'removefollow'])->name('users.removefollow');

       // Unfollow
       Route::post('/users/unfollow',[UserController::class,'unfollow'])->name('users.unfollow');
       Route::post('/users/follow',[UserController::class,'follow'])->name('users.follow');

    // comments
    Route::post('/post/comment',[PostController::class,'makeComment'])->name('post.make_comment');
    Route::post('/comment/like',[PostController::class,'makeLikeComment'])->name('post.make_like_comment');
    Route::get('/post/edit/{post}',[PostController::class,'edit'])->name('post.edit');
    Route::put('/post/update/{id}',[PostController::class,'update'])->name('post.update');



    //posts
    Route::post('/post/like',[PostController::class,'makeLike'])->name('post.make_like');
    Route::post('/post/save',[PostController::class,'savePost'])->name('post.save_post');

    // tags
    Route::get('/tag/{tag}',[tagController::class,'show'])->name('tag.show');

    // Search
    Route::post('/users/search',[UserController::class,'search'])->name('users.search');


});

require __DIR__.'/auth.php';
