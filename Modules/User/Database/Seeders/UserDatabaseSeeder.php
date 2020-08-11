<?php

namespace Modules\User\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\User\Entities\User;

class UserDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();
        User::create([
            'first_name' =>  'مسعود',
            'last_name'  =>  'ابراهیمی',
            'mobile'     =>  '09223173902',
            'email'      =>  'ebrahimimasod@gmail.com',
            'status'     =>  true,
            'password'   =>  bcrypt('123456'),
            'level'      =>  User::ADMIN_LEVEL['value']
        ]);

    }
}
