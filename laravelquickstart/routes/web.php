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


Route::get('/home', 'HomeController@index')->name('home');


Route::get('/tasks', 'TaskController@index');
Route::post('/task', 'TaskController@store');
Route::delete('/task/{task}', 'TaskController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/transfers', 'TaskTransferController@index');
Route::post('/transfers', 'TaskTransferController@store');

Route::post('/canceled', 'TaskTransferController@cancel');

Route::post('/accepted', 'TaskTransferController@accept');
Route::post('/rejected', 'TaskTransferController@reject');

Route::get('/history', 'TaskTransferController@history');
