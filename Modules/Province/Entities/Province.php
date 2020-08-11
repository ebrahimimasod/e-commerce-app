<?php

namespace Modules\Province\Entities;


use Illuminate\Database\Eloquent\Model;

class Province extends Model
{

    protected $fillable = [
        'name',
        'status',
    ];

    //region Relations


    public function cities()
    {
        return $this->hasMany(City::class);

    }
    //endregion Relations :
}
