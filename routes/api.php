<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('/categories', 'App\Http\Controllers\CategoryController');
Route::apiResource('/products', 'App\Http\Controllers\ProductController');

Route::get('/files', 'App\Http\Controllers\FileController@index');
Route::post('/upload', 'App\Http\Controllers\FileController@uploadFile');
Route::delete('/delete/upload-folder/{file}', 'App\Http\Controllers\FileController@deleteFile');
Route::get('/download/upload-folder/{file}', 'App\Http\Controllers\FileController@downloadFile');

Route::group([
    'middleware' => ['jwt.auth']
//    'prefix' => 'auth'

], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

