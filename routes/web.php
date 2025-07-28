<?php

use App\Http\Controllers\VeterinarioController;
use App\Http\Controllers\EspecialidadController;
use App\Http\Controllers\MapController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::resource('veterinarios', VeterinarioController::class);

Route::resource('especialidades', EspecialidadController::class);

Route::get('/map', [MapController::class, 'index'])->name('map.index');
Route::get('/veterinarians/json', [MapController::class, 'getVeterinarians'])->name('veterinarians.json');
Route::get('/nearby-veterinarians', [MapController::class, 'getNearbyVeterinarians'])->name('nearby.veterinarians');

require __DIR__.'/auth.php';
