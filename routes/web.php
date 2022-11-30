<?php

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
    return redirect()->route('home');
});


Route::get('home',                      'HomeController@index'              )->name('home');
Route::resource('revenue_type',         'RevenueTypeController'             );
Route::resource('expense_type',         'ExpenseTypeController'             );
Route::resource('expense_sub_type',     'ExpenseSubTypeController'          );
