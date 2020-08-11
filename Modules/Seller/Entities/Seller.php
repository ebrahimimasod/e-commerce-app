<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Product\Entities\Product;

class Seller extends Model
{
    use SoftDeletes;
    const REAL_PERSON = 'real_person';
    const LEGAL_PERSON = 'legal_person';
    const SELLER_TYPES = [self::REAL_PERSON, self::LEGAL_PERSON];

    const PROCESSING_STATUS = 'processing';
    const ACTIVE_STATUS = 'active';
    const DISABLE_STATUS = 'disable';
    const STATUS = [self::PROCESSING_STATUS, self::ACTIVE_STATUS, self::DISABLE_STATUS];

    protected $fillable = [
        'id',
        'number',
        'password',
        'email',
        'mobile',
        'type',
        'province_id',
        'city_id',
        'telephone',
        'post_code',
        'address',
        'website',
        'map_latitude',
        'map_longitude',
        'brand',
        'tax_status',
        'logo',
        'about',
        'status',
        'email_verified_at',
        'mobile_verified_at',
        'national_card_front_doc',
        'national_card_back_doc'
    ];

    protected $casts = [
        'email_verified_at' => 'boolean',
        'mobile_verified_at' => 'boolean',
    ];

    //region Relations

    public function products()
    {
        return $this->belongsToMany(Product::class)->withTimestamps();
    }

    public function person()
    {
        return $this->hasOne(SellerPerson::class)->withDefault([
            'first_name' => '',
            'family_name' => '',
            'gender' => '',
            'birthday' => '',
            'national_code' => '',
            'national_number' => '',
            'created_at' => '',
            'updated_at' => '',
        ]);
    }

    public function shaba()
    {
        return $this->hasOne(SellersShaba::class);
    }

    public function stores()
    {
        return $this->hasMany(SellersStore::class);
    }

    public function company()
    {
        return $this->hasOne(SellerCompany::class)->withDefault([
            'name' => '',
            'type' => '',
            'registration_number' => '',
            'national_id' => '',
            'economic_code' => '',
            'signature_owners' => '',
        ]);
    }

    public function auth()
    {
        return $this->hasMany(SellerAuth::class);
    }


    //endregion Relations
}
