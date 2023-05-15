<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ListComodityController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PriceComodityController;

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
Route::get('/login', [LoginController::class, 'index']);

// Maintenance 
Route::get('/maintenance', function () {
    $pagename = '';
    return view('maintenance', compact('pagename'));
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index']);

// Grafik
Route::get('/grafik', [GrafikController::class, 'index']);

// Comodities - List Comodity
Route::get('/komoditas/listkomoditas', [ListComodityController::class, 'index']);

// Comodities - Comodities Price
Route::get('/komoditas/hargakomoditas', [PriceComodityController::class, 'index']);

// Markets
Route::get('/pasar', [MarketController::class, 'index']);

// Logs

// Setting

// Model predict
Route::get('/testpython', [ExampleController::class, 'index']);
