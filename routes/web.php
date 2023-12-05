<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingController;
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

Route::get('/', function () {
    return redirect('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/currency', [CurrencyController::class, 'index'])->name('currency.index');
    Route::post('/save-udpate-currency', [CurrencyController::class, 'saveOrUpdateCurrency']);
    Route::get('/delete-currency/{id}', [CurrencyController::class, 'deleteCurrency']);
    Route::get('/currency/get', [CurrencyController::class, 'getCurrency']);
    Route::get('/sale', [CurrencyController::class, 'saleIndex'])->name('sale.index');
    Route::post('/save-udpate-sale', [CurrencyController::class, 'saveOrUpdateSale']);
    Route::get('/delete-sale/{id}', [CurrencyController::class, 'deleteSale']);
    Route::get('/sale/get', [CurrencyController::class, 'getSale']);
    Route::post('/sale/search', [CurrencyController::class, 'getSaleSearch']);
    Route::post('/purchase/search', [CurrencyController::class, 'getPurchaseSearch']);
    Route::get('/purchase', [CurrencyController::class, 'purchaseIndex'])->name('purchase.index');
    Route::post('/save-udpate-purchase', [CurrencyController::class, 'saveOrUpdatePurchase']);
    Route::get('/delete-purchase/{id}', [CurrencyController::class, 'deletePurchase']);
    Route::get('/purchase/get', [CurrencyController::class, 'getPurchase']);
    // Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    // Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    // Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    // Route::get('/users-list', [AuthController::class, 'usersList'])->name('user.list');
    // Route::get('/user-delete/{id}', [AuthController::class, 'userDelete'])->name('user.delete');
    // // Route::get('/settings/create', [SettingController::class, 'create'])->name('settings.create');
    // Route::get('/profile/setting', [SettingController::class, 'index'])->name('setting.index');
    // Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    // Route::get('/settings/{setting}/edit', [SettingController::class, 'edit'])->name('settings.edit');
    // Route::delete('/settings/{setting}', [SettingController::class, 'destroy'])->name('settings.destroy');
});
Route::get('create-user', [AuthController::class, 'createUser'])->name('create-user');

Route::post('/add-invited-user', [AuthController::class, 'addInvitedUser'])->name('add-invited-user');




Route::get('/magic-login/{token}', [AuthController::class, 'magicLogin']);
Route::get('/authenticationQr', [AuthController::class, 'authenticationQr'])->name('authenticationQr');
Route::post('/login-2fa', [AuthController::class, 'login2FA'])->name('login-2fa');

Route::get('auth/google', [AuthController::class, 'redirectToGoogle']);
Route::get('auth/google/callback', [AuthController::class, 'handleGoogleCallback']);
require __DIR__.'/auth.php';
