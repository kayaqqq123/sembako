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
    return view('layouts.master');
});
Route::get('/sembako_index/{input}','goods\Sembako@index')->name('sembako.index');
Route::get('/tambah_sembako','goods\Sembako@create')->name('sembako.create');
Route::post('/tambah_sembako','goods\Sembako@store')->name('sembako.store');
Route::get('/sembako/edit/{id}/{input}','goods\Sembako@edit')->name('sembako.edit.input');
Route::match(['put','patch'],'/sembako/edit/{id}/{input}','goods\Sembako@update')->name('sembako.update');
Route::delete('/sembako/delete/{id}','goods\Sembako@destroy')->name('sembako.destroy');
