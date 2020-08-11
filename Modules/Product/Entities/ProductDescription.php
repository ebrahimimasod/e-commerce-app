<?php

namespace Modules\Product\Entities;


use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Brand\Entities\Brand;
use Modules\Category\Entities\Category;
use Modules\Property\Entities\Property;
use Modules\Property\Entities\PropertyItem;

class ProductDescription extends Model
{
    protected $table = 'product_descriptions';
    protected $fillable = [
        'title',
        'body',
        'product_id',
    ];
    public $timestamps = false;


    // region Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // endregion Relations


}

