<?php

use App\Http\Controllers\DashboardController;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ParkingLotsController;
use App\Http\Controllers\Parkiranku;
use App\Http\Controllers\ParkirankuController;
use App\Http\Controllers\RegisterController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/home', function () {
    return view('home/index', [
                "tittle" => "home"
            ]);
});

Route::get('/logout', function () {
    return view('logout', [
                "tittle" => "logout"
            ]);
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/authenticate', [LoginController::class, 'authenticate'])->name('authenticate');
Route::post('/login', [LoginController::class, 'logout']);
Route::post('/home', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'index']);
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/parkir', [ParkingLotsController::class, 'index']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth')->name('dashboard');

Route::get('parkiranku', [ParkirankuController::class, 'index'])->middleware('auth')->name('parkiranku');;

Route::get('/main', function () {
    return view('layout/main');
});