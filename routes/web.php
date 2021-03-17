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
})->name('public.home');

// Access only to logged users

Route::middleware('auth')->group(function () {

    Route::get('dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');

    Route::get('settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
    Route::put('settings-update-base', [\App\Http\Controllers\SettingsController::class, 'updateBaseData'])->name('settings.update_base');

    Route::resource('wallets', \App\Http\Controllers\WalletController::class)->except('index', 'show');
    Route::resource('transactions', \App\Http\Controllers\TransactionController::class)->except('show');

});


// Users routes
Route::middleware('auth')->group(function () {
//
});

Route::get('logout', [\App\Http\Controllers\UserController::class, 'logout'])->name('logout');
Route::post('change-password', [\App\Http\Controllers\UserController::class, 'storeNewPassword'])->name('change.password');

Route::middleware('guest')->group(function () {
//
});
Route::get('register', [\App\Http\Controllers\UserController::class, 'create'])->name('register');
Route::post('register', [\App\Http\Controllers\UserController::class, 'store']);
Route::get('login', [\App\Http\Controllers\UserController::class, 'loginForm'])->name('login');
Route::post('login', [\App\Http\Controllers\UserController::class, 'login']);

Route::fallback(function () {
    abort(404,);
});
