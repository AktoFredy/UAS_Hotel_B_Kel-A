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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::apiResource('/users', App\Http\Controllers\UserController::class);
Route::apiResource('/bookings', App\Http\Controllers\BookingController::class);
Route::apiResource('/fobs', App\Http\Controllers\FobController::class);
Route::apiResource('/kamars', App\Http\Controllers\KamarController::class);
Route::apiResource('/karyawans', App\Http\Controllers\KaryawanController::class);
Route::apiResource('/orderfobs', App\Http\Controllers\OrderFobController::class);
Route::apiResource('/orderservices', App\Http\Controllers\OrderServiceController::class);
Route::apiResource('/services', App\Http\Controllers\ServiceController::class);

