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

Route::get('/', function() {
    return view('welcome');
});

Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => 'auth'], function() {
    Route::get('/', 'Admin\\HomeController@index')->name('home');

    Route::resource('users', 'Admin\\UserController')->except('destroy');

    Route::get('user/{user}/address/create', 'Admin\\UserMetasController@create')->name('user.address.create');
    Route::post('user/{user}/address/store', 'Admin\\UserMetasController@store')->name('user.address.store');

    Route::resource('product', 'Admin\\ProductController')->except(['show', 'destroy']);
    Route::resource('categories', 'Admin\\CategoryController')->except(['show', 'destroy']);
    Route::resource('suppliers', 'Admin\\SupplierController')->except(['destroy']);
    Route::resource('manufacturers', 'Admin\\ManufacturerController')->except(['destroy']);
});

