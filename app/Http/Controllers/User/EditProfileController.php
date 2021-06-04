<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\EditRequest;


class EditProfileController extends Controller
{
    public function editProfile(EditRequest $request)
    {
        $user = Auth::user();

        $user->name = $request->input('name');
        $user->email = $request->input('email');

        return $user->save()
            ? response()->json(['status' => true], 201)
            : response()->json(['status' => false], 401);
    }
}
