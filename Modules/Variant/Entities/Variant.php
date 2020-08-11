<?php

namespace Modules\Variant\Entities;

use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    public $timestamps=false;
    protected $fillable = [
       'id',
       'label',
       'value',
    ];
}
