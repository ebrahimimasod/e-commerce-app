<?php

namespace Modules\Seller\Http\Controllers\Auth;

use Illuminate\Routing\Controller;
use Modules\Seller\Http\Requests\CheckVerificationCodeRequest;
use Modules\Seller\Http\Requests\RegisterSellerRequest;
use Modules\Seller\Http\Requests\SellerLoginRequest;
use Modules\Seller\Http\Requests\SendVerificationCodeRequest;
use Modules\Seller\Service\SellerService;

class SellerAuthController extends Controller
{
    public function login(SellerLoginRequest $request)
    {
      return SellerService::login($request);
    }

    public function register(RegisterSellerRequest $request)
    {
        return SellerService::TemporarySaveSellerData($request);
    }

    public function sendVerificationCode(SendVerificationCodeRequest $request)
    {
        return SellerService::sendVerificationCode($request);
    }

    public function checkVerificationCode(CheckVerificationCodeRequest $request)
    {
        return SellerService::checkVerificationCode($request);
    }

    public function saveSellerData(RegisterSellerRequest $request)
    {
        return SellerService::saveSellerData($request);
    }

    public function updateSellerData(UpdateSellerDataRequest $request)
    {
        return SellerService::UpdateSellerData($request);
    }

    public function uploadSellerDocuments(UploadSellerDocumentsRequest $request)
    {
        return SellerService::uploadSellerDocuments($request);
    }
}
