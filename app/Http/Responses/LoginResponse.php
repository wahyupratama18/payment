<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        return $request->wantsJson()
        ? $this->toJson($request)
        : redirect()->intended(Fortify::redirects('login'));
    }

    protected function toJson(Request $request): JsonResponse
    {
        $user = $request->user();

        $user->token = $user->authToken();

        return response()->json([
            'user' => $user,
            'two_factor' => false,
        ]);
    }
}
