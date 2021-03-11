<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Main page
Route::get('/', function () {
    return view('public.home');
});

// Access only to logged users

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::put('settings-update-base', [\App\Http\Controllers\SettingsController::class, 'updateBaseData'])->name('settings.update_base');

    Route::resource('wallets', \App\Http\Controllers\WalletController::class)->except('index', 'show');
    Route::resource('transactions', \App\Http\Controllers\TransactionController::class)->except('show');

});


require __DIR__ . '/auth.php';
