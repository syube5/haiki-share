<?php

namespace App\Http\Controllers\User\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Password;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/';

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

    /*public function reset(Request $request)
    {
        $request->validate($this->rules(), $this->validationErrorMessages());
        $response = $this->broker()->reset(
            $this->credentials($request),
            function ($user, $password) {
                $this->resetPassword($user, $password);
            }
        );
        return $response == Password::PASSWORD_RESET
            ? new JsonResponse('Password Reset')
            : new JsonResponse(["error" => "error"]);
    }*/

    /*protected function rules()
    {
        return [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }*/

    /*public function showResetForm(Request $request, $token = null)
    {
        // 一般ユーザ用のviewを指定
        return view('user.auth.passwords.reset')->with(
            ['token' => $token, 'email' => $request->email]
        );
    }*/
    public function broker()
    {
        // 一般ユーザ用のパスワードブローカーを指定
        return Password::broker('users');
    }
}
