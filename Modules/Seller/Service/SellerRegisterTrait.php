<?php


namespace Modules\Seller\Service;


use Cache;
use DB;
use Log;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Http\Requests\CheckVerificationCodeRequest;
use Modules\Seller\Http\Requests\RegisterSellerRequest;
use Modules\Seller\Http\Requests\SendVerificationCodeRequest;
use Modules\Seller\Http\Requests\UpdateSellerRequest;
use Psr\SimpleCache\InvalidArgumentException;

trait SellerRegisterTrait
{
    /**
     * دخیره اطلاعات فروشنده در کش (ذخیره موقت)
     * @param RegisterSellerRequest $request
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function TemporarySaveSellerData(RegisterSellerRequest $request)
    {
        $seller = $request->validated();
        try {
            Cache::delete(self::getCacheName($seller['email']));
        }catch (\Throwable $throwable){
            Log::error($throwable);
        }
        $seller['email_verification_code'] = numberRandom(6);
        $seller['mobile_verification_code'] = numberRandom(6);
        Cache::put(self::getCacheName($seller['email']), $seller, now()->addMinutes(10));
        return httpResponse('اطلاعات شما به صورت موقت ذخیره شد. برای ثبت کامل اطلاعات ، مراحل ثبت نام را تا انتها پیش برید .');
    }


    /**
     * ارسال کد تایید
     * @param SendVerificationCodeRequest $request
     * @return mixed
     */
    public static function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        if (Cache::has(self::getCacheName($request->input('email')))) {
            $email  = $request->input('email');
            $mobile = $request->input('mobile');
            $type   = $request->input('type');
            $sellerData = self::getSellerCacheValue($email);

            if ($type == 'mobile') {
                if (!Cache::has(self::getCacheNameVerificationCode($mobile))) {
                    Cache::put(self::getCacheNameVerificationCode($mobile), $sellerData['mobile_verification_code'], now()->addMinute());
                    Log::info('send mobile verification  code : ' . $sellerData['mobile_verification_code']);
                    //TODO ::send mobile verification code
                    return httpResponse('کد تایید برای موبایل شما ارسال شد.');
                }
            } else {
                if (!Cache::has(self::getCacheNameVerificationCode($email))) {
                    Cache::put(self::getCacheNameVerificationCode($email), $sellerData['email_verification_code'], now()->addMinute());
                    Log::info('send email verification  code : ' . $sellerData['email_verification_code']);
                    //TODO ::send email verification code
                    return httpResponse('کد تایید برای ایمیل شما ارسال شد.');
                }
            }

            return httpResponse('لطفا 1 دقیقه بعد امتحان کنید.');
        }
        return httpResponse(' لطفا ابتدا ثبت نام کنید', 400);
    }

    /**
     * چک کردن کد تایید کاربر
     * @param CheckVerificationCodeRequest $request
     * @return mixed
     * @throws InvalidArgumentException
     */
    public static function checkVerificationCode(CheckVerificationCodeRequest $request)
    {
        if (Cache::has(self::getCacheName($request->input('email')))) {
            $email = $request->input('email');
            $mobile = $request->input('mobile');
            $sellerData = self::getSellerCacheValue($email);
            $nowTime = now()->format('Y-m-d H:i:s');
            if ($mobile) {
                Cache::delete(self::getCacheNameVerificationCode($mobile));
                $sellerData['mobile_verified_at'] = $nowTime;
                $responseText = 'موبایل با موفقیت تایید شد.';
            } else {
                Cache::delete(self::getCacheNameVerificationCode($email));
                $sellerData['email_verified_at'] = $nowTime;
                $responseText = 'ایمیل با موفقیت تایید شد.';
            }

            Cache::put(self::getCacheName($email), $sellerData, now()->addMinutes(10));

            return httpResponse($responseText);
        }
        return httpResponse(' لطفا ابتدا ثبت نام کنید', 400);
    }

    /**
     * ذخیره اطلاعات اولیه فروشنده در دیتابیس
     * @param RegisterSellerRequest $request
     * @return mixed
     */
    public static function saveSellerData(RegisterSellerRequest $request)
    {
        if (Cache::has(self::getCacheName($request->input('email')))) {
            $seller = self::getSellerCacheValue($request->input('email'));
            if(isset($seller['email_verified_at'])){
                $seller['password'] = bcrypt($seller['password']);
                Seller::create($seller);
                return httpResponse('اطلاعات اولیه فروشنده با موفقیت ثبت شد.');
            }
            return httpResponse('لطفا ابتدا ایمیل خود را تایید کنید.',400);
        }
        return httpResponse(' لطفا ابتدا ثبت نام کنید', 400);

    }

    /**
     * ذخیره کامل همه اطلاعات فروشنده در دیتابیس
     * @param UpdateSellerRequest $request
     * @return mixed
     */
    public static function UpdateSellerData(UpdateSellerRequest $request)
    {
        $sellerData = [];
        $sellerCompany = [];
        $sellerPerson = [];
        foreach ($request->validated() as $key => $item) {
            if (!strpos($key, 'company_')) {
                $sellerData[str_replace('seller_', '', $key)] = $item;
            }
        }
        if ($sellerData['type'] == Seller::LEGAL_PERSON) {
            foreach ($request->validated() as $key => $item) {
                if (strpos($key, 'company_')) {
                    $sellerCompany[str_replace('seller_company_', '', $key)] = $item;
                }
            }
        }
        if ($sellerData['type'] == Seller::REAL_PERSON) {
            foreach ($request->validated() as $key => $item) {
                if (strpos($key, 'person_')) {
                    $sellerPerson[str_replace('seller_person_', '', $key)] = $item;
                }
            }
        }
        try {
            DB::beginTransaction();
            /** @var Seller $seller */
            $seller = Seller::where([
                'email' => $sellerData['email'],
                'mobile' => $sellerData['mobile'],
            ])->firstOrFail();
            $seller->update($sellerData);
            if (sizeof($sellerCompany) > 0) {
                $seller->company()->create($sellerCompany);
            }
            if (sizeof($sellerPerson) > 0) {
                $seller->person()->create($sellerPerson);
            }
            $seller->shaba()->create([
                'code' => $sellerData['shaba'],
                'owner' => $sellerData['shaba_owner'],
            ]);
            DB::commit();
        } catch (\Exception $exception) {
            Log::error($exception);
            try {
                DB::rollBack();
            } catch (\Exception $e) {
                Log::error($e);
            }
        }
        return self::HttpResponse('اطلاعات شما با موفقیت ذخیره شد.');

    }


    /**
     * اپلود مدارک فروشنده
     * @param UploadSellerDocumentsRequest $request
     * @return mixed
     */
    public static function uploadSellerDocuments(UploadSellerDocumentsRequest $request)
    {
        $data = $request->validated();
        $seller = Seller::where([
            'email' => $data['email'],
            'mobile' => $data['mobile'],
        ])->firstOrFail();


            $national_card_front_doc_link = self::uploadImage($request, 'national_card_front_doc');
            $national_card_back_doc_link = self::uploadImage($request, 'national_card_back_doc');
            $seller->update([
                'national_card_front_doc' => $national_card_front_doc_link,
                'national_card_back_doc' => $national_card_back_doc_link,
            ]);
            return self::HttpResponse('مدارک شما با موفقیت ارسال شد.');
    }

    /**
     * گرفتن کلید کش با ایمیل
     * @param $userKey
     * @return string
     */
    public static function getCacheName($userKey)
    {
        return 'seller_data_' . $userKey;
    }

    /**
     * گرفتن کلید کش  کد تایید با ایمیل یا موبایل
     * @param $userKey
     * @return string
     */
    public static function getCacheNameVerificationCode($userKey)
    {
        if (isEmail($userKey)) {
            return 'email_verification_code_' . $userKey;
        } else {
            return 'mobile_verification_code_' . $userKey;
        }
    }

    /**
     * گرفتن مقدار کش با کلید
     * @param $userKey
     * @return mixed
     */
    public static function getSellerCacheValue($userKey)
    {
        return Cache::get(self::getCacheName($userKey));
    }
}


