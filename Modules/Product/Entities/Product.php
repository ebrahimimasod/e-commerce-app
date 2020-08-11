<?php

namespace Modules\Product\Entities;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Comment\Entities\Comment;
use Modules\Media\Entities\Media;
use Modules\Property\Entities\Property;
use Modules\Property\Entities\PropertyItem;
use Modules\Question\Entities\Question;

class Product extends Model
{
    use Sluggable,SoftDeletes;


    const ACTIVE_STATUS = 'active';
    const DISABLE_STATUS = 'disable';
    const STOP_PRODUCTION_STATUS = 'stop_production';
    const SOON_STATUS = 'soon';
    const NOT_AVAILABLE_STATUS = 'not_available';

    const STATUS = [
        self::ACTIVE_STATUS,
        self::DISABLE_STATUS,
        self::STOP_PRODUCTION_STATUS,
        self::SOON_STATUS,
        self::NOT_AVAILABLE_STATUS,
    ];


    protected $fillable = [
        'title_fa',
        'title_en',
        'number',
        'slug',
        'body',
        'status',
        'meta_title',
        'meta_keywords',
        'meta_description',
        'category_id',
        'brand_id',
    ];


    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title_fa'
            ]
        ];
    }


    //region Relations


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function properties()
    {
        return $this->belongsToMany(Property::class)->withPivot(['value']);
    }

    public function propertiesItems()
    {
        return $this->belongsToMany(PropertyItem::class)->withPivot('property_id');
    }

    public function descriptions()
    {
        return $this->hasMany(ProductDescription::class);
    }

    public function medias()
    {
        return $this->morphMany(Media::class, 'mediaable');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
    //endregion Relations


}
