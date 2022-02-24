<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        if (Auth::user()->isAdmin()) {
            $redirectPath = config('fortify.admin');
        } else {
            $redirectPath = config('fortify.home');
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->intended($redirectPath);
    }
}
