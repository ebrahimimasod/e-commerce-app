<?php

namespace Modules\Favorite\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

class Favorite extends Model
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
