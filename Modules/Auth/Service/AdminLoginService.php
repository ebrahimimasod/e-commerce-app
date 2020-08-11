<?php


namespace Modules\Auth\Service;


use Hash;
use Modules\Auth\Http\Requests\AdminLoginRequest;
use Modules\User\Entities\User;

trait AdminLoginService
{
    public static function adminLogin(AdminLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        /** @var User $user */
        $user = User::whereEmail($username)->OrWhere('mobile', $username)->first();
        //TODO:: check user level;
        if ($user) {
            if(Hash::check($password, $user->password)){
               //TODO:: get user token for login
            }
        }

        return httpResponse('نام کاربری یا رمز عبور اشتباه است.');
    }
}
