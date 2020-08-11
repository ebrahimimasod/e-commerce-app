<?php

namespace Modules\Brand\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\Brand\Entities\Brand;

class BrandDatabaseSeeder extends Seeder
{
    public function run()
    {
        $brands = array(
            array('id' => '1','name_fa' => 'سامسونگ','name_en' => 'Samsung','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6a9c5d2f2.png','status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '2','name_fa' => 'شیائومی','name_en' => 'Xiaomi','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '3','name_fa' => 'هوآوی','name_en' => 'Huawei','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6abdd61db.jpg','status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '4','name_fa' => 'نوکیا','name_en' => 'Nokia','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '5','name_fa' => 'اپل','name_en' => 'Apple','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '6','name_fa' => 'آنر','name_en' => 'Honor','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '7','name_fa' => 'دوجی','name_en' => 'DOOGEE','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '8','name_fa' => 'ایسوس','name_en' => 'ASUS','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '9','name_fa' => 'موتورولا','name_en' => 'Motorola','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:41','updated_at' => '2020-03-31 20:20:41'),
            array('id' => '10','name_fa' => 'جی پلاس','name_en' => 'G Plus','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '11','name_fa' => 'هیوندای','name_en' => 'Hyundai','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '12','name_fa' => 'اچ تی سی','name_en' => 'HTC','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '13','name_fa' => 'ارد','name_en' => 'Orod','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '14','name_fa' => 'بلو','name_en' => 'Blu','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '15','name_fa' => 'جی ال ایکس','name_en' => 'GLX','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '16','name_fa' => 'کاترپیلار','name_en' => 'CAT','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '17','name_fa' => 'گیگاست','name_en' => 'Gigaset','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '18','name_fa' => 'اسمارت','name_en' => 'Smart','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '19','name_fa' => 'ال جی','name_en' => 'LG','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '20','name_fa' => 'بلک بری','name_en' => 'BlackBerry','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '21','name_fa' => 'سونی','name_en' => 'Sony','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '22','name_fa' => 'انرجایزر','name_en' => 'Energizer','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '23','name_fa' => 'ای نت','name_en' => 'enet','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '24','name_fa' => 'آلکاتل','name_en' => 'Alcatel','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '25','name_fa' => 'جیمو','name_en' => 'Jimo','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '26','name_fa' => 'مارشال','name_en' => 'Marshal','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:42','updated_at' => '2020-03-31 20:20:42'),
            array('id' => '27','name_fa' => 'تکنو','name_en' => 'Tecno','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '28','name_fa' => 'بلو','name_en' => 'Blue','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '29','name_fa' => 'فلای','name_en' => 'Fly','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '30','name_fa' => 'گوگل','name_en' => 'Google','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '31','name_fa' => 'تکنو','name_en' => 'Techno','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '32','name_fa' => 'سونی اریکسون','name_en' => 'Sony Ericsson','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '33','name_fa' => 'میزو','name_en' => 'Meizu','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '34','name_fa' => 'می','name_en' => 'Mi','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '35','name_fa' => 'مایکروسافت','name_en' => 'Microsoft','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '36','name_fa' => 'کن شین دا','name_en' => 'Ken Xin Da','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '37','name_fa' => 'تونینو لامبورگینی','name_en' => 'Tonino Lamborghini','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '38','name_fa' => 'لنوو','name_en' => 'Lenovo','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:43','updated_at' => '2020-03-31 20:20:43'),
            array('id' => '39','name_fa' => 'وان پلاس','name_en' => 'OnePlus','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6a9c57919.jpg','status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-05-01 01:52:17'),
            array('id' => '40','name_fa' => 'لندروور','name_en' => 'LANDROVER','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '41','name_fa' => 'تی پی-لینک','name_en' => 'TP-LINK','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '42','name_fa' => 'زد تی ای','name_en' => 'ZTE','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '43','name_fa' => 'ایسر','name_en' => 'Acer','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '44','name_fa' => 'پنتک','name_en' => 'Pantech','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '45','name_fa' => 'الفون','name_en' => 'ELEPHONE','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '46','name_fa' => 'دیمو','name_en' => 'Dimo','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '47','name_fa' => 'آمازون','name_en' => 'Amazon','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '48','name_fa' => 'آی میت','name_en' => 'i-mate','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '49','name_fa' => 'راگ گیر','name_en' => 'RugGear','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '50','name_fa' => 'پرستیژیو','name_en' => 'Prestigio','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '51','name_fa' => 'ایکس ویژن','name_en' => 'X.Vision','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6ab4c9b2d.png','status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-05-01 01:55:49'),
            array('id' => '52','name_fa' => 'دل','name_en' => 'Dell','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '53','name_fa' => 'جی فایو','name_en' => 'GFive','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '54','name_fa' => 'گیگابایت','name_en' => 'GIGABYTE','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '55','name_fa' => 'ویلی فاکس','name_en' => 'Wileyfox','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '56','name_fa' => 'اسمارترونیکس','name_en' => 'Smartronics','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '57','name_fa' => 'ویسان','name_en' => 'Vsun','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '58','name_fa' => 'وایو','name_en' => 'Vaio','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '59','name_fa' => 'هایر','name_en' => 'Haier','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '60','name_fa' => 'کداک','name_en' => 'Kodak','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:44','updated_at' => '2020-03-31 20:20:44'),
            array('id' => '61','name_fa' => 'اینجو','name_en' => 'Innjoo','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '62','name_fa' => 'مرکوری','name_en' => 'Mercury','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '63','name_fa' => 'مایکرودیا','name_en' => 'Microdia','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '64','name_fa' => 'مینیاتور','name_en' => 'Miniyator','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '65','name_fa' => 'آی لایف','name_en' => 'i-Life','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '66','name_fa' => 'بارنو','name_en' => 'Baarno','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '67','name_fa' => 'آرکاس','name_en' => 'Archos','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '68','name_fa' => 'لیگو','name_en' => 'Leagoo','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '69','name_fa' => 'لاوا','name_en' => 'LAVA','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '70','name_fa' => 'داکس','name_en' => 'DOX','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '71','name_fa' => 'متفرقه','name_en' => 'Miscellaneous','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '72','name_fa' => 'نوین سان','name_en' => 'NOVINSUN','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '73','name_fa' => 'الفا موب','name_en' => 'ALPHA MOB','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '74','name_fa' => 'یولفون','name_en' => 'ulefone','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:45','updated_at' => '2020-03-31 20:20:45'),
            array('id' => '75','name_fa' => 'زوم می','name_en' => 'zoom me','image' => NULL,'status' => '1','created_at' => '2020-03-31 20:20:46','updated_at' => '2020-03-31 20:20:46'),
            array('id' => '76','name_fa' => 'پارس خزر','name_en' => 'parss Khazar','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6a9c5d2f4.png','status' => '1','created_at' => '2020-05-01 01:53:47','updated_at' => '2020-05-01 01:53:47'),
            array('id' => '77','name_fa' => 'پاکشوما','name_en' => 'Pakshoma','image' => env('APP_URL').'/storage/photos/1/brands/5eab4211f2399.png','status' => '1','created_at' => '2020-05-01 01:54:39','updated_at' => '2020-05-01 01:54:39'),
            array('id' => '78','name_fa' => 'پاناسونیک','name_en' => 'Panasonic','image' => env('APP_URL').'/storage/photos/1/brands/5e6b6ab7023b6.png','status' => '1','created_at' => '2020-05-01 01:56:18','updated_at' => '2020-05-01 01:56:31'),
            array('id' => '79','name_fa' => 'هانر','name_en' => 'Honor','image' => env('APP_URL').'/storage/photos/1/brands/5eab42a6190cc.png','status' => '1','created_at' => '2020-05-01 01:57:08','updated_at' => '2020-05-01 01:57:08')
        );
        Brand::truncate();
        DB::table('brand_category')->truncate();
        foreach ($brands as $brand){
            Brand::create([
                'name_fa'=>$brand['name_fa'],
                'name_en'=>$brand['name_en'],
            ]);
            DB::table('brand_category')->insert([
                'brand_id'=> $brand['id'],
                'category_id'=> 3,
            ]);

        }
    }
}
