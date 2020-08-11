<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SellerCompany extends Model
{
    use SoftDeletes;
    const PUBLIC_STOCK=[
        'value'=>'public_stock',
        'label'=>'سهامی عام'
    ];
    const PRIVATE_STOCK=[
        'value'=>'private_stock',
        'label'=>'سهامی خاص'
    ];
    const LIMITED_RESPONSIBILITY=[
        'value'=>'limited_responsibility',
        'label'=>'مسولیت محدود'
    ];
    const COOPERATIVE=[
        'value'=>'cooperative',
        'label'=>'تعاونی'
    ];

    const COMPANY_TYPES=[
        self::PUBLIC_STOCK,
        self::PRIVATE_STOCK,
        self::LIMITED_RESPONSIBILITY,
        self::COOPERATIVE,
    ];


    protected $fillable = [
        'name',
        'type',
        'registration_number',
        'national_id',
        'economic_code',
        'signature_owners',
        'seller_id',
    ];
}
