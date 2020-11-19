<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
           RolesTableSeeder::class,
            UsersTableSeeder::class,
            SettingsTableSeeder::class, 
			RolesPermissionTableSeeder::class,
			PermissionListTableSeeder::class,
			PermissionCategoryTableSeeder::class,
        	EmailTemplateTableSeeder::class,
        ]);
    }
}
