<?php

namespace Modules\Seller\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Modules\Seller\Entities\Seller;
use Modules\Seller\Entities\SellerCompany;
use Modules\Seller\Entities\SellerPerson;
use Modules\Seller\Entities\SellersShaba;

class CreateSellerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $sellersTypes  = join(',', Seller::SELLER_TYPES);
        $sellerStatus  = join(',',Seller::STATUS);
        $genders       = join(',', SellerPerson::GENDER);
        $shabaStatus   = join(',',SellersShaba::STATUS);
        $companyTypes  = join(',', collect(SellerCompany::COMPANY_TYPES)->map(function ($companyType) {
            return $companyType['value'];
        })->toArray());

        return [
            'email'                        =>  ['required','email','unique:sellers','max:50'],
            'mobile'                       =>  ['required', 'numeric','unique:sellers', 'regex:/^((09)[0-9]{9})$/',],
            'type'                         =>  ['required', 'string', 'in:' . $sellersTypes],
            'password'                     =>  ['required','string','min:6','max:20'],
            'province_id'                  =>  ['required','numeric','exists:provinces,id'],
            'city_id'                      =>  ['required','numeric','exists:cities,id'],
            'telephone'                    =>  ['required','string','max:15'],
            'post_code'                    =>  ['required','string','size:10'],
            'address'                      =>  ['required','string','min:5','max:2000'],
            'website'                      =>  ['nullable','string','url','max:50'],
            'map_latitude'                 =>  ['required','string','max:50'],
            'map_longitude'                =>  ['required','string','max:50'],
            'brand'                        =>  ['required','string','max:20'],
            'tax_status'                   =>  ['required','bool'],
            'logo'                         =>  ['nullable'],
            'about'                        =>  ['nullable','string','max:2000'],
            'status'                       =>  ['required','string','in:'.$sellerStatus],
            'national_card_front_doc'      =>  ['nullable'],
            'national_card_back_doc'       =>  ['nullable'],

            //Seller Person :
            'first_name'                   =>  ['required_if:type,'.Seller::REAL_PERSON,'string','max:20'],
            'family_name'                  =>  ['required_if:type,'.Seller::REAL_PERSON,'string','max:20'],
            'gender'                       =>  ['required_if:type,'.Seller::REAL_PERSON,'string', 'in:' . $genders],
            'birthday'                     =>  ['required_if:type,'.Seller::REAL_PERSON,'string'],
            'national_code'                =>  ['required_if:type,'.Seller::REAL_PERSON,'string','size:10'],
            'national_number'              =>  ['required_if:type,'.Seller::REAL_PERSON,'string','max:10'],


            //Seller Company :
            'company_name'                 =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:20'],
            'company_type'                 =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:20', 'in:' . $companyTypes],
            'company_registration_number'  =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:12',Rule::unique('seller_companies','registration_number')],
            'company_national_id'          =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:12',Rule::unique('seller_companies','national_id')],
            'company_economic_code'        =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:12',Rule::unique('seller_companies','economic_code')],
            'company_signature_owners'     =>  ['required_if:type,'.Seller::LEGAL_PERSON,'string','max:255'],

            // Seller shaba :
             'shaba'                         =>  ['required','string','size:26'],
             'owner'                        =>  ['required','string','max:20'],
             'status_shaba'                 =>  ['required','string','in:'.$shabaStatus],

            // Seller Stores :
             'store_name'                   =>  ['required','string','max:20'],
             'store_telephone'              =>  ['required','string','max:15'],
             'store_province_id'            =>  ['required','numeric','exists:provinces,id'],
             'store_city_id'                =>  ['required','numeric','exists:cities,id'],
             'store_post_code'              =>  ['required','string','size:10'],
             'store_address'                =>  ['required','string','min:5','max:2000'],

            ];
    }
}
