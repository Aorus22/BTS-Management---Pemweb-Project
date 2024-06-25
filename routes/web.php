<?php

use App\Http\Controllers\BTSController;
use App\Http\Controllers\JenisBtsController;
use App\Http\Controllers\KuesionerController;
use App\Http\Controllers\PenggunaRouterController;
use App\Http\Controllers\PilihanKuesionerController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WilayahController;
use App\Http\Controllers\PemilikController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::resource('jenis-bts', JenisBtsController::class);
Route::resource('wilayah', WilayahController::class);
Route::resource('pemilik', PemilikController::class);
Route::resource('bts', BTSController::class);
Route::resource('pengguna-router', PenggunaRouterController::class);
Route::resource('data-kuesioner', KuesionerController::class);
Route::resource('data-pilihan-kuesioner', PilihanKuesionerController::class);

Route::get('/data-kuesioner/{id_kuesioner}/data-pilihan-kuesioner/create', [PilihanKuesionerController::class, 'create']);
Route::post('/data-kuesioner/{id_kuesioner}/data-pilihan-kuesioner', [PilihanKuesionerController::class, 'store']);
Route::delete('/data-kuesioner/{id_kuesioner}/data-pilihan-kuesioner/{id}', [PilihanKuesionerController::class, 'destroy']);
Route::get('/data-kuesioner/{id_kuesioner}/data-pilihan-kuesioner/{id}', [PilihanKuesionerController::class, 'show']);
Route::put('/data-kuesioner/{id_kuesioner}/data-pilihan-kuesioner/{id}', [PilihanKuesionerController::class, 'update']);

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
