<?php

namespace Modules\Question\Entities;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'id',
        'body',
        'status',
        'user_id',
        'product_id',
    ];


    //region Relations

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    //ebdregion Relations
}
