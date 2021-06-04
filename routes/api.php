<?php

use Illuminate\Http\Request;

Route::post('/user/register', 'User\Auth\RegisterController@register')->name('register');

Route::post('/user/login', 'User\Auth\LoginController@login')->name('login');

Route::post('/user/logout', 'User\Auth\LoginController@logout')->name('logout');

Route::post('/user/password/email', 'User\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

Route::get('/user/password/reset/{token}', 'User\Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::post('/user/password/reset/', 'User\Auth\ResetPasswordController@reset')->name('reset');

Route::patch('/user/edit-profile', 'User\EditProfileController@editProfile')->name('user.edit-profile');

// ログインユーザー
Route::get('/user', function () {
    return Auth::user();
})->name('user');

// トークンリフレッシュ
Route::get('/refresh-token', function (Illuminate\Http\Request $request) {
    $request->session()->regenerateToken();
    return response()->json();
})->name('refresh-token');

/*

/*
// ユーザー
Route::namespace('User')->prefix('user')->name('user.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:user')->group(function () {

        // TOPページ
        Route::get('/home', 'HomeController@index')->name('home');
        // マイページ編集
        Route::get('/edit-profile', 'ProfileController@showProfileEditForm')->name('edit-profile');
    });
});

// コンビニ
Route::namespace('Conveniencestore')->prefix('conveniencestore')->name('conveniencestore.')->group(function () {

    // ログイン認証関連
    Auth::routes([
        'register' => true,
        'reset'    => true,
        'verify'   => false
    ]);

    // ログイン認証後
    Route::middleware('auth:conveniencestore')->group(function () {

        // TOPページ
        Route::get('/home', 'HomeController@index')->name('home');
    });
});
*/
