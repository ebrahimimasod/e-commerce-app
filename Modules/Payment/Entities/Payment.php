<?php

namespace Modules\Payment\Entities;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    // region PaymentWays
    const ONLINE_WAY = 'online';
    const OFFLINE_WAY = 'offline';
    const PAYMENT_WAYS = [self::ONLINE_WAY, self::OFFLINE_WAY];
    // endregion PaymentWays

    // region PaymentServices
    const ZARINPALL_SERVICE = 'zarinpall';
    const MELLAT_SERVICE = 'mellat';
    const PAYMENT_SERVICES = [self::ZARINPALL_SERVICE, self::MELLAT_SERVICE];
    // endregion PaymentServices


    protected $fillable = [
        'id',
        'ref_id',
        'token',
        'payment_way',
        'payment_service',
        'price_total',
        'price_final',
        'state',
        'discount',
        'user_id',
        'order_id',
    ];
}
