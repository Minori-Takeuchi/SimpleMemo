<?php

use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Auth::routes();

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'MemoController@index')->name('home');
    Route::get('/top', 'MemoController@index')->name('top');
    Route::post('/store', 'MemoController@store')->name('store');
    Route::get('/edit/{id}', 'MemoController@edit')->name('edit');
    Route::post('/update', 'MemoController@update')->name('update');
    Route::post('/delete/{id}', 'MemoController@delete')->name('delete');
});