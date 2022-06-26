<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::post('register', 'App\Http\Controllers\Api\AuthController@register');
Route::post('login', 'App\Http\Controllers\Api\AuthController@login');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('customer', 'App\Http\Controllers\Api\CustomerController@index');
    Route::get('customer/{id}', 'App\Http\Controllers\Api\CustomerController@show');
    Route::post('customer', 'App\Http\Controllers\Api\CustomerController@store');
    Route::put('customer/{id}', 'App\Http\Controllers\Api\CustomerController@update');
    Route::delete('customer/{id}', 'App\Http\Controllers\Api\CustomerController@destroy');

    Route::post('addTransaksi', 'App\Http\Controllers\Api\CustomerController@addTransaksi');
    Route::get('showTransaksi', 'App\Http\Controllers\Api\TransaksiController@showTransaksi');
    Route::put('updateStatus/{id}', 'App\Http\Controllers\Api\TransaksiController@update');

    Route::get('user', 'App\Http\Controllers\Api\AuthController@index');
    Route::get('user/{id}', 'App\Http\Controllers\Api\AuthController@show');
    Route::put('user/{id}', 'App\Http\Controllers\Api\AuthController@update');
    Route::delete('user/{id}', 'App\Http\Controllers\Api\AuthController@destroy');

    Route::get('promo', 'App\Http\Controllers\Api\PromoController@index');
    Route::get('promo/{id}', 'App\Http\Controllers\Api\PromoController@show');
    Route::post('promo', 'App\Http\Controllers\Api\PromoController@store');
    Route::put('promo/{id}', 'App\Http\Controllers\Api\PromoController@update');
    Route::delete('promo/{id}', 'App\Http\Controllers\Api\PromoController@destroy');

    Route::get('mobil', 'App\Http\Controllers\Api\MobilController@index');
    Route::get('mobil/{id}', 'App\Http\Controllers\Api\MobilController@show');
    Route::post('mobil', 'App\Http\Controllers\Api\MobilController@store');
    Route::put('mobil/{id}', 'App\Http\Controllers\Api\MobilController@update');
    Route::delete('mobil/{id}', 'App\Http\Controllers\Api\MobilController@destroy');

    Route::get('pegawai', 'App\Http\Controllers\Api\PegawaiController@index');
    Route::get('pegawai/{id}', 'App\Http\Controllers\Api\PegawaiController@show');
    Route::post('pegawai', 'App\Http\Controllers\Api\PegawaiController@store');
    Route::put('pegawai/{id}', 'App\Http\Controllers\Api\PegawaiController@update');
    Route::delete('pegawai/{id}', 'App\Http\Controllers\Api\PegawaiController@destroy');

    Route::get('driver', 'App\Http\Controllers\Api\DriverController@index');
    Route::get('driver/{id}', 'App\Http\Controllers\Api\DriverController@show');
    Route::post('driver', 'App\Http\Controllers\Api\DriverController@store');
    Route::put('driver/{id}', 'App\Http\Controllers\Api\DriverController@update');
    Route::delete('driver/{id}', 'App\Http\Controllers\Api\DriverController@destroy');

    Route::get('mitra', 'App\Http\Controllers\Api\MitraController@index');
    Route::get('mitra/{id}', 'App\Http\Controllers\Api\MitraController@show');
    Route::post('mitra', 'App\Http\Controllers\Api\MitraController@store');
    Route::put('mitra/{id}', 'App\Http\Controllers\Api\MitraController@update');
    Route::delete('mitra/{id}', 'App\Http\Controllers\Api\MitraController@destroy');

    Route::get('jadwal', 'App\Http\Controllers\Api\JadwalController@index');
    Route::get('jadwal/{id}', 'App\Http\Controllers\Api\JadwalController@show');
    Route::post('jadwal', 'App\Http\Controllers\Api\JadwalController@store');
    Route::put('jadwal/{id}', 'App\Http\Controllers\Api\JadwalController@update');
    Route::delete('jadwal/{id}', 'App\Http\Controllers\Api\JadwalController@destroy');

    Route::put('date/{id}','App\Http\Controllers\Api\AuthController@update_date');
    Route::post('logout','App\Http\Controllers\Api\AuthController@logout');

});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
