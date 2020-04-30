<?php

use Illuminate\Support\Facades\Route;

Auth::routes(['register' => false]);

Route::get('/', 'HomeController@index')->name('home');

Route::middleware('auth', 'verified')->group(function () {
    Route::resource('users', 'UserController', [
        'only' => ['create', 'edit', 'update', 'destroy'],
        'parameters' => ['user' => 'user']
    ]);
    Route::get('/users/new', 'UserController@new')->name('user.new');
    // Route::post('/users/create', 'UserController@create')->name('user.create');
});
