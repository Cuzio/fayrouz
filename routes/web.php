<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [HomeController::class, 'index']);

Route::get('/create', [PostController::class, 'create'])->name("create");

Route::post('/create-post', [PostController::class, 'createPost'])->name("create.post");

Route::get('/allposts', [PostController::class, 'allPosts'])->name("all.posts");

Route::get('/singlepost/{post_id}', [PostController::class, 'singlePost'])->name("single.post");

Route::get('/edit-post/{post_id}', [PostController::class, 'editPost'])->name("edit.post");

Route::post('/update-post/{post_id}', [PostController::class, 'updatePost'])->name("update.post");

Route::delete('/delete-post/{post_id}', [PostController::class, 'deletePost'])->name("delete.post");


Route::get('/login', [AuthController::class, 'login'])->name("login");

Route::get('/register', [AuthController::class, 'register'])->name("register");

Route::post('/register-user', [AuthController::class, 'registerUser'])->name("register.user");

Route::post('/login-user', [AuthController::class, 'loginUser'])->name("login.user");

Route::get('/logout', [AuthController::class, 'logout'])->name("logout");

// Route::post('/logout-user', [AuthController::class, 'logoutUser'])->name("logout.user");

Route::post('/comment/{post_id}', [CommentController::class, 'comment'])->name("comment");

// Route::post('/all-comments', [CommentController::class, 'allComments'])->name("all.comments");


// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/forget-password-email', [AuthController::class, 'forgetPasswordEmail'])->name('forget.password.email');

Route::post('/password-email', [AuthController::class, 'passwordEmail'])->name('password.email');

Route::get('/password-reset', [AuthController::class, 'passwordReset'])->name('password.reset');

Route::post('/password-update', [AuthController::class, 'passwordUpdate'])->name('password.update');
