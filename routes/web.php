<?php

Route::get('/home', 'HomeController@index')->name('home');

// reset password callback
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')
    ->name('reset-password');

Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
