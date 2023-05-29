<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListComodityController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PriceComodityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Models\DaftarKomoditas;
use App\Models\ListComodities;
use Illuminate\Support\Facades\Auth;

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


// Auth
Auth::routes();
// Route::get('/login', [LoginController::class, 'index']);
// Route::post('/login', [LoginController::class, 'login'])->name('auth.login');
// Route::get('logout', [LoginController::class, 'logout']);
// Route::permanentRedirect('/login');


// Maintenance 
Route::get('/maintenance', function () {
    $pagename = '';
    return view('maintenance', compact('pagename'));
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Grafik
Route::resource('/grafik', GrafikController::class);

// Comodities - List Comodity
Route::resource('/komoditas/listkomoditas', ListComodityController::class);
Route::get('/komoditas/listkomoditas/{id}', function(ListComodities $comodities) {
    return $comodities;
});

// Comodities - Detail Comodities
// Route::resource('user', UserController::class);
Route::get('/detail', function(){
    $pagename = "Detail Komoditas";
    return view('detail.index', compact('pagename'));
});

// Comodities - Comodities Price
Route::get('/komoditas/hargakomoditas', [PriceComodityController::class, 'index']);

// Markets
Route::resource('/pasar', MarketController::class);

// Users - List Users
Route::get('/pengguna/daftar_pengguna', [UserController::class, 'index'])->name('list-user');

// Users - List Roles
Route::get('/pengguna/daftar_peran', [RoleController::class, 'index']);

// Logs

// Setting

// Model predict
Route::get('/testpython', [ExampleController::class, 'index']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
