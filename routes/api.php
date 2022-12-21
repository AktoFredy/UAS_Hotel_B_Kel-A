<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\EmailController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => 'auth:api'], function(){
    Route::apiResource('/users', App\Http\Controllers\UserController::class);
    // Route::apiResource('/bookings', App\Http\Controllers\BookingController::class);
    Route::apiResource('/fobs', App\Http\Controllers\FobController::class);
    // Route::apiResource('/kamars', App\Http\Controllers\KamarController::class);
    // Route::apiResource('/karyawans', App\Http\Controllers\KaryawanController::class);
    // Route::apiResource('/orderfobs', App\Http\Controllers\OrderFobController::class);
    // Route::apiResource('/orderservices', App\Http\Controllers\OrderServiceController::class);
    // Route::apiResource('/services', App\Http\Controllers\ServiceController::class);
    // Route::apiResource('/    ', App\Http\Controllers\ReservLiburan::class);
    // Route::apiResource('/paketwisata', App\Http\Controllers\PaketWisata::class);

    // Logout
    Route::post('/logout', [AuthController::class, 'logout']);
});

Route::get('email/verify/{id}', [EmailController::class, 'verify'])->name('verificationapi.verify');
Route::get('email/resend', [EmailController::class, 'resend'])->name('verificationapi.resend');



Route::apiResource('/bookings', App\Http\Controllers\BookingController::class);
Route::apiResource('/kamars', App\Http\Controllers\KamarController::class);
Route::apiResource('/karyawans', App\Http\Controllers\KaryawanController::class);
Route::apiResource('/orderservices', App\Http\Controllers\OrderServiceController::class);
Route::apiResource('/services', App\Http\Controllers\ServiceController::class);
Route::apiResource('/orderfobs', App\Http\Controllers\OrderFobController::class);
Route::apiResource('/reservliburan', App\Http\Controllers\ReservLiburan::class);
Route::apiResource('/paketwisata', App\Http\Controllers\PaketWisata::class);