<?php

namespace Modules\Brand\Entities;

use Illuminate\Database\Eloquent\Model;

class Brand
    extends Model
{
    protected $fillable = [
        'name_fa',
        'name_en',
        'status',
    ];

    protected $casts=[
        'status'=>'boolean'
    ];
}
