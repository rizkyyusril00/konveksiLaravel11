<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PakaianController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\SupplierController;
use Illuminate\Auth\Middleware\Authenticate;

// auth
// Route::get('/auth2', function () {
//     return view('auth2');
// });
// Route::get('/invoice', function () {
//     return view('Invoice.invoice');
// });
// Route::get('/invoice/{id}', [OrderController::class, 'invoice']);
// Route::get('/po/{id}', [OrderController::class, 'po']);


// auth
Route::get('/auth', [AuthController::class, 'index'])->name('login')->middleware('guest');
Route::post('/auth', [AuthController::class, 'verify'])->name('AuthVerify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


// inovice
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/invoice/{id}', [OrderController::class, 'invoice']);
});

// po
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/po/{id}', [OrderController::class, 'po']);
});

// Karyawan
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/karyawan', [KaryawanController::class, 'loadAllKaryawan'])->name('karyawan');
    Route::get('/add/karyawan', [KaryawanController::class, 'loadAllKaryawanForm']);
    Route::post('/add/karyawan', [KaryawanController::class, 'AddKaryawan'])->name('AddKaryawan');
    Route::get('/updateKaryawan/{id}', [KaryawanController::class, 'loadEditForm']);
    Route::post('/updateKaryawan/user', [KaryawanController::class, 'EditKaryawan'])->name('EditKaryawan');
    Route::get('/deleteKaryawan/{id}', [KaryawanController::class, 'deleteKaryawan']);
});

// Pakaian
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/pakaian', [PakaianController::class, 'loadAllPakaian'])->name('pakaian');
    Route::get('/add/pakaian', [PakaianController::class, 'loadAllPakaianForm']);
    Route::post('/add/pakaian', [PakaianController::class, 'AddPakaian'])->name('AddPakaian');
    Route::get('/updatePakaian/{id}', [PakaianController::class, 'loadEditForm']);
    Route::post('/updatePakaian/user', [PakaianController::class, 'EditPakaian'])->name('EditPakaian');
    Route::get('/deletePakaian/{id}', [PakaianController::class, 'deletePakaian']);
});

// user untuk for super admin
Route::middleware('auth:admin')->group(function () {
    Route::get('/user', [UserController::class, 'loadAllUser'])->name('user');
    Route::get('/add/user', [UserController::class, 'loadAlluserForm']);
    Route::post('add/user', [UserController::class, 'AddUser'])->name('AddUser');
    Route::get('/updateUser/{id}', [UserController::class, 'loadEditForm']);
    Route::post('/updateUser/user', [UserController::class, 'EditUser'])->name('EditUser');
    Route::get('/deleteUser/{id}', [UserController::class, 'deleteUser']);
});

// supplier
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/supplier', [SupplierController::class, 'loadAllSupplier'])->name('supplier');
    Route::get('/add/supplier', [SupplierController::class, 'loadAllSupplierForm']);
    Route::post('add/supplier', [SupplierController::class, 'AddSupplier'])->name('AddSupplier');
    Route::get('/updateSupplier/{id}', [SupplierController::class, 'loadEditForm']);
    Route::post('/updateSupplier/user', [SupplierController::class, 'EditSupplier'])->name('EditSupplier');
    Route::get('/deleteSupplier/{id}', [SupplierController::class, 'deleteSupplier']);
});

// item
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/item', [ItemController::class, 'loadAllItem'])->name('item');
    Route::get('/add/item', [ItemController::class, 'loadAllItemForm']);
    Route::post('add/item', [ItemController::class, 'AddItem'])->name('AddItem');
    Route::get('/updateItem/{id}', [ItemController::class, 'loadEditForm']);
    Route::post('/updateItem/user', [ItemController::class, 'EditItem'])->name('EditItem');
    Route::get('/deleteItem/{id}', [ItemController::class, 'deleteItem']);
});

// customer
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/customer', [CustomerController::class, 'loadAllCustomer'])->name('customer');
    Route::get('/add/customer', [CustomerController::class, 'loadAllCustomerForm']);
    Route::post('add/customer', [CustomerController::class, 'AddCustomer'])->name('AddCustomer');
    Route::get('/updateCustomer/{id}', [CustomerController::class, 'loadEditForm']);
    Route::post('/updateCustomer/user', [CustomerController::class, 'EditCustomer'])->name('EditCustomer');
    Route::get('/deleteCustomer/{id}', [CustomerController::class, 'deleteCustomer']);
});

// Order
Route::middleware('auth:user,admin')->group(function () {
    Route::get('/', [OrderController::class, 'loadAllOrder'])->name('order');
    Route::get('/add/order', [OrderController::class, 'loadAllOrderForm']);
    Route::post('/add/order', [OrderController::class, 'AddOrder'])->name('AddOrder');
    Route::get('/updateOrder/{id}', [OrderController::class, 'loadEditForm']);
    Route::post('/updateOrder/user', [OrderController::class, 'EditOrder'])->name('EditOrder');
    Route::get('/deleteOrder/{id}', [OrderController::class, 'deleteOrder']);
});
