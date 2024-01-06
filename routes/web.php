<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KulinerController;
use App\Http\Controllers\DetailController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [KulinerController::class, 'index']);

Route::get('/dashboard', [KulinerController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/list/{id}', [KulinerController::class, 'show'])->name('detail-menu');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/kuliner', [KulinerController::class, 'data'])->name('kuliner');
    Route::post('/kuliner/store', [KulinerController::class, 'store'])->name('kuliners.store');
    Route::get('/kuliner/{id}/edit', [KulinerController::class, 'edit'])->name('kuliners.edit');
    Route::put('/kuliner/{id}', [KulinerController::class, 'update'])->name('kuliners.update');
    Route::delete('/kuliner/{id}', [KulinerController::class, 'destroy'])->name('kuliners.destroy');

    Route::get('/menu', [DetailController::class, 'data'])->name('details.data');
    Route::post('/menu/store', [DetailController::class, 'store'])->name('details.store');
    Route::get('/menu/{id}/edit', [DetailController::class, 'edit'])->name('details.edit');
    Route::put('/menu/{id}', [DetailController::class, 'update'])->name('details.update');
    Route::delete('/menu/{id}', [DetailController::class, 'destroy'])->name('details.destroy');
});

require __DIR__.'/auth.php';
