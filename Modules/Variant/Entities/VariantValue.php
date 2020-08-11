<?php

namespace Modules\Variant\Entities;

use Illuminate\Database\Eloquent\Model;

class VariantValue extends Model
{
    public $timestamps=false;
    protected $fillable = [
       'id',
       'name',
       'value',
       'variant_id',
    ];

    //region Relations
    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }
    //endregion Relations
}
