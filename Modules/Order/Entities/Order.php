<?php

namespace Modules\Order\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Address\Entities\Address;

class Order extends Model
{
    //region OrderStatus
    const CANCELED = 'canceled'; // کنسل شده
    const APPROVED = 'approved'; // تاییده شده
    const WAITING = 'waiting'; // در انتطار پرداخت
    const PREPARING = 'preparing'; // آماده کردن سفارش
    const DELIVERED_TO_POST = 'delivered_to_post'; // تحویل به پست
    const DELIVERED_TO_CUSTOMER = 'delivered_to_customer'; // تحویل به مشتری
    const STATUS = [
        self::CANCELED,
        self::APPROVED,
        self::WAITING,
        self::PREPARING,
        self::DELIVERED_TO_POST,
        self::DELIVERED_TO_CUSTOMER,
    ];
    //endregion OrderStatus



    protected $fillable = [
        'id',
        'number',
        'price_total',
        'price_final',
        'postage_fee',
        'status',
        'user_id',
        'promotion_id',
        'address_id',
    ];


    //region Relations:
        public function address()
        {
            return $this->hasOne(Address::class);
        }
    //endregion RElations




}
