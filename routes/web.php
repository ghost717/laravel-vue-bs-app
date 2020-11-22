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
    return view('home');
});

Auth::routes();

Route::prefix('api')->group(function () {
    Route::get('items', 'ItemController@index');
    Route::get('items/{id}', 'ItemController@show');
    Route::post('items', 'ItemController@store');
    Route::put('items/{$id}', 'ItemController@update');
    // Route::post('items/{$id}', 'ItemController@update');
    Route::delete('items/{id}', 'ItemController@destroy');

    Route::get('export/', 'ItemController@export');
    Route::get('items1', 'ItemController@getEquipment');
    Route::get('items2', 'ItemController@getSteady');
    Route::get('items3', 'ItemController@getNull');
});
