<?php

namespace Modules\Province\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Province\Entities\Province;

class ProvinceDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Province::truncate();

        $areas = array(
            array('id' => '1', 'name' => 'آذربايجان شرقي'),
            array('id' => '2', 'name' => 'آذربايجان غربي'),
            array('id' => '3', 'name' => 'اردبيل'),
            array('id' => '4', 'name' => 'اصفهان'),
            array('id' => '5', 'name' => 'البرز'),
            array('id' => '6', 'name' => 'ايلام'),
            array('id' => '7', 'name' => 'بوشهر'),
            array('id' => '8', 'name' => 'تهران'),
            array('id' => '9', 'name' => 'چهارمحال بختياري'),
            array('id' => '10', 'name' => 'خراسان جنوبي'),
            array('id' => '11', 'name' => 'خراسان رضوي'),
            array('id' => '12', 'name' => 'خراسان شمالي'),
            array('id' => '13', 'name' => 'خوزستان'),
            array('id' => '14', 'name' => 'زنجان'),
            array('id' => '15', 'name' => 'سمنان'),
            array('id' => '16', 'name' => 'سيستان و بلوچستان'),
            array('id' => '17', 'name' => 'فارس'),
            array('id' => '18', 'name' => 'قزوين'),
            array('id' => '19', 'name' => 'قم'),
            array('id' => '20', 'name' => 'كردستان'),
            array('id' => '21', 'name' => 'كرمان'),
            array('id' => '22', 'name' => 'كرمانشاه'),
            array('id' => '23', 'name' => 'كهكيلويه و بويراحمد'),
            array('id' => '24', 'name' => 'گلستان'),
            array('id' => '25', 'name' => 'گيلان'),
            array('id' => '26', 'name' => 'لرستان'),
            array('id' => '27', 'name' => 'مازندران'),
            array('id' => '28', 'name' => 'مركزي'),
            array('id' => '29', 'name' => 'هرمزگان'),
            array('id' => '30', 'name' => 'همدان'),
            array('id' => '31', 'name' => 'يزد')
        );

        foreach ($areas as $area) {
            Province::create($area);
        }

    }
}
