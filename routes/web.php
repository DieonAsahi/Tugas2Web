<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;

Route::get('/produk', function() {
    return "Menampilkan daftar produk";
});

Route::get('/keranjang', function() {
    return "Produk ditambahkan ke keranjang";
});

Route::get('/checkout', function() {
    return "Checkout berhasil";
});

Route::get('/order', function() {
    return "Menampilkan riwayat pesanan";
});

Route::get('/profil', function() {
    return "Menampilkan profil pengguna";
});

Route::get('/helloworld', function() {
    return "ini adalah halaman web";
});

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});

require __DIR__.'/auth.php';
