<?php

namespace Modules\Promotion\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Product\Entities\Product;
use Modules\Seller\Entities\Seller;
use Modules\Variant\Entities\VariantValue;

class Promotion extends Model
{
    protected $fillable = [
        'id',
        'price',
        'discount',
        'product_id',
        'seller_id',
        'variant_value_id',
    ];


    //region Relations
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function seller()
    {
        return $this->belongsTo(Seller::class);
    }

    public function variantValue()
    {
        return $this->belongsTo(VariantValue::class)->with('variant');
    }
    //endregion Relations

}
