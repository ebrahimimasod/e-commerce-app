<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SellersStore extends Model
{

    use SoftDeletes;

    protected $fillable=[
        'id',
        'name',
        'province_id',
        'city_id',
        'address',
        'post_code',
        'telephone',
        'seller_id',
    ];
}
