<?php

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

// User
Route::group(['prefix' => 'v1'], function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['middleware' => 'user'], function () {
            Route::get('home', 'App\Http\Controllers\Api\V2\HomeController@home');
            Route::get('movie/{id}', 'App\Http\Controllers\Api\V2\HomeController@movie');
            Route::get('notifications', 'App\Http\Controllers\Api\V2\HomeController@notifications');
            Route::post('movie/submit-rating', 'App\Http\Controllers\Api\V2\HomeController@submitRating');
        });
    });
});

// Admin
Route::group(['prefix' => 'v1/admin'], function () {
    Route::middleware('auth:sanctum')->group(function () {
        Route::group(['middleware' => 'admin'], function () {
            Route::get('dashboard', 'App\Http\Controllers\Api\V2\AdminController@dashboard');
            Route::get('movie-data/{id}', 'App\Http\Controllers\Api\V2\AdminController@movieData');
            Route::post('add-movie', 'App\Http\Controllers\Api\V2\AdminController@addMovie');
            Route::post('update-movie', 'App\Http\Controllers\Api\V2\AdminController@updateMovie');
        });
    });
});

// Auth
Route::group(['prefix' => 'v1/auth'], function () {
    Route::post('registration', 'App\Http\Controllers\Api\V2\AuthController@registration');
    Route::post('login', 'App\Http\Controllers\Api\V2\AuthController@login');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'App\Http\Controllers\Api\V2\AuthController@logout');
    });
});