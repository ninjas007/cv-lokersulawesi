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

Route::get('/', 'JobController@index');

Route::get('/lowongan', 'JobController@index');
Route::get('/lowongan/{slug}', 'JobController@show');
Route::get('/pasang-lowongan', 'JobController@pasangLowongan');
Route::post('/pasang-lowongan/store', 'JobController@postLoker');
Route::get('/about', function() {
    return view('jobs.about', [
        'about' => true
    ]);
});

Auth::routes();

Route::get('/auth/{provider}', 'Auth\LoginController@redirectToProvider');
Route::get('/auth/{provider}/callback', 'Auth\LoginController@handleProviderCallback');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/history', 'HistoryController@index');

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

Route::get('/scrap', 'ScrapController@index');
