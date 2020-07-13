<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'covid19Controller@index')->name('covid.index');
//Route::get('/search', 'weatherController@index')->name('weather.index');
//Route::post('/search', 'weatherController@store')->name('weather.store');
