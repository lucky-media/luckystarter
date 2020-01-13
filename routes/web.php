<?php

Route::redirect('/', '/admin/home');

Auth::routes(['register' => false]);

// Change Password Routes...
Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    // Admin Home Controller
    Route::get('/home', 'HomeController@index')->name('home');

    // Permissions Resource
    Route::resource('permissions', 'PermissionsController');

    // Roles Resource
    Route::resource('roles', 'RolesController');

    // Users Resource
    Route::resource('users', 'UsersController');
});
