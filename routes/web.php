<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepositController;
use App\Models\ParkingLot;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ParkingLotsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use Egulias\EmailValidator\Parser\Comment;
use GuzzleHttp\Middleware;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', function () {
    return view('home/index', [
                "tittle" => "home"
            ]);
});

Route::get('/tutorial', function () {
    return view('tutorial', [
                "tittle" => "tutorial"
            ]);
});


//___________________Belajar JSON________________

Route::get('/test', function () {
    return view('register/test', [
                "tittle" => "test"
            ]);
});

Route::get('/topup', function () {
    return view('dashboard/topup', [
                "tittle" => "topup"
            ]);
});

//__________________Belajar JSON_________________


Route::get('/bisnis', function () {
    return view('dashboard/bussines', [
                "tittle" => "dashboard-bisnis"
            ]);
});

Route::get('/home', function () {
    return view('home/index', [
                "tittle" => "home"
            ]);
});

Route::get('/admin', function () { return view('admin', [ "tittle" => "admin"]);
})->middleware('auth')->name('admin');

Route::get('/admin/report', [ReportController::class, 'index']);

Route::get('/admin/message', [ReportController::class, 'message']);
Route::get('/admin/user', [ReportController::class, 'user']);
Route::delete('/users/{id}', [UserController::class, 'delete'])->name('deleteUser');

// Route::get('/upload-photo', 'UserController@showUploadPhotoForm')->name('showUploadPhotoForm');
Route::post('/upload-photo', [UserController::class, 'uploadphoto'])->name('uploadPhoto');



Route::get('/tentang-kami', function () {
    return view('partial/customer', [
                "tittle" => "tentang kami"
            ]);
});

Route::get('/logout', function () {
    return view('logout', [
                "tittle" => "logout"
            ]);
});

Route::get('/user-detail', function () {
    return view('dashboard/detail', [
                "tittle" => "user-detail"
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
Route::get('/user-history', [DashboardController::class, 'history'])->middleware('auth')->name('history');


Route::get('/parkiranku', [ParkingLotsController::class, 'myparkir'])->name('parkinglots.parkiranku');
Route::get('/user-favorite', [FavoriteController::class, 'show']);

//-----------------------------------------------------delete---------------------------------------------
Route::delete('/parkiranku/{idparking}', [ParkingLotsController::class, 'destroy'])->name('parkir.destroy');

//------------------------------------Store---------------------------------------------------
Route::get('/registrasi', [ParkingLotsController::class, 'form']);
Route::post('/registrasi/store', [ParkingLotsController::class, 'store'])->name('registrasi.store');
//----------------------------------- end store ----------------------------------------------

//-----------------------------------------update -----------------------------------------------------------
Route::put('/parkinglots/{parkinglot}', [ParkingLotsController::class, 'update'])->name('parkinglot.update');
//-------------------------------------Detail--------------------------------------------------
Route::get('/parkinglots/{parkinglot}', [ParkingLotsController::class, 'show'])->name('parkinglot.show');


Route::post('/reservations/store', [ReservationController::class, 'store'])->name('reservation.store');
Route::delete('/reservations/{id}', [ReservationController::class, 'cancelParking'])->name('cancel-parking');
Route::get('/current-parking', [ReservationController::class, 'showCurrentParkingStatus'])->name('current-parking');

//-----------------------------Contact Us--------------------------------------------
Route::post('/tentang-kami/post', [ContactUsController::class, 'store'])->name('contact-us.store');
// Route::get('/admin', [ContactUsController::class, 'show'])->name('admin.show');
Route::delete('/delete-message/{id}', [ContactUsController::class, 'deleteMessage'])->name('delete-message');

//-----------------------------Report-------------------------------------------------
Route::post('/detail/report', [ReportController::class, 'store'])->name('report.store');
Route::delete('/admin/report/{id}', [ReportController::class, 'deleteReport'])->name('delete-report');
Route::get('/admin', [ReportController::class, 'show'])->name('reports.show');

Route::post('/dashboard/rating', [RatingController::class, 'store'])->name('ratings.store');

// Route::get('/parkiran', [ParkingLotsController::class, 'search'])->name('parkinglot.search');

Route::get('/parkinglots', [ParkingLotsController::class, 'index'])->name('parkinglot.index');

Route::post('/favorites', [FavoriteController::class, 'add'])->name('favorites.store');
Route::delete('/user-favorite/{id}', [FavoriteController::class, 'destroy'])->name('favorites.destroy');

Route::delete('/user-history/{id}', [DashboardController::class, 'destroyHistory'])->name('history.destroy');
Route::delete('/user-history/delete', [DashboardController::class, 'destroyAllHistory'])->name('allhistory.destroy');

Route::post('/payment/process', [PaymentController::class, 'processPayment'])->name('payment.process');

Route::put('/user-detail/{user}', [UserController::class, 'edit'])->name('user.update');


// Chart
Route::get('/dashboard-bisnis', [DashboardController::class, 'showBarChart']);
// Chart
