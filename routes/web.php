<?php

Route::get('/home', 'HomeController@index')->name('home');

// reset password callback
/*Route::get('/reset-password/{token}', 'Auth\ResetPasswordController@resetPassword')
    ->name('reset-password');*/

Route::get('user/reset-password/{token}', 'User\Auth\ResetPasswordController@showResetForm')
    ->name('password.reset');

// reset password
Route::post('user/password/reset', 'User\Auth\ResetPasswordController@reset')
    ->name('password.update');


Route::get('/{any}', function () {
    return view('index');
})->where('any', '.*');
