<?php

namespace Modules\Role\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Modules\Role\Entities\Role;
use Modules\User\Entities\User;

class RoleDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();
        DB::table('role_user')->truncate();
        $roles = [
            ['name' => 'مدیر کل']
        ];


        foreach ($roles as $role) {
            Role::create($role);
        }


        $data = [
            'user_id' => User::first()->id,
            'role_id' => Role::first()->id,
        ];
        DB::table('role_user')->insert($data);
    }
}
