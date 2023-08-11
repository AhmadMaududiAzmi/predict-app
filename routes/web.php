<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExampleController;
use App\Http\Controllers\PrediksiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\GrafikController;
use App\Http\Controllers\ListComodityController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\PriceComodityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DataController;
use App\Models\DaftarKomoditas;
use App\Models\ListComodities;
use Illuminate\Support\Facades\Auth;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;

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

//data
Route::get('/data', [DataController::class, 'data']);
Route::get('/filter', [DataController::class, 'getNotInt']);

// Auth
Auth::routes();
// Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login_user', [LoginController::class, 'loginUser']);
// Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/', function(){
    return redirect('login');
});

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
// Grafik
Route::resource('/grafik', GrafikController::class);
// Route::get('/grafik/{request}', [GrafikController::class, 'store'])->name('grafik.store');
// Route::get('/grafik', [GrafikController::class, 'index']);
  
// Comodities - List Comodity
Route::resource('/komoditas/listkomoditas', ListComodityController::class);
Route::get('/komoditas/listkomoditas/{id}', function(ListComodities $comodities) {
    return $comodities;
});
   
// Comodities - Detail Comodities
Route::get('/detail/{id}', [DetailController::class, 'index']);
Route::post('/detail/{id}', [DetailController::class, 'index']);
Route::get('/detail/{id}', [DetailController::class, 'store'])->name('grafik.store');
Route::get('/detail/{id}', [DetailController::class, 'show']);
    
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
    
// Model Predict Get From API
Route::get('/getcomodities', function()
{
    $client = new Client();
    $api_url = "http://127.0.0.1:8008/api/v1/getcomodities";
    // $api_url = config('app.guzzle_test_url'.'/api/v1/getcomodities');
    $res = $client->get($api_url, [
        'query' => [               
            'nm_pasar' => 'Pasar Blimbing'
        ]
    ]);
    $data_body = $res->getBody();
    echo $data_body;
});

            