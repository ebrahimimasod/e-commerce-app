<?php

namespace Modules\History\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

class History extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'product_id'
    ];


    //region Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //endregion Relations
}
