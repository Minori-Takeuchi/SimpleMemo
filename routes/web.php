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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/top', 'MemoController@index')->name('top');
Route::post('/store', 'MemoController@store')->name('store');
Route::get('/edit/{id}', 'MemoController@edit')->name('edit');
Route::post('/update', 'MemoController@update')->name('update');
Route::post('/delete/{id}', 'MemoController@delete')->name('delete');
