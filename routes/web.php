<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;

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

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('logout', [AuthController::class, 'logout']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', [TransaksiController::class, 'index_dashboard']);

    Route::post('/users/add', [UserController::class, 'store']);
    Route::post('/users/edit', [UserController::class, 'edit']);
    Route::post('/users/hapus', [UserController::class, 'hapus']);
    Route::get('/users', [UserController::class, 'index']);


    Route::get('/home', [TransaksiController::class, 'index']);
    Route::post('/transaksi/add',  [TransaksiController::class, 'store']);
    Route::post('/transaksi/admin/add',  [TransaksiController::class, 'store_from_admin']);
    Route::post('/transaksi/reject',  [TransaksiController::class, 'reject']);
    Route::post('/transaksi/approve',  [TransaksiController::class, 'approve']);

    Route::get('/cetak-all', [TransaksiController::class, 'cetak_all'])->name('cetak.all');

    Route::get('/transaksi', [TransaksiController::class, 'index_transaksi']);

    Route::get('/profile-admin', [UserController::class, 'index_profile_admin']);
    Route::get('/profile', [UserController::class, 'index_profile_user']);
    Route::post('/user/ubah_password', [UserController::class, 'ubahPassword']);
    Route::post('/admin/ubah_password', [UserController::class, 'ubahPasswordAdmin']);
});
