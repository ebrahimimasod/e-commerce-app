<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\AuthLoginRequest;
use Modules\Auth\Http\Requests\SendVerificationCodeRequest;
use Modules\Auth\Service\LoginService;

class AuthController extends Controller
{
    public function login(AuthLoginRequest $request)
    {
        return LoginService::login($request);
    }

    public function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        return LoginService::sendVerificationCode($request);
    }

    public function logout()
    {

    }
}
