<?php

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/auth/login', [App\Http\Controllers\SocialController::class, 'login'])->name('login');
Route::post('/auth/logout', [App\Http\Controllers\SocialController::class, 'logout'])->name('logout');
Route::get('/auth/{provider}/redirect', [App\Http\Controllers\SocialController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [App\Http\Controllers\SocialController::class, 'callback']);
Route::get('/auth/additional', [App\Http\Controllers\SocialController::class, 'additional'])->name('socials.additional');
Route::post('/auth/register', [App\Http\Controllers\SocialController::class, 'register'])->name('socials.register');

Route::get('/catmento', [App\Http\Controllers\PostController::class, 'index'])->name('posts.index');
Route::get('/posts/show/{question}',[App\Http\Controllers\PostController::class, 'show'])->name("posts.show");

Route::get('/posts/write', [App\Http\Controllers\PostController::class, 'write'])->name('posts.write');
Route::post('/posts/store', [App\Http\Controllers\PostController::class, 'store'])->name('posts.store');
Route::get('/posts/edit', [App\Http\Controllers\PostController::class, 'edit'])->name('posts.edit');
Route::put('/posts/update/{question}', [App\Http\Controllers\PostController::class, 'update'])->name('posts.update');
Route::post('/posts/delete/{question}', [App\Http\Controllers\PostController::class, 'delete'])->name('posts.delete');

Route::post('/answers/store', [App\Http\Controllers\AnswerController::class, 'store'])->name('answers.store');
Route::get('/answers/pick/{answer}', [App\Http\Controllers\AnswerController::class, 'pick'])->name('answers.pick');
Route::get('/answers/update/{answer}', [App\Http\Controllers\AnswerController::class, 'update'])->name('answers.update');
//Route::post('/answers/delete/{answer}', [App\Http\Controllers\AnswerController::class, 'delete'])->name('answers.delete');
Route::get('/answers/delete/{answer}', [App\Http\Controllers\AnswerController::class, 'delete'])->name('answers.delete');