<?php

namespace Modules\Category\Entities;



use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Entities\Brand;
use Modules\Property\Entities\Property;
use Modules\Variant\Entities\Variant;

class Category extends Model
{
    use Sluggable;

    protected $fillable = [
        'name_fa',
        'name_en',
        'depth',
        'display',
        'slug',
        'status',
        'parent_id',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'name_fa'
            ]
        ];
    }


    //region Relations

    public function sub_category()
    {
        return $this->hasMany(self::class, 'parent_id', 'id');
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class);
    }

    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }
    public function variants()
    {
        return $this->belongsToMany(Variant::class);
    }

    //endregion Relations


}
