<?php

use App\Models\Pilihan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPesertaController;

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

Route::get('/', function () {
    return view('home', [
        'pilihans' => Pilihan::where('jenis', 'offline')->get()
    ]);
});

Route::get('/kategori/{jenis}',  [HomeController::class, 'checkPilihan']);
Route::post('/home',  [HomeController::class, 'store']);
Route::get('/pembayaran', function () {
    return view('pembayaran');
});

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/dashboard', function(){
    return view('dashboard.index');
})->middleware('auth');

Route::resource('/dashboard/peserta', DashboardPesertaController::class)->middleware('auth');