<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
		[
            'id'             => 1,
            'first_name'     => 'Super',
            'last_name'      => 'Admin',
            'role_id'        => 1,
            'email'          => 'admin@admin.com',
			'otp'          => null,
			'mobile_number'          => null,
			'status' 		 => 1,
			 'password'       => '$2y$10$oQe7HSSnGfgb/5aXLJW9KuPrN6R5Y/cn8S9IKgfYx3zHflfRlDuBq',
            'remember_token' => null,
            'created_at'     => '2019-11-15 19:13:32',
            'updated_at'     => '2019-11-15 19:13:32',
            'deleted_at'     => null,
        ],[
            'id'             => 2,
            'first_name'   	 => 'User',
            'last_name'   	 => 'User',
            'role_id'        => 2,
            'email'          => 'user@user.com',
			'otp'          => null,
			'mobile_number'          => null,
			'status' 		 => 1,
            'password'       => '$2y$10$oQe7HSSnGfgb/5aXLJW9KuPrN6R5Y/cn8S9IKgfYx3zHflfRlDuBq',
            'remember_token' => null,
            'created_at'     => '2019-11-15 19:13:32',
            'updated_at'     => '2019-11-15 19:13:32',
            'deleted_at'     => null,
        ]];

        User::insert($users);
    }
}
