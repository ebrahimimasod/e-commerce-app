<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SellerPerson extends Model
{

    use SoftDeletes;


    const MAN = 'man';
    const WOMAN = 'woman';
    const GENDER = [self::MAN, self::WOMAN];
    protected $fillable=[
        'id',
        'first_name',
        'family_name',
        'gender',
        'birthday',
        'national_code',
        'national_number',
        'seller_id',
    ];
}
