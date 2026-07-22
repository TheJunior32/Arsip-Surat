<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SuratMasukController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SuratKeluarController;
use App\Http\Controllers\Auth\FirebaseLoginController;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('surat-masuk', SuratMasukController::class);
    Route::resource('surat-keluar', SuratKeluarController::class);
    Route::get('/surat-masuk/{suratMasuk}/pdf', [SuratMasukController::class, 'pdf'])->name('surat-masuk.pdf');
});

Route::middleware('firebase.auth')->post('/login/firebase', [FirebaseLoginController::class, 'login'])
    ->name('login.firebase');

require __DIR__.'/auth.php';

### Email : admin@example.com
### Password : secret123