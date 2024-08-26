<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\AmountController;

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

    Route::get('/currencies', [CurrencyController::class, 'index'])->name('currencies.index');
    Route::post('/currencies', [CurrencyController::class, 'store'])->name('currencies.store');
    Route::put('/currencies/{currency}', [CurrencyController::class, 'update'])->name('currencies.update');
    Route::delete('/currencies/{currency}', [CurrencyController::class, 'destroy'])->name('currencies.destroy');

    Route::get('/amounts', [AmountController::class, 'index'])->name('amounts.index');
    Route::post('/amounts', [AmountController::class, 'store'])->name('amounts.store');
    Route::put('/amounts/{amount}', [AmountController::class, 'update'])->name('amounts.update');
    Route::delete('/amounts/{amount}', [AmountController::class, 'destroy'])->name('amounts.destroy');

});

require __DIR__.'/auth.php';
