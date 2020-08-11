<?php

namespace Modules\Province\Entities;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'status',
        'province_id',
    ];


    //region Relations:
    public function province()
    {
        return $this->belongsTo(Province::class);
    }
    //endregion Relations:
}
