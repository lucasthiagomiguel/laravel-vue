<?php
use App\Http\Controllers\UsersController;
use App\Http\Controllers\TaskController;
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
Route::prefix('v1')->middleware('jwt.auth')->group(function(){
    Route::apiResource('users',UsersController::class);
    Route::apiResource('task',TaskController::class);
    Route::post('me','App\Http\Controllers\AuthController@me');
    Route::post('refresh','App\Http\Controllers\AuthController@refresh');
    Route::post('logout','App\Http\Controllers\AuthController@logout');
});

Route::prefix('v1')->group(function(){
    Route::post('login','App\Http\Controllers\AuthController@login');
    
});
