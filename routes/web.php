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
    return view('welcome');
});

Auth::routes();

Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');

// cv-kerja
Route::prefix('cv-kerja')->group(function() {
    Route::get('/', 'CvKerjaController@index');
    Route::post('/preview', 'CvKerjaController@preview');
});

// order
Route::prefix('order')->group(function() {
    Route::post('/', 'OrderController@index')->name('order');
    Route::get('/checkout', 'OrderController@checkout')->name('order.checkout');
    Route::get('/download', 'OrderController@download')->name('order.download');
    Route::get('/save', 'OrderController@saveData')->name('order.save');
});

Route::get('/akun/transaksi', 'UserController@transaksi');
Route::post('/payments/midtrans-notification', 'PaymentCallbackController@receive');
