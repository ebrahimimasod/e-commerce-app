<?php

namespace Modules\Role\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;
use Modules\Role\Entities\Permission;
use Modules\Role\Entities\Role;

class PermissionDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::truncate();
        DB::table('permission_role')->truncate();
        $permissions = [
            ['label' => Permission::DASHBOARD, 'name' => 'داشبورد'],
            ['label' => Permission::ADMINS, 'name' => 'مدیران'],
            ['label' => Permission::USERS, 'name' => 'کاربران'],
            ['label' => Permission::CATEGORIES, 'name' => 'دسته بندی ها'],
            ['label' => Permission::SLIDERS, 'name' => 'اسلادیر ها'],
            ['label' => Permission::BANNERS, 'name' => 'بنر ها'],
            ['label' => Permission::BRANDS, 'name' => 'برند ها'],
            ['label' => Permission::PROPERTIES, 'name' => 'ویژگی ها'],
            ['label' => Permission::COMMENTS, 'name' => 'نظرات'],
            ['label' => Permission::PRODUCTS, 'name' => 'محصولات'],
            ['label' => Permission::PAYMENTS, 'name' => 'پرداخت ها'],
            ['label' => Permission::DISCOUNT_CODES, 'name' => 'کد های تخفیف'],
            ['label' => Permission::ORDERS, 'name' => 'سفارشات'],
            ['label' => Permission::PAGES, 'name' => 'صفحات'],
            ['label' => Permission::SELLERS, 'name' => 'فروشندگان'],
            ['label' => Permission::SETTINGS, 'name' => 'تنظیمات'],
        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }


        $role_id = Role::first()->id;
        foreach ($permissions as $key => $permission_id) {
            DB::table('permission_role')->insert([
                'role_id' => $role_id,
                'permission_id' => $key + 1,
            ]);
        }
    }
}
