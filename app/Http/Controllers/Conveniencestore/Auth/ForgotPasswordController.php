<?php

namespace App\Http\Controllers\Conveniencestore\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:conveniencestore');
    }

    // コンビニ用のviewを指定
    public function showLinkRequestForm()
    {
        return view('conveniencestore.auth.passwords.email');
    }
    public function broker()
    {
        // 管理者ユーザ用のパスワードブローカーを指定
        return Password::broker('conveniencestores');
    }
}
