<?php

namespace Modules\Property\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Property\Entities\Property;
use Modules\Property\Entities\PropertyItem;

class PropertyDatabaseSeeder extends Seeder
{

    public function run()
    {
        Property::truncate();
        PropertyItem::truncate();
        DB::table('category_property')->truncate();


        $properties = array(
            array('id' => '1','name' => 'مشخصات کلی','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:10:25','updated_at' => '2020-03-13 13:10:25'),
            array('id' => '2','name' => 'ابعاد','data_type' => 'text','search_able' => '1','parent_id' => '1','created_at' => '2020-03-13 13:10:46','updated_at' => '2020-03-13 13:10:46'),
            array('id' => '3','name' => 'توضیحات سیم کارت','data_type' => 'select','search_able' => '0','parent_id' => '1','created_at' => '2020-03-13 13:12:01','updated_at' => '2020-05-01 03:13:27'),
            array('id' => '4','name' => 'وزن','data_type' => 'text','search_able' => '1','parent_id' => '1','created_at' => '2020-03-13 13:12:12','updated_at' => '2020-03-13 13:12:12'),
            array('id' => '5','name' => 'ساختار بدنه','data_type' => 'text','search_able' => '1','parent_id' => '1','created_at' => '2020-03-13 13:12:23','updated_at' => '2020-03-13 13:12:23'),
            array('id' => '6','name' => 'ویژگی‌های خاص','data_type' => 'text','search_able' => '1','parent_id' => '1','created_at' => '2020-03-13 13:12:32','updated_at' => '2020-03-13 13:12:32'),
            array('id' => '7','name' => 'تعداد سیم کارت','data_type' => 'select','search_able' => '1','parent_id' => '1','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '8','name' => 'پردازنده','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:13:38','updated_at' => '2020-03-13 13:13:38'),
            array('id' => '9','name' => 'تراشه','data_type' => 'text','search_able' => '1','parent_id' => '8','created_at' => '2020-03-13 13:13:58','updated_at' => '2020-03-13 13:13:58'),
            array('id' => '10','name' => 'پردازنده‌ی مرکزی','data_type' => 'text','search_able' => '1','parent_id' => '8','created_at' => '2020-03-13 13:14:06','updated_at' => '2020-03-13 13:14:06'),
            array('id' => '11','name' => 'نوع پردازنده','data_type' => 'select','search_able' => '0','parent_id' => '8','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-05-01 03:13:54'),
            array('id' => '12','name' => 'فرکانس پردازنده‌ی مرکزی','data_type' => 'text','search_able' => '1','parent_id' => '8','created_at' => '2020-03-13 13:15:48','updated_at' => '2020-03-13 13:15:48'),
            array('id' => '13','name' => 'حافظه','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:16:04','updated_at' => '2020-03-13 13:16:04'),
            array('id' => '14','name' => 'حافظه داخلی','data_type' => 'select','search_able' => '1','parent_id' => '13','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '15','name' => 'مقدار RAM','data_type' => 'select','search_able' => '1','parent_id' => '13','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '16','name' => 'پشتیبانی از کارت حافظه جانبی','data_type' => 'select','search_able' => '0','parent_id' => '13','created_at' => '2020-03-13 13:18:37','updated_at' => '2020-05-01 03:55:45'),
            array('id' => '17','name' => 'حداکثر ظرفیت کارت حافظه','data_type' => 'select','search_able' => '0','parent_id' => '13','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-05-01 03:55:22'),
            array('id' => '18','name' => 'صفحه نمایش','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:19:45','updated_at' => '2020-03-13 13:19:45'),
            array('id' => '19','name' => 'صفحه نمایش رنگی','data_type' => 'select','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:19:58','updated_at' => '2020-05-01 03:30:30'),
            array('id' => '20','name' => 'صفحه نمایش لمسی','data_type' => 'select','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:08','updated_at' => '2020-05-01 03:30:14'),
            array('id' => '21','name' => 'فناوری','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:17','updated_at' => '2020-03-13 13:20:17'),
            array('id' => '22','name' => 'بازه‌ی اندازه صفحه نمایش','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:27','updated_at' => '2020-03-13 13:20:27'),
            array('id' => '23','name' => 'اندازه','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:40','updated_at' => '2020-03-13 13:20:40'),
            array('id' => '24','name' => 'رزولوشن','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:50','updated_at' => '2020-03-13 13:20:50'),
            array('id' => '25','name' => 'تراکم پیکسلی','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:20:59','updated_at' => '2020-03-13 13:20:59'),
            array('id' => '26','name' => 'نسبت صفحه‌نمایش به بدنه','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:21:07','updated_at' => '2020-03-13 13:21:07'),
            array('id' => '27','name' => 'نسبت تصویر','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:21:16','updated_at' => '2020-03-13 13:21:16'),
            array('id' => '28','name' => 'تعداد رنگ','data_type' => 'text','search_able' => '1','parent_id' => '18','created_at' => '2020-03-13 13:21:23','updated_at' => '2020-03-13 13:21:23'),
            array('id' => '29','name' => 'ارتباطات','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:21:37','updated_at' => '2020-03-13 13:21:37'),
            array('id' => '30','name' => 'شبکه های ارتباطی','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:21:54','updated_at' => '2020-03-13 13:21:54'),
            array('id' => '31','name' => 'شبکه 2G','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:22:02','updated_at' => '2020-03-13 13:22:02'),
            array('id' => '32','name' => 'شبکه 3G','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:22:17','updated_at' => '2020-03-13 13:22:17'),
            array('id' => '33','name' => 'شبکه 4G','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:23:11','updated_at' => '2020-03-13 13:23:11'),
            array('id' => '34','name' => 'فن‌آوری‌های ارتباطی','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:23:23','updated_at' => '2020-03-13 13:23:23'),
            array('id' => '35','name' => 'Wi-Fi','data_type' => 'text','search_able' => '1','parent_id' => '29','created_at' => '2020-03-13 13:23:33','updated_at' => '2020-03-13 13:23:33'),
            array('id' => '36','name' => 'دوربین','data_type' => NULL,'search_able' => '1','parent_id' => NULL,'created_at' => '2020-03-13 13:23:55','updated_at' => '2020-03-13 13:23:55'),
            array('id' => '37','name' => 'دوربین','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:24:13','updated_at' => '2020-03-13 13:24:13'),
            array('id' => '38','name' => 'رزولوشن عکس','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:24:21','updated_at' => '2020-03-13 13:24:21'),
            array('id' => '39','name' => 'فناوری فوکوس','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:24:31','updated_at' => '2020-03-13 13:24:31'),
            array('id' => '40','name' => 'فلش','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:24:40','updated_at' => '2020-03-13 13:24:40'),
            array('id' => '41','name' => 'قابلیت‌های دوربین','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:24:47','updated_at' => '2020-03-13 13:24:47'),
            array('id' => '42','name' => 'فیلمبرداری','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:25:18','updated_at' => '2020-03-13 13:25:18'),
            array('id' => '43','name' => 'دوربین سلفی','data_type' => 'text','search_able' => '1','parent_id' => '36','created_at' => '2020-03-13 13:25:26','updated_at' => '2020-03-13 13:25:26')
        );

        $property_items = array(
            array('id' => '1','name' => 'سایز نانو (8.8 × 12.3 میلی‌متر)','property_id' => '3','created_at' => '2020-03-13 13:12:01','updated_at' => '2020-03-13 13:12:01'),
            array('id' => '2','name' => 'سایز میکرو(15 × 20 میلی‌متر)','property_id' => '3','created_at' => '2020-03-13 13:12:01','updated_at' => '2020-03-13 13:12:01'),
            array('id' => '3','name' => 'سایز عادی(30 × 60 میلی‌متر)','property_id' => '3','created_at' => '2020-03-13 13:12:01','updated_at' => '2020-03-13 13:12:01'),
            array('id' => '4','name' => 'بدون سیم کارت','property_id' => '7','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '5','name' => 'یک سیم کارت','property_id' => '7','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '6','name' => 'دو سیم کارت','property_id' => '7','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '7','name' => 'سه سیم کارت','property_id' => '7','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '8','name' => 'چهار سیم کارت','property_id' => '7','created_at' => '2020-03-13 13:13:15','updated_at' => '2020-03-13 13:13:15'),
            array('id' => '9','name' => '16 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '10','name' => '32 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '11','name' => '64 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '12','name' => '128 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '13','name' => '256 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '14','name' => '512 بیت','property_id' => '11','created_at' => '2020-03-13 13:15:37','updated_at' => '2020-03-13 13:15:37'),
            array('id' => '15','name' => '1 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '16','name' => '2 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '17','name' => '4 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '18','name' => '8 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '19','name' => '16 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '20','name' => '32 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '21','name' => '64 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '22','name' => '128 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '23','name' => '256 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '24','name' => '512 گیگابایت','property_id' => '14','created_at' => '2020-03-13 13:17:10','updated_at' => '2020-03-13 13:17:10'),
            array('id' => '25','name' => '1 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '26','name' => '2 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '27','name' => '3 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '28','name' => '4 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '29','name' => '6 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '30','name' => '8 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '31','name' => '12 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '32','name' => '16 گیگابایت','property_id' => '15','created_at' => '2020-03-13 13:18:09','updated_at' => '2020-03-13 13:18:09'),
            array('id' => '33','name' => 'microSD','property_id' => '16','created_at' => '2020-03-13 13:18:37','updated_at' => '2020-03-13 13:18:37'),
            array('id' => '34','name' => 'usb','property_id' => '16','created_at' => '2020-03-13 13:18:37','updated_at' => '2020-03-13 13:18:37'),
            array('id' => '35','name' => '16 گیگابایت','property_id' => '17','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-03-13 13:19:32'),
            array('id' => '36','name' => '32 گیگابایت','property_id' => '17','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-03-13 13:19:32'),
            array('id' => '37','name' => '64 گیگابایت','property_id' => '17','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-03-13 13:19:32'),
            array('id' => '38','name' => '128 گیگابایت','property_id' => '17','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-03-13 13:19:32'),
            array('id' => '39','name' => '512 گیگابایت','property_id' => '17','created_at' => '2020-03-13 13:19:32','updated_at' => '2020-03-13 13:19:32'),
            array('id' => '40','name' => 'بله','property_id' => '20','created_at' => '2020-05-01 03:30:14','updated_at' => '2020-05-01 03:30:14'),
            array('id' => '41','name' => 'خیر','property_id' => '20','created_at' => '2020-05-01 03:30:14','updated_at' => '2020-05-01 03:30:14'),
            array('id' => '42','name' => 'بله','property_id' => '19','created_at' => '2020-05-01 03:30:30','updated_at' => '2020-05-01 03:30:30'),
            array('id' => '43','name' => 'خیر','property_id' => '19','created_at' => '2020-05-01 03:30:30','updated_at' => '2020-05-01 03:30:30')
        );

        $category_property = array(
            array('category_id' => '3','property_id' => '1'),
            array('category_id' => '3','property_id' => '8'),
            array('category_id' => '3','property_id' => '13'),
            array('category_id' => '3','property_id' => '18'),
            array('category_id' => '3','property_id' => '29'),
            array('category_id' => '3','property_id' => '36')
        );

        foreach ($properties as $property){
            Property::create($property);
        }


        foreach ($property_items as $property_item){
            PropertyItem::create($property_item);
        }


        foreach ($category_property as $category_property_item){
            DB::table('category_property')->insert($category_property_item);
        }





    }
}
