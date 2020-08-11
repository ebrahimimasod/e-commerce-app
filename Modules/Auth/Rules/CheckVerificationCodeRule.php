<?php

namespace Modules\Auth\Rules;

use Cache;
use Illuminate\Contracts\Validation\Rule;
use Modules\Auth\Service\LoginService;

class CheckVerificationCodeRule implements Rule
{
    private $mobile;

    /**
     * Create a new rule instance.
     *
     * @param $mobile
     */
    public function __construct($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (Cache::has(LoginService::getCacheName($this->mobile))) {
            $userCacheData = LoginService::getCacheValue($this->mobile);
            return ($userCacheData[$attribute] == $value && $userCacheData['mobile'] == $this->mobile);
        }
        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'کد تایید اشتباه است.';
    }
}
