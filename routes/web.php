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
use SimpleSoftwareIO\QrCode\Facades\QrCode;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

if (app()->environment('local') && env('APP_DEBUG')) {
    Route::get('loginas/{id}', function ($id) {
        auth()->loginUsingId($id, true);

        return back();
    });
}

Route::view('transactions', 'echo-test');

Route::get('job', function () {
    return QrCode::size(666)
                 ->generate(route('firejob'));
});

Route::get('firejob', function () {
    event(new shiraishi\Events\TransactionProcessed(User::find(1)));
})->name('firejob');
