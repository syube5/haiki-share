<?php

namespace App\Http\Controllers\Conveniencestore\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest:conveniencestore')->except('logout');
    }

    // Guardの認証方法を指定
    protected function guard()
    {
        return Auth::guard('conveniencestore');
    }

    // ログイン画面
    public function showLoginForm()
    {
        return view('conveniencestore.auth.login');
    }

    // ログアウト処理
    public function logout(Request $request)
    {
        Auth::guard('conveniencestore')->logout();

        return $this->loggedOut($request);
    }

    // ログアウトした時のリダイレクト先
    public function loggedOut(Request $request)
    {
        return redirect(route('conveniencestore.login'));
    }
}
