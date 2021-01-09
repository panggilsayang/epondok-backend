<?php

use App\Http\Controllers\Api\V1\Auth\LoginController;
use App\Http\Controllers\Api\V1\Auth\RegisterController;
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

Route::prefix('v1')->namespace('Api\V1')->name('api.v1.')->group(function (): void {
    Route::prefix('auth')->namespace('Auth')->name('auth.')->group(function (): void {
        Route::post('login',[LoginController::class,'login'])->name('login');
        Route::post('register',[RegisterController::class,'handle'])->name('register');
    });
});