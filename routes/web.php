<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DietasController;
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
    Route::post('/profile/bmi/calculate', [ProfileController::class, 'calculateBmi'])->name('profile.bmi.calculate');
    Route::post('/profile/bmi/clear', [ProfileController::class, 'clearBmi'])->name('profile.bmi.clear');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/dietas', [DietasController::class, 'index'])->name('dietas');
    Route::get('/dietas/{id}', [DietasController::class, 'show'])->name('dietas.show');
    Route::post('/dietas/activate/{id}', [DietasController::class, 'activate'])->name('dietas.activate');
    Route::post('/dietas/deactivate', [DietasController::class, 'deactivate'])->name('dietas.deactivate');
});

require __DIR__.'/auth.php';
