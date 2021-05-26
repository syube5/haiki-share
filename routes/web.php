<?php

Route::get('/home', 'HomeController@index')->name('home');

// reset password callback
Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

// reset password
Route::post('/password/reset', 'Auth\ResetPasswordController@reset')
    ->name('password.update');


Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
