<?php

namespace Modules\Property\Entities;

use Illuminate\Database\Eloquent\Model;

class Property
    extends Model
{
    const TEXT = 'text';
    const SELECT = 'select';
    const TYPES = [self::TEXT, self::SELECT];
    protected $fillable = [
        'name',
        'data_type',
        'parent_id',
        'search_able',
    ];

    //region Relations:

    public function sub_properties()
    {
        return $this->hasMany(self::class, 'parent_id', 'id')->with('propertyItems');
    }

    public function propertyItems()
    {
        return $this->hasMany(PropertyItem::class);
    }

    //endRegion

}
