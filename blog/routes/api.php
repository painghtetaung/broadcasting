<?php

use App\Http\Controllers\CommentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::get('/articles/detail/{article}/comments', [CommentController::class, 'index']);

//Route::middleware('auth:api')->group(function () {
 //   Route::post('/articles/detail/{article}/comment', [CommentController::class, 'store']);
//});


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
