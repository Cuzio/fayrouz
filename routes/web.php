<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
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