<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;

class SellerAuth extends Model
{
    const EXPIRE_TIME = 30; //days
    protected $table = 'seller_api_token';

    protected $fillable = [
        'id',
        'seller_id',
        'api_token',
        'expire_at',
    ];

    //region Relations

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }


    public function checkExpireTime()
    {
        $expire_at = strtotime($this->expire_at);
        $created_at = strtotime($this->created_at);
        return $expire_at > $created_at;

    }

    //endregion Relations
}
