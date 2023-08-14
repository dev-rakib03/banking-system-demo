<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TransactionController;

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



//Login page
Route::get('/login', [UserController::class, 'loginview']);
Route::post('/login', [UserController::class, 'login'])->name('login');

//Logout
Route::post('/logout', [UserController::class, 'logout'])->name('logout');

//Registration
Route::get('/users', [UserController::class, 'signup']);
Route::post('/users', [UserController::class, 'create'])->name('register');

//Authenticated
Route::middleware(['auth'])->group(function () {
    //Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index']);

    //All Transactions
    Route::get('/all-transactions', [TransactionController::class, 'showAllTransactionsAndBalance'])->name('transactions');

    //Deposit
    Route::get('/deposit', [TransactionController::class, 'showAllDeposits'])->name('deposit.all');
    Route::post('/deposit', [TransactionController::class, 'deposit'])->name('deposit.add');

    //Withdrawals
    Route::get('/withdrawal', [TransactionController::class, 'showAllWithdrawals'])->name('withdrawal.all');
    Route::post('/withdrawal', [TransactionController::class, 'withdrawal'])->name('withdrawal.create');

});






