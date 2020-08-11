<?php

namespace Modules\Seller\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class SellersShaba extends Model
{
    use SoftDeletes;

    const PROCESSING = 'processing';
    const REJECTED = 'rejected';
    const ACCEPTED = 'accepted';
    const STATUS = [self::PROCESSING, self::REJECTED, self::ACCEPTED];

    protected $fillable = [
        'id',
        'code',
        'owner',
        'status',
        'seller_id'
    ];
}
