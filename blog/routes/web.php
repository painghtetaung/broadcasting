<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Models\Article;
use Illuminate\Support\Facades\Auth;
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


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/detail/{article}', [ArticleController::class, 'detail']);
Route::get('/articles/add', [ArticleController::class, 'add']);
Route::post('/articles', [ArticleController::class, 'create']);
Route::get('/articles/delete/{article}', [ArticleController::class, 'delete']);

Route::get('/articles/detail/{article}/comments', [CommentController::class, 'index']);

Route::post('/articles/detail/{article}/comment', [CommentController::class, 'create']);
Route::get('/comments/delete/{id}', [CommentController::class, 'delete']);