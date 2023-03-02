<?php

use App\Http\Controllers\DataTableController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/', [UserController::class, 'dashboard'])->name('user.dashboard');

    Route::get('/deposit', [UserController::class, 'viewDeposit'])->name('user.viewDeposit');
    Route::post('/deposit', [UserController::class, 'addDeposit'])->name('user.addDeposit');

    Route::get('/withdraw', [UserController::class, 'viewWithdraw'])->name('user.viewWithdraw');
    Route::post('/withdraw', [UserController::class, 'addWithdraw'])->name('user.addWithdraw');

    Route::get('/transfer', [UserController::class, 'viewTransfer'])->name('user.viewTransfer');
    Route::post('/transfer', [UserController::class, 'addTransfer'])->name('user.addTransfer');

    Route::get('/statements', [UserController::class, 'viewStatements'])->name('user.viewStatements');

    Route::get('/get-user-data', [UserController::class, 'getUserData'])->name('user.getUserData');
    Route::get('/get-statements-data', [DataTableController::class, 'getStatementData'])->name('user.getStatementData');

    Route::get('/view-profile', [UserController::class, 'editProfile'])->name('user.editProfile');
    Route::post('/update-profile', [UserController::class, 'updateProfile'])->name('user.updateProfile');


    Route::post('/update-password', [UserController::class, 'updatePassword'])->name('user.updatePassword');


    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
