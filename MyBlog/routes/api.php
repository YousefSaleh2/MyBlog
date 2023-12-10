<?php

use App\Http\Controllers\API\CategoryController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\SettingController;
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


Route::put('/setting/{setting}' , [SettingController::class , 'update']);


Route::apiResource('/categories' , CategoryController::class);
Route::get('/categories.show_deleted', [CategoryController::class , 'show_deleted']);
Route::get('/categories.force_deleted/{id}', [CategoryController::class , 'force_deleted']);
Route::get('/categories.restore/{id}', [CategoryController::class , 'restore']);


//Route::apiResource('/posts' , PostController::class);
Route::get('/posts.show_deleted', [PostController::class , 'show_deleted']);
Route::get('/posts.force_deleted/{id}', [PostController::class , 'force_deleted']);
Route::get('/posts.restore/{id}', [PostController::class , 'restore']);
Route::post('/posts' , [PostController::class , 'store']);
Route::post('/posts/{id}' , [PostController::class , 'update']);
