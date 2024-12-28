<?php

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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::get('/', [App\Http\Controllers\MainController::class, 'index'])->name('home');


Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile'])->name('profile');

Route::get('/profile-update', [App\Http\Controllers\HomeController::class, 'profileUpdate'])->name('profile-update');
Route::post('/profile-update', [App\Http\Controllers\HomeController::class, 'profileUpdateSubmit']);


Route::get('/account-create', [App\Http\Controllers\AccountController::class, 'create'])->name('account-create');
Route::post('/account-create', [App\Http\Controllers\AccountController::class, 'createSubmit']);

Route::get('/account-edit/{id}', [App\Http\Controllers\AccountController::class, 'edit'])->name('account-edit');
Route::post('/account-edit/{id}', [App\Http\Controllers\AccountController::class, 'editSubmit']);

Route::get('/accounts', [App\Http\Controllers\AccountController::class, 'view'])->name('accounts');

Route::get('/transactions', [App\Http\Controllers\TransactionController::class, 'view'])->name('transactions');

Route::get('/transaction-create/income',[\App\Http\Controllers\TransactionController::class, 'createIncome'])->name('transaction-create-income');
Route::post('/transaction-create/income',[\App\Http\Controllers\TransactionController::class, 'createIncomeSubmit']);

Route::get('/transaction-create/expense',[\App\Http\Controllers\TransactionController::class, 'createExpense'])->name('transaction-create-expense');
Route::post('/transaction-create/expense',[\App\Http\Controllers\TransactionController::class, 'createExpenseSubmit']);

Route::get('/transaction-create/between',[\App\Http\Controllers\TransactionController::class, 'createBetween'])->name('transaction-create-between');
Route::post('/transaction-create/between',[\App\Http\Controllers\TransactionController::class, 'createBetweenSubmit']);
