<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('user');
    }

    public function showResetForm(Request $request, $token = null)
    {
        // 一般ユーザ用のviewを指定
        return view('user.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }
    public function broker()
    {
        // 一般ユーザ用のパスワードブローカーを指定
        return Password::broker('users');
    }
}
