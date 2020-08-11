<?php

namespace Modules\Category\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Category\Entities\Category;

class CategoryDatabaseSeeder extends Seeder
{
    public function run()
    {
        $categories = [
            [
                'name_fa' => 'کالای دیجیتال',
                'name_en' => 'electronic devices',
                'image' => 'mdi-laptop',
                'parent_id' => null,
                'children' => [
                    [
                        'name_en' => 'category-mobile',
                        'name_fa' => 'موبایل',
                        'children' => [
                            [
                                'name_fa' => 'گوشی موبایل',
                                'name_en' => 'category-mobile-phone',
                            ],
                            [
                                'name_fa' => 'لوازم جانبی گوشی موبایل',
                                'name_en' => 'category-mobile-accessories',
                            ],


                        ],
                    ],
                    /* [
                         'name_en' => 'category-tablet-ebook-reader',
                         'name_fa' => 'تبلت و کتابخوان',
                         'children' => [
                             [
                                 'name_fa' => 'تبلت',
                                 'name_en' => 'category-tablet',
                             ],
                             [
                                 'name_fa' => 'کتاب‌خوان و کاغذ دیجیتالی',
                                 'name_en' => 'category-ebook-reader',
                             ],
                             [
                                 'name_fa' => 'رهیاب ماهواره‌ای',
                                 'name_en' => 'category-gps-navigator',
                             ],
                             [
                                 'name_fa' => 'لوازم جانبی تبلت',
                                 'name_en' => 'category-tablet-accessories',
                                 'children' => [
                                     [
                                         'name_fa' => 'کیف و کاور تبلت',
                                         'name_en' => 'category-tablet-bag-and-cover/',
                                     ],
                                     [
                                         'name_fa' => 'محافظ صفحه نمایش تبلت',
                                         'name_en' => 'category-tablet-screen-guard/',
                                     ],
                                     [
                                         'name_fa' => 'استند تبلت',
                                         'name_en' => 'category-tablet-stand/',
                                     ],
                                     [
                                         'name_fa' => 'کیبورد مخصوص تبلت',
                                         'name_en' => 'category-tablet-keyboard/',
                                     ],
                                     [
                                         'name_fa' => 'قلم لمسی (Stylus)',
                                         'name_en' => 'category-stylus/',
                                     ],
                                     [
                                         'name_fa' => 'باتری تبلت',
                                         'name_en' => 'category-tablet-battery/',
                                     ],
                                     [
                                         'name_fa' => 'کارت حافظه',
                                         'name_en' => 'category-memory-cards/',
                                     ],
                                     [
                                         'name_fa' => 'کیت تمیز کننده',
                                         'name_en' => 'category-cleaner-kit/',
                                     ],
                                     [
                                         'name_fa' => 'هندزفری',
                                         'name_en' => 'category-handsfree/',
                                     ],
                                     [
                                         'name_fa' => 'گیفت کارت',
                                         'name_en' => 'category-gift-card/',
                                     ],
                                 ],
                             ],


                         ],
                     ],
                     [
                         'name_en' => 'category-laptop',
                         'name_fa' => 'لپ تاپ',
                         'children' => [
                             [
                                 'name_en' => 'category-notebook-netbook-ultrabook',
                                 'name_fa' => 'لپ تاپ و الترابوک'
                             ],
                             [
                                 'name_en' => 'category-laptop-accessories',
                                 'name_fa' => 'لوازم جانبی لپ تاپ',
                                 'children' => [
                                     [
                                         'name_fa' => 'باتری لپ‌تاپ',
                                         'name_en' => 'category-labtop-battery',
                                     ], [
                                         'name_fa' => 'شارژر مخصوص لپ‌تاپ',
                                         'name_en' => 'category-labtop-charger',
                                     ], [
                                         'name_fa' => 'لوازم جانبی مک بوک',
                                         'name_en' => 'category-macbook-accessories',
                                     ], [
                                         'name_fa' => 'کابل های رابط',
                                         'name_en' => 'category-connector-cable',
                                     ],
                                 ]
                             ],
                         ],
                     ],
                     [
                         'name_en' => 'category-camera',
                         'name_fa' => 'دوربین',

                     ],
                     [
                         'name_en' => 'category-computer-parts',
                         'name_fa' => 'کامپیوتر و تجهیزات جانبی',

                     ],
                     [
                         'name_en' => 'category-office-machines',
                         'name_fa' => 'ماشین های اداری',

                     ],
                     [
                         'name_en' => 'category-wearable-gadget',
                         'name_fa' => 'ساعت و مچ بند هوشمند',

                     ],
                     [
                         'name_en' => 'category-accessories-main',
                         'name_fa' => 'لوازم جانبی کالای دیجیتال',

                     ],
                     [
                         'name_en' => 'category-game-console',
                         'name_fa' => 'کنسول بازی',

                     ],*/
                ],
            ],
            [

                'name_fa' => 'آرایشی، بهداشتی و سلامت',
                'name_en' => 'personal-appliance',
                'image' => 'mdi-heart-pulse',
                'parent_id' => null,
            ],
            [
                'id' => 3,
                'name_fa' => 'خودرو، ابزار و اداری',
                'name_en' => 'vehicles',
                'image' => 'mdi-tools',
                'parent_id' => null,
            ],
            [
                'id' => 4,
                'name_fa' => 'مد و پوشاک',
                'name_en' => 'apparel',
                'image' => 'mdi-tshirt-crew-outline',
                'parent_id' => null,
            ],
            [
                'id' => 5,
                'name_fa' => 'خانه و آشپزخانه',
                'name_en' => 'home-and-kitchen',
                'image' => 'mdi-sofa',
                'parent_id' => null,
            ],
            [
                'id' => 6,
                'name_fa' => 'کتاب، لوازم تحریر و هنر',
                'name_en' => 'book-and-media',
                'image' => 'mdi-book-open',
                'parent_id' => null,
            ],
            [
                'id' => 7,
                'name_fa' => 'اسباب بازی، کودک و نوزاد',
                'name_en' => 'mother-and-child',
                'image' => 'mdi-baby',
                'parent_id' => null,
            ],
            [
                'id' => 8,
                'name_fa' => 'ورزش و سفر',
                'name_en' => 'sport-entertainment',
                'image' => 'mdi-bike',
                'parent_id' => null,
            ],
            [
                'id' => 9,
                'name_fa' => 'خوردنی و آشامیدنی',
                'name_en' => 'food-beverage',
                'image' => 'mdi-food',
                'parent_id' => null,
            ],
        ];
        Category::truncate();

        foreach ($categories as $item) {
            $category = Category::create([
                'depth' => 1,
                'name_fa' => $item['name_fa'],
                'name_en' => $item['name_en'],
                'parent_id' => isset($item['parent_id']) ? $item['parent_id'] : null,
            ]);
            $this->makeChildrenCategory($item, $category, 2);

        }
    }

    private function makeChildrenCategory($item, $category, $depth)
    {
        if (isset($item['children'])) {
            foreach ($item['children'] as $child) {
                $subCategory = Category::create([
                    'depth' => $depth,
                    'name_fa' => $child['name_fa'],
                    'name_en' => $child['name_en'],
                    'parent_id' => $category->id
                ]);
                $this->makeChildrenCategory($child, $subCategory, 3);
            }
        }
    }
}
