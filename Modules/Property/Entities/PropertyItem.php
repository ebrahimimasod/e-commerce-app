<?php

namespace Modules\Property\Entities;

use Illuminate\Database\Eloquent\Model;

class PropertyItem extends Model
{
    protected $fillable = [
        'name',
        'property_id'
    ];

    //region Relations
    public function property()
    {
        return $this->belongsTo(Property::class);
    }


    //endregion Relations
}
