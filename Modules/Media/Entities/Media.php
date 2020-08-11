<?php

namespace Modules\Media\Entities;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    const IMAGE    = 'image';
    const VIDEO    = 'video';
    const DOCUMENT = 'doc';
    const TYPES    = [self::IMAGE, self::VIDEO, self::DOCUMENT];

    const USER_MEDIA = 'user';
    const PRODUCT_MEDIA = 'product';
    const CATEGORY_MEDIA = 'category';
    const BRAND_MEDIA = 'brand';
    const MediaProviders = [
        self::USER_MEDIA,
        self::PRODUCT_MEDIA,
        self::CATEGORY_MEDIA,
        self::BRAND_MEDIA,
    ];

    protected $fillable = [
        'file_path',
        'main',
        'type',
        'mediaable_id',
        'mediaable_type'
    ];


    //region Relations

    public function mediaable()
    {
        return $this->morphTo();
    }

    //endregion Relations


}
