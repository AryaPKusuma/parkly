<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiLoginController;
use App\Http\Controllers\ApiRegisterController;
use App\Http\Controllers\ParkingLotsApiController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('/auth/login', [ApiLoginController::class, 'authenticate']);
Route::post('/register', [ApiRegisterController::class, 'store']);

// list parkir
Route::get('/parkir', [ParkingLotsApiController::class, 'index']);
Route::get('/parkinglots/{parkinglot}', [ParkingLotsApiController::class, 'show']);


// user parkir
Route::get('/parkiranku', [ParkingLotsApiController::class, 'myparkir'])->name('parkinglots.parkiranku');

Route::post('/registrasi/store', [ParkingLotsApiController::class, 'store'])->name('registrasi.store');
