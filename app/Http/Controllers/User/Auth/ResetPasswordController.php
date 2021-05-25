<?php

namespace App\Http\Controllers\User\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{
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
        return redirect("/user/password/reset/{token}")->with([
            'token' => $token,
            'email' => $request->email
        ]);
    }

    public function reset(Request $request)
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
    }

    protected function rules()
    {
        return [
            'token' => 'required',
            'password' => 'required|confirmed|min:8',
        ];
    }

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
