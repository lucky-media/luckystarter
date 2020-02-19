<?php

Auth::routes(['register' => false]);

Route::group(['namespace' => 'Admin', 'middleware' => ['auth'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::redirect('/', '/admin/home');
    Route::get('/home', 'IndexController@index')->name('home');
    Route::resource('permissions', 'PermissionsController')->except(['create', 'show']);
    Route::resource('roles', 'RolesController');
    Route::resource('users', 'UsersController');
});


Route::group(['namespace' => 'Front'], function () {
    Route::get('/', 'IndexController@index');
});