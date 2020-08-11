<?php

namespace Modules\Comment\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\User\Entities\User;

class Comment extends Model
{
    const WAITING ='waiting';
    const ACCEPTED='accepted';
    const REJECTED='rejected';
    const STATUS=[self::WAITING,self::ACCEPTED,self::REJECTED];
    protected $fillable = [
        'title',
        'body',
        'good_tags',
        'bad_tags',
        'status',
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
