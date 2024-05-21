<?php

use App\Http\Controllers\Crud;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginRegister;
use App\Http\Controllers\InterfacePHP; 

// ADMIN
Route::get('admin', [Crud::class, 'userData'])->name('admin')->middleware('auth', 'verified', 'admin');

// INTERFACE
Route::get('/', [InterfacePHP::class, 'index'])->name('/');
Route::get('home', [InterfacePHP::class, 'index'])->name('home')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::get('profile', [InterfacePHP::class, 'profile'])->name('profile')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::get('/pesan', [InterfacePHP::class, 'pesan'])->name('pesan')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::get('/riwayat_detail/{id}', [InterfacePHP::class, 'riwayat_detail'])->name('riwayat_detail')->middleware('auth', 'verified', 'hasProfileFormFilled');

// CRUD
Route::post('username', [Crud::class, 'username'])->name('username')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::post('storealamat', [Crud::class, 'storealamat'])->name('storealamat')->middleware('auth', 'verified');
Route::post('pesansekarang', [Crud::class, 'pesansekarang'])->name('pesansekarang')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::post('pay', [Crud::class, 'pay'])->name('pay')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::post('/update-payment-status', [Crud::class, 'updatePaymentStatus'])->name('updatePaymentStatus')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::post('pushrole', [Crud::class, 'pushrole'])->name('pushrole')->middleware('auth', 'verified', 'admin');
Route::get('bayar', [Crud::class, 'bayar'])->name('bayar')->middleware('auth', 'verified', 'hasProfileFormFilled');
Route::get('alamat', [Crud::class, 'alamat'])->name('alamat')->middleware('auth', 'verified');
Route::get('alamat/kota/{id}', [Crud::class, 'showKota'])->name('showKota')->middleware('auth', 'verified');
Route::get('alamat/kodepos/{id}', [Crud::class, 'showKodepos'])->name('showKodepos')->middleware('auth', 'verified');
Route::post('check-ongkir', [Crud::class, 'checkOngkir'])->name('check-ongkir');

Route::get('/pesanan', [Crud::class, 'pesanan'])->name('pesanan')->middleware('auth', 'verified');
Route::get('/pesanansaya', [Crud::class, 'pesanansaya'])->name('pesanansaya')->middleware('auth', 'verified');
Route::get('/detail/{id}', [Crud::class, 'detail_pesanan'])->name('detail')->middleware('auth', 'verified');
Route::get('/status/{no_pesanan}/{status}/{resi}', [Crud::class, 'id_status'])->name('status')->middleware('auth', 'verified');


Route::get('/pemesanan', function () {return view('form-pemesanan');})->name('form_pemesanan');

Route::get('/resetemail', function () {return view('resetemail');})->name('reset_email');


// LOGIN
Route::get('/login', [InterfacePHP::class, 'login'])->name('login');
Route::post('actionlogin', [LoginRegister::class, 'actionlogin'])->name('actionlogin');
Route::get('/auth/google', [LoginRegister::class, 'redirectgoogle'])->name('googlelogin');
Route::get('/auth/google/callback', [LoginRegister::class, 'handlergoogle'])->name('googlecallback');
Route::post('actionregister', [LoginRegister::class, 'actionregister'])->name('actionregister');
Route::get('actionlogout', [LoginRegister::class, 'actionlogout'])->name('actionlogout')->middleware('auth');
Route::get('/email/verify', [LoginRegister::class, 'emailverify'])->middleware('auth')->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [LoginRegister::class, 'verifverify'])->middleware(['auth', 'signed'])->name('verification.verify');
Route::post('/forgot-password', [LoginRegister::class, 'forgotpassword'])->name('password.email');
Route::get('/reset-password/{token}', [LoginRegister::class, 'restpwtkn'])->name('password.reset');
Route::post('/reset-password', [LoginRegister::class, 'restpw'])->name('password.update');
