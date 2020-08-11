<?php


namespace Modules\Auth\Service;


use Cache;
use Illuminate\Http\Request;
use Log;
use Modules\Auth\Http\Requests\SendVerificationCodeRequest;
use Modules\User\Entities\User;

class LoginService
{
    use AdminLoginService;

    public static function login(Request $request)
    {
        $user = self::getUserFromRequest($request);
        if ($user) {
            //update User data :
            $user->update([
                'mobile_verified_at' => now()->format('Y-m-d H:i:s')
            ]);

            //delete User cache data :
            Cache::delete(self::getCacheName($user->mobile));

            return httpResponse([
                'user' => $user,
                'api_token' => self::createUserApiLoginToken($user),
            ]);
        }
        return httpResponse('اطلاعات ورود به حساب کاربری شما اشتباه است', 400);
    }

    public static function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        $verificationCode = numberRandom();
        $mobile = $request->input('mobile');
        $cacheValue = [
            'verificationCode' => $verificationCode,
            'mobile' => $mobile
        ];
        if (!Cache::has(self::getCacheName($mobile))) {
            Cache::put(self::getCacheName($mobile), $cacheValue, now()->addMinute());
            //TODO:: send Verification Code To User mobile;
            Log::info('send Verification Code To User mobile : ' . $verificationCode);
            return httpResponse('کد تایید برای شما ارسال شد');
        }
        return httpResponse('یک دقیقه دیگر تلاش کنید.', 400);
    }

    private static function createUserApiLoginToken(User $user)
    {
        $token = $user->createToken('token-for-user-' . $user->id);
        return $token->accessToken;
    }

    public static function getCacheName($mobile)
    {
        return 'login-cache-user-' . $mobile;
    }

    public static function getCacheValue($mobile)
    {
        return Cache::get(self::getCacheName($mobile));
    }

    private static function getUserFromRequest(Request $request)
    {
        return User::firstOrCreate(['mobile' => $request->mobile]);
    }


}
