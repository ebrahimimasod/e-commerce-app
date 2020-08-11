<?php

namespace Modules\Role\Entities;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    public $timestamps=false;

    const DASHBOARD       = 'dashboard';
    const ADMINS          = 'admins';
    const USERS           = 'users';
    const CATEGORIES      = 'categories';
    const SLIDERS         = 'sliders';
    const BANNERS         = 'banners';
    const BRANDS          = 'brands';
    const PROPERTIES      = 'properties';
    const COMMENTS        = 'comments';
    const PRODUCTS        = 'products';
    const PAYMENTS        = 'payments';
    const DISCOUNT_CODES  = 'discountCodes';
    const ORDERS          = 'orders';
    const PAGES           = 'pages';
    const SELLERS         = 'sellers';
    const SETTINGS        = 'settings';

    const PERMISSIONS=[
        self::DASHBOARD      ,
        self::ADMINS         ,
        self::USERS          ,
        self::CATEGORIES     ,
        self::SLIDERS        ,
        self::BANNERS        ,
        self::BRANDS         ,
        self::PROPERTIES     ,
        self::COMMENTS       ,
        self::PRODUCTS       ,
        self::PAYMENTS       ,
        self::DISCOUNT_CODES ,
        self::ORDERS         ,
        self::PAGES          ,
        self::SELLERS        ,
        self::SETTINGS       ,
    ];

    protected $fillable = [
        'id',
        'label',
        'name',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
