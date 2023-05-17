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

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/cv-kerja', 'CvKerjaController@index');
Route::get('/akun', function() {
    return 'Masih Proses Pengembangan';
});
Route::post('/preview', 'CvKerjaController@preview');
Route::post('/download', 'CvKerjaController@download');
Route::get('/pembayaran', 'PaymentController@pembayaran');
Route::post('/payments/midtrans-notification', 'PaymentCallbackController@receive');
Route::get('/download-pdf', 'CvKerjaController@downloadPdf');

Route::get('/test', function() {
    return view('menus.preview')->render();
});
