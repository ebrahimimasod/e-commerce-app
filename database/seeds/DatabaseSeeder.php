<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->command->info('disableForeignKeyConstraints');
        $this->call(\Modules\User\Database\Seeders\UserDatabaseSeeder::class);
        $this->call(\Modules\Role\Database\Seeders\RoleDatabaseSeeder::class);
        $this->call(\Modules\Role\Database\Seeders\PermissionDatabaseSeeder::class);
        $this->call(\Modules\Province\Database\Seeders\ProvinceDatabaseSeeder::class);
        $this->call(\Modules\Province\Database\Seeders\CityDatabaseSeeder::class);
        $this->call(\Modules\Category\Database\Seeders\CategoryDatabaseSeeder::class);
        $this->call(\Modules\Brand\Database\Seeders\BrandDatabaseSeeder::class);
        $this->call(\Modules\Property\Database\Seeders\PropertyDatabaseSeeder::class);
        $this->call(\Modules\Variant\Database\Seeders\VariantDatabaseSeeder::class);
        Schema::enableForeignKeyConstraints();
        $this->command->info('enableForeignKeyConstraints');
    }


}
