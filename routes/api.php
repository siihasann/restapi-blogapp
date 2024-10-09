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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();

    
});

Route::post('/login', [AuthenticationController::class, 'login']);

Route::apiResource('posts', PostController::class)->middleware(['auth:sanctum']);
Route::get('posts/search', [PostController::class, 'search']);

Route::apiResource('comments', CommentController::class);
Route::get('comments/search', [CommentController::class, 'search']);

// Route::middleware('auth:sanctum')->group(function () {

    

// });
