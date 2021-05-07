<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Route;
use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string
     */
    protected $user_route  = 'user.login';
    protected $conveniencestore_route = 'conveniencestore.login';

    protected function redirectTo($request)
    {
        // ルーティングに応じて未ログイン時のリダイレクト先を振り分ける
        if (!$request->expectsJson()) {
            if (Route::is('user.*')) {
                return route($this->user_route);
            } elseif (Route::is('conveniencestore.*')) {
                return route($this->conveniencestore_route);
            }
        }
    }
}
