<?php

namespace Modules\Seller\Rules;

use Cache;
use Illuminate\Contracts\Validation\Rule;
use Modules\Seller\Service\SellerService;

class CheckForExistsSellerDataRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        return Cache::has(SellerService::getCacheName($value));
}

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'لطفا ابتدا ثبت نام کنید.';
    }
}
