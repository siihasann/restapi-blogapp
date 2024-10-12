<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Middleware\Authenticate;
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


Route::post('/login', [AuthenticationController::class, 'login']);

Route::middleware('auth:sanctum')->group(function(){
    // API Post
    Route::get('posts', [PostController::class, 'index']);
    Route::get('posts/search', [PostController::class, 'search']);
    Route::get('posts/{id}', [PostController::class, 'show']);
    Route::post('posts', [PostController::class, 'store']);
    Route::put('posts/{id}', [PostController::class, 'update']);
    Route::delete('posts/{id}', [PostController::class, 'destroy']);

    // API Comment
    Route::get('comments', [CommentController::class, 'index']);
    Route::post('comment/{post_id}', [CommentController::class, 'store']);
    Route::get('comment/{id}', [CommentController::class, 'show']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);

    Route::post('/logout', [AuthenticationController::class, 'logout']);

});