<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RevenueTypeController;
use App\Http\Controllers\RevenueSubTypeController;
use App\Http\Controllers\ExpenseTypeController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\RevenueController;
use App\Http\Controllers\ExpenseSubTypeController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('home',                      [HomeController::class, 'index']    )->name('home');
Route::resource('revenue_type',         RevenueTypeController::class        );
Route::resource('revenue_sub_type',     RevenueSubTypeController::class     );
Route::resource('expense_type',         ExpenseTypeController::class        );
Route::resource('expense_sub_type',     ExpenseSubTypeController::class     );
Route::resource('expense',              ExpenseController::class            );
Route::resource('revenue',              RevenueController::class            );