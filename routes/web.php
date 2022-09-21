<?php

use App\Http\Controllers\StocksController;
use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'login']); 
Route::get('register', [UserController::class, 'register']);
Route::post('check', [UserController::class, 'check'])->name('check');
Route::post('store', [UserController::class, 'store'])->name('store');
Route::get('forgot', [UserController::class, 'forgot']);
Route::get('/resetview', [UserController::class, 'resetview']);
Route::put('/resetpassword', [UserController::class, 'resetpassword']);
Route::put('/reset', [UserController::class, 'reset']);

Route::group(['middleware' => ['logged']], function () {

    Route::get('/index',  [UserController::class, 'index']);
    Route::get('/logout', [UserController::class, 'logout']);

    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('/change_infos/{user}', [UserController::class, 'change_infos']);
    Route::put('/change_pass/{user}', [UserController::class, 'change_pass']);

    
    Route::post('storeMateriel', [StocksController::class, 'storeMateriel']);
    Route::get('edit/{stock}', [StocksController::class, 'edit']);
    Route::get('newrentree/{stock}', [StocksController::class, 'rentree']);
    Route::get('newsortie/{stock}', [StocksController::class, 'sortie']);
    Route::put('retrait/{stock}', [StocksController::class, 'soustraction']);
    Route::put('ajout/{stock}', [StocksController::class, 'addition']);
    Route::get('allsortie', [StocksController::class, 'allsortie']);
    Route::post('allsortieby', [StocksController::class, 'allsortieby']);
    Route::get('allrentree', [StocksController::class, 'allrentree']);
    Route::post('allrentreeby', [StocksController::class, 'allrentreeby']);
    Route::delete('deleteMateriel/{stock}', [StocksController::class, 'destroy']);

});
