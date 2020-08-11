<?php

namespace Modules\Seller\Rules;

use Cache;
use Illuminate\Contracts\Validation\Rule;
use Modules\Seller\Service\SellerService;

class CheckVerificationCodeRule implements Rule
{
    private $email;
    private $mobile;

    /**
     * Create a new rule instance.
     *
     * @param $email
     * @param $mobile
     */
    public function __construct($email, $mobile = null)
    {
        $this->email = $email;
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
        if (Cache::has(SellerService::getCacheName($this->email))) {
            $cacheValue = Cache::get(SellerService::getCacheName($this->email));

            if ($this->mobile) {
                return $value == $cacheValue['mobile_verification_code'];
            } else {
                return $value == $cacheValue['email_verification_code'];
            }
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
        return 'کد تایید اشتباه وارد شده است';
    }
}
