<?php

namespace Modules\Auth\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Modules\Auth\Http\Requests\AdminLoginRequest;
use Modules\Auth\Http\Requests\AuthLoginRequest;
use Modules\Auth\Http\Requests\SendVerificationCodeRequest;
use Modules\Auth\Service\LoginService;

class AuthController extends Controller
{
    public function login(AdminLoginRequest $request)
    {
        return LoginService::adminLogin($request);
    }

    public function logout(SendVerificationCodeRequest $request)
    {
        return LoginService::sendVerificationCode($request);
    }

}


