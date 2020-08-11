<?php


namespace Modules\Seller\Service;



use DB;
use Log;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Http\Requests\CreateSellerRequest;
use Modules\Seller\Http\Requests\UpdateSellerRequest;
use Modules\Seller\Transformers\SellerResourceCollection;

class SellerService
{
    use SellerLoginService,
        SellerRegisterTrait,
        SellerProductTrait,
        SellerPromotionService;

    public static function index()
    {
        $sellers=Seller::latest()->paginate(20);
        return new SellerResourceCollection($sellers);
    }

    public static function store(CreateSellerRequest $request)
    {
        $sellerData = [
            'number'                    => numberRandom(6),
            'password'                  => bcrypt($request->input('password', '123456')),
            'email'                     => $request->input('email'),
            'mobile'                    => $request->input('mobile'),
            'type'                      => $request->input('type'),
            'province_id'               => $request->input('province_id'),
            'city_id'                   => $request->input('city_id'),
            'telephone'                 => $request->input('telephone'),
            'post_code'                 => $request->input('post_code'),
            'address'                   => $request->input('address'),
            'website'                   => $request->input('website'),
            'map_latitude'              => $request->input('map_latitude'),
            'map_longitude'             => $request->input('map_longitude'),
            'brand'                     => $request->input('brand'),
            'tax_status'                => $request->input('tax_status'),
            'logo'                      => $request->input('logo'),
            'about'                     => $request->input('about'),
            'status'                    => $request->input('status'),
            'national_card_front_doc'   => $request->input('national_card_front_doc'),
            'national_card_back_doc'    => $request->input('national_card_back_doc')
        ];

        $sellerPerson = [
            'first_name'                => $request->input('first_name'),
            'family_name'               => $request->input('family_name'),
            'gender'                    => $request->input('gender'),
            'birthday'                  => $request->input('birthday'),
            'national_code'             => $request->input('national_code'),
            'national_number'           => $request->input('national_number'),

        ];

        $sellerCompany = [
            'name'                      => $request->input('company_name'),
            'type'                      => $request->input('company_type'),
            'registration_number'       => $request->input('company_registration_number'),
            'national_id'               => $request->input('company_national_id'),
            'economic_code'             => $request->input('company_economic_code'),
            'signature_owners'          => $request->input('company_signature_owners'),
        ];

        $sellerShaba = [
            'code'                      => $request->input('shaba'),
            'owner'                     => $request->input('owner'),
            'status'                    => $request->input('status_shaba'),
        ];

        $sellerStore = [
            'name'                      => $request->input('store_name'),
            'province_id'               => $request->input('store_province_id'),
            'city_id'                   => $request->input('store_city_id'),
            'address'                   => $request->input('store_address'),
            'post_code'                 => $request->input('store_post_code'),
            'telephone'                 => $request->input('store_telephone'),
        ];



        try {
            DB::beginTransaction();
            /** @var Seller $seller */
            $seller = Seller::create($sellerData);
            $seller->shaba()->create($sellerShaba);
            $seller->stores()->create($sellerStore);
            if ($seller->type == Seller::LEGAL_PERSON) {
                $seller->company()->create($sellerCompany);
            }else{
                $seller->person()->create($sellerPerson);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
        }

        return httpResponse('فروشنده با موفقیت ایجاد شد.');

    }

    public static function update(UpdateSellerRequest $request, $id)
    {

        $sellerData = [
            'email'                     => $request->input('email'),
            'mobile'                    => $request->input('mobile'),
            'type'                      => $request->input('type'),
            'province_id'               => $request->input('province_id'),
            'city_id'                   => $request->input('city_id'),
            'telephone'                 => $request->input('telephone'),
            'post_code'                 => $request->input('post_code'),
            'address'                   => $request->input('address'),
            'website'                   => $request->input('website'),
            'map_latitude'              => $request->input('map_latitude'),
            'map_longitude'             => $request->input('map_longitude'),
            'brand'                     => $request->input('brand'),
            'tax_status'                => $request->input('tax_status'),
            'about'                     => $request->input('about'),
            'status'                    => $request->input('status'),
        ];
        if ($request->hasFile('logo')) {
            $sellerData['logo'] = $request->input('logo');
        }
        if ($request->hasFile('national_card_front_doc')) {
            $sellerData['logo'] = $request->input('national_card_front_doc');
        }
        if ($request->hasFile('national_card_back_doc')) {
            $sellerData['logo'] = $request->input('national_card_back_doc');
        }
        if ($request->filled('password')) {
            $sellerData['password'] = bcrypt($request->input('password'));
        }



        $sellerPerson = [
            'first_name'                => $request->input('first_name'),
            'family_name'               => $request->input('family_name'),
            'gender'                    => $request->input('gender'),
            'birthday'                  => $request->input('birthday'),
            'national_code'             => $request->input('national_code'),
            'national_number'           => $request->input('national_number'),

        ];

        $sellerCompany = [
            'name'                      => $request->input('company_name'),
            'type'                      => $request->input('company_type'),
            'registration_number'       => $request->input('company_registration_number'),
            'national_id'               => $request->input('company_national_id'),
            'economic_code'             => $request->input('company_economic_code'),
            'signature_owners'          => $request->input('company_signature_owners'),
        ];

        $sellerShaba = [
            'code'                      => $request->input('shaba'),
            'owner'                     => $request->input('owner'),
            'status'                    => $request->input('status_shaba'),
        ];

        $sellerStore = [
            'name'                      => $request->input('store_name'),
            'province_id'               => $request->input('store_province_id'),
            'city_id'                   => $request->input('store_city_id'),
            'address'                   => $request->input('store_address'),
            'post_code'                 => $request->input('store_post_code'),
            'telephone'                 => $request->input('store_telephone'),
        ];


            $seller=Seller::findOrFail($id);
        try {
            DB::beginTransaction();
            /** @var Seller $seller */
            $seller->update($sellerData);
            $seller->shaba()->update($sellerShaba);
            $seller->stores()->update($sellerStore);
            if ($seller->type == Seller::LEGAL_PERSON) {
                $seller->company()->update($sellerCompany);
            }else{
                $seller->person()->update($sellerPerson);
            }
            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            Log::error($exception);
        }

        return httpResponse('فروشنده با موفقیت ویرایش شد.');

    }

    public static function destroy($id,$force=false)
    {
        $seller = Seller::withTrashed()->findOrFail($id);
        if($force){
            $seller->forceDelete();
        }else{
            $seller->delete();
        }

        return httpResponse('با موفقیت حذف شد.', 200);
    }


}
