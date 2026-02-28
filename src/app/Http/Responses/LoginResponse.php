<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request)
    {
        $user = $request->user();

        if (
            !$user->post_code ||
            !$user->address
        ) {
            return redirect('/mypage/profile');
        }

        return redirect('/');
    }
}
