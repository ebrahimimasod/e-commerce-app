<?php

namespace Modules\Variant\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Variant\Entities\Variant;
use Modules\Variant\Entities\VariantValue;

class VariantDatabaseSeeder extends Seeder
{

    public function run()
    {
        Variant::truncate();
        VariantValue::truncate();

        $variants = [
            [
                'id' => 1,
                'label' => 'رنگ ها',
                'value' => 'colors'
            ],
            [
                'id' => 2,
                'label' => 'سایز ها',
                'value' => 'sizes'
            ],
            [
                'id' => 3,
                'label' => 'کارانتی ها',
                'value' => 'guaranty'
            ],
        ];
        $colors = [
            [
                'name' => 'سفید',
                'value' => "rgb(255,255,255)",
            ],
            [
                'name' => 'طوسی',
                'value' => "rgb(224,224,224)",
            ],
            [
                'name' => 'آبی',
                'value' => "rgb(0,0,255)",
            ],
            [
                'name' => 'سرمه ای',
                'value' => "rgb(25,25,112)",
            ],
            [
                'name' => 'مشکی',
                'value' => "rgb(43,43,43)",
            ],
            [
                'name' => 'سبز',
                'value' => "rgb(0,128,0)",
            ],
            [
                'name' => 'قرمز',
                'value' => "rgb(255,0,0)",
            ],
            [
                'name' => 'نارنجی',
                'value' => "rgb(255,87,34)",
            ],
            [
                'name' => 'زرد',
                'value' => "rgb(255,255,0)",
            ],
            [
                'name' => 'ذغالی',
                'value' => "rgb(47,47,47)",
            ],
            [
                'name' => 'کرم',
                'value' => "rgb(255,236,202)",
            ],
            [
                'name' => 'صورتی',
                'value' => "rgb(255,192,203)",
            ],
            [
                'name' => 'زیتونی',
                'value' => "rgb(132,131,28)",
            ],
            [
                'name' => 'بنفش',
                'value' => "rgb(128,0,128)",
            ],
            [
                'name' => 'قهوه ای',
                'value' => "rgb(86,46,31)",
            ],
            [
                'name' => 'بژ',
                'value' => "rgb(230,218,179)",
            ],
            [
                'name' => 'زرشکی',
                'value' => "rgb(106,19,19)",
            ],
            [
                'name' => 'سبز آبی',
                'value' => "rgb(0,255,240)",
            ],
            [
                'name' => 'چند رنگ',
                'value' => "rgb(199,21,133)",
            ],
            [
                'name' => 'فیروزه ای',
                'value' => "rgb(77,220,215)",
            ],
            [
                'name' => 'سرخابی',
                'value' => "rgb(245,0,87)",
            ],
            [
                'name' => 'زرد خردلی',
                'value' => "rgb(208,164,10)",
            ],

        ];
        $sizes = [

            [
                "name" => "L",
                "value" => "L",
            ]
            , [
                "name" => "XL",
                "value" => "XL",
            ]
            , [
                "name" => "XXL",
                "value" => "XXL",
            ]
            , [
                "name" => "M",
                "value" => "M",
            ]
            , [
                "name" => "S",
                "value" => "S",
            ]
            , [
                "name" => "XXXL",
                "value" => "XXXL",
            ]
            , [
                "name" => "3XL",
                "value" => "3XL",
            ]
            , [
                "name" => "4XL",
                "value" => "4XL",
            ]
            , [
                "name" => "5XL",
                "value" => "5XL",
            ]
            , [
                "name" => "S",
                "value" => "S",
            ]
            , [
                "name" => "M",
                "value" => "M",
            ]
            , [
                "name" => "2xl",
                "value" => "2xl",
            ]
            , [
                "name" => "XL",
                "value" => "XL",
            ]
            , [
                "name" => "L-XL",
                "value" => "L-XL",
            ]
            , [
                "name" => "XXL",
                "value" => "XXL",
            ]
            , [
                "name" => "XL",
                "value" => "XL",
            ]
            , [
                "name" => "L",
                "value" => "L",
            ]
            , [
                "name" => "6XL",
                "value" => "6XL",
            ]
            , [
                "name" => "XS",
                "value" => "XS",
            ]
            , [
                "name" => "7XL",
                "value" => "7XL",
            ]
            , [
                "name" => "m-l",
                "value" => "m-l",
            ]
            , [
                "name" => "XXL",
                "value" => "XXL",
            ]
            , [
                "name" => "S-M",
                "value" => "S-M",
            ]
            , [
                "name" => "3XL",
                "value" => "3XL",
            ]
            , [
                "name" => "XXXXL",
                "value" => "XXXXL",
            ]
            , [
                "name" => "XS",
                "value" => "XS",
            ]
            , [
                "name" => "فری سایز",
                "value" => "فری سایز",
            ]
            , [
                "name" => "2XL-3XL",
                "value" => "2XL-3XL",
            ]
            , [
                "name" => "9-10 سال",
                "value" => "9-10 سال",
            ]
            , [
                "name" => "XXS",
                "value" => "XXS",
            ]
            , [
                "name" => "3-6 ماه",
                "value" => "3-6 ماه",
            ]
            , [
                "name" => "52-54",
                "value" => "52-54",
            ]
            , [
                "name" => "12-18 ماه",
                "value" => "12-18 ماه",
            ]
            , [
                "name" => "3-4 سال",
                "value" => "3-4 سال",
            ]
            , [
                "name" => "0-3 ماه",
                "value" => "0-3 ماه",
            ]
            , [
                "name" => "48-50",
                "value" => "48-50",
            ]
            , [
                "name" => "5-6 سال",
                "value" => "5-6 سال",
            ]
            , [
                "name" => "6-12 ماه",
                "value" => "6-12 ماه",
            ]
            , [
                "name" => "56-58",
                "value" => "56-58",
            ]
            , [
                "name" => "L",
                "value" => "L",
            ]
            , [
                "name" => "XL",
                "value" => "XL",
            ]
            , [
                "name" => "4-5 سال",
                "value" => "4-5 سال",
            ]
            , [
                "name" => "XXXS",
                "value" => "XXXS",
            ]
            , [
                "name" => "42",
                "value" => "42",
            ]
            , [
                "name" => "48",
                "value" => "48",
            ]
            , [
                "name" => "8-9 سال",
                "value" => "8-9 سال",
            ]
            , [
                "name" => "XS",
                "value" => "XS",
            ]
            , [
                "name" => "52",
                "value" => "52",
            ]
            , [
                "name" => "6 تا 12 ماه",
                "value" => "6 تا 12 ماه",
            ]
            , [
                "name" => "1 سال",
                "value" => "1 سال",
            ]
            , [
                "name" => "2 سال",
                "value" => "2 سال",
            ]
            , [
                "name" => "3 سال",
                "value" => "3 سال",
            ]
            , [
                "name" => "4 سال",
                "value" => "4 سال",
            ]
            , [
                "name" => "40",
                "value" => "40",
            ]
            , [
                "name" => "44",
                "value" => "44",
            ]
            , [
                "name" => "46",
                "value" => "46",
            ]
            , [
                "name" => "36-38",
                "value" => "36-38",
            ]
            , [
                "name" => "44-46",
                "value" => "44-46",
            ]
            , [
                "name" => "56",
                "value" => "56",
            ]
            , [
                "name" => "10-11 سال",
                "value" => "10-11 سال",
            ]
            , [
                "name" => "6-12 ماه",
                "value" => "6-12 ماه",
            ]
            , [
                "name" => "8 سال",
                "value" => "8 سال",
            ]
            , [
                "name" => "XXXXS",
                "value" => "XXXXS",
            ]
            , [
                "name" => "XXXXXS",
                "value" => "XXXXXS",
            ]
            , [
                "name" => "11-12 سال",
                "value" => "11-12 سال",
            ]
            , [
                "name" => "13-14 سال",
                "value" => "13-14 سال",
            ]
            , [
                "name" => "6-7 سال",
                "value" => "6-7 سال",
            ]
            , [
                "name" => "L",
                "value" => "L",
            ]
            , [
                "name" => "10-18 ماه",
                "value" => "10-18 ماه",
            ]
            , [
                "name" => "60-62",
                "value" => "60-62",
            ]
        ];

        foreach ($variants as $variant) {
            Variant::create($variant);
        }

        foreach ($colors as $color) {
            $color['variant_id'] = 1;
            VariantValue::create($color);
        }

        foreach ($sizes as $size) {
            $size['variant_id'] = 2;
            VariantValue::create($size);
        }
    }
}
