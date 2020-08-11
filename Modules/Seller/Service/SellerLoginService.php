<?php


namespace Modules\Seller\Service;

use Hash;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Entities\SellerAuth;
use Modules\Seller\Http\Requests\SellerLoginRequest;
use Str;

trait SellerLoginService
{
    public static function login(SellerLoginRequest $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        /** @var Seller $seller */
        $seller = Seller::where('email', $username)->first();
        if ($seller) {
            if (Hash::check($password, $seller->password)) {
                $token =Str::random(225);
                $seller->auth()->create([
                    'api_token'  => $token,
                    'expire_at'  => now()->addDays(SellerAuth::EXPIRE_TIME)->format('Y-m-d H:i:s'),
                ]);
                return httpResponse([
                    'api_token' => $token
                ]);
            }
        }
        return httpResponse('نام کاربری یا رمز عبور اشتباه است.', 401);


    }
}
