<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PakaianController;

// auth
Route::get('/auth', function () {
    return view('auth');
});


// karyawan
Route::get('/karyawan', [KaryawanController::class, 'loadAllKaryawan'])->name('karyawan');
Route::get('/add/karyawan', [KaryawanController::class, 'loadAllKaryawanForm']);
Route::post('/add/karyawan', [KaryawanController::class, 'AddKaryawan'])->name('AddKaryawan');
Route::get('/updateKaryawan/{id}', [KaryawanController::class, 'loadEditForm']);
Route::post('/updateKaryawan/user', [KaryawanController::class, 'EditKaryawan'])->name('EditKaryawan');
Route::get('/deleteKaryawan/{id}', [KaryawanController::class, 'deleteKaryawan']);

// pakaian
Route::get('/pakaian', [PakaianController::class, 'loadAllPakaian'])->name('pakaian');
Route::get('/add/pakaian', [PakaianController::class, 'loadAllPakaianForm']);
Route::post('/add/pakaian', [PakaianController::class, 'AddPakaian'])->name('AddPakaian');
Route::get('/updatePakaian/{id}', [PakaianController::class, 'loadEditForm']);
Route::post('/updatePakaian/user', [PakaianController::class, 'EditPakaian'])->name('EditPakaian');
Route::get('/deletePakaian/{id}', [PakaianController::class, 'deletePakaian']);


//order
Route::get('/', [OrderController::class, 'loadAllOrder'])->name('order');
Route::get('/add/order', [OrderController::class, 'loadAllOrderForm']);
Route::post('/add/order', [OrderController::class, 'AddOrder'])->name('AddOrder');
Route::get('/updateOrder/{id}', [OrderController::class, 'loadEditForm']);
Route::post('/updateOrder/user', [OrderController::class, 'EditOrder'])->name('EditOrder');
Route::get('/deleteOrder/{id}', [OrderController::class, 'deleteOrder']);
