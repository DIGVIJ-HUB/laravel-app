<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
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

// Home page
Route::get('/', function () {
    return view('welcome');
})->middleware('guest');

// Auth routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register');
    Route::post('registration', 'registration');
    Route::post('login', 'login');
    Route::post('logout', 'logout')->middleware('auth');
});

// User routes
Route::group(['middleware' => 'user'], function () {
    Route::get('home', [HomeController::class, 'home'])->middleware('auth');
    Route::get('movie/{id}', [HomeController::class, 'movie'])->name('movie')->middleware('auth');
    Route::post('movie/submit-rating', [HomeController::class, 'submitRating'])->name('movie.submit_rating')->middleware('auth');
});

// Admin routes
Route::group(['middleware' => 'admin'], function () {
    Route::group(['prefix' => 'admin'], function () {
        Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware('auth');
        Route::get('movie-data/{id}', [AdminController::class, 'movieData'])->middleware('auth');
        Route::post('add-movie', [AdminController::class, 'addMovie'])->middleware('auth');
        Route::post('update-movie', [AdminController::class, 'updateMovie'])->middleware('auth');
    });
});
