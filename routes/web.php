<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('users', 'UserController');
});

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('items', 'ItemController')->only([
        'update'
    ]);
});
