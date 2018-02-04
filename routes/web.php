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

use shiraishi\User;

Route::get('/', function () {
    if (auth()->user()) {
        return redirect()->route('shops.index');
    }

    return view('welcome');
});

Auth::routes();

if (app()->environment('local') && env('APP_DEBUG')) {
    Route::get('loginas/{id}', function ($id) {
        auth()->loginUsingId($id, true);

        return back();
    });
}

Route::view('transactions', 'echo-test');
Route::view('qr', 'qrscan');

Route::get('firejob', function () {
    event(new shiraishi\Events\TransactionProcessed(User::find(1)));
})->name('firejob');

Route::middleware('auth')->group(function () {
    Route::view('/', 'dashboard');
    Route::resource('shops', 'MerchantController');
    Route::resource('store', 'ProductController');
    Route::resource('orders', 'OrderController');
});

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::view('/', 'dashboard');
    Route::resource('users', 'UserController');
});
