<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class EditProfileController extends Controller
{
    public function showProfileEditForm()
    {
        return view('user.profile_edit_form')
            ->with('user', Auth::user());
    }
}
