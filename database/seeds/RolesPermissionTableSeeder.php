<?php 
use App\Models\RolesPermission;
use Illuminate\Database\Seeder;

class RolesPermissionTableSeeder extends Seeder
{
    public function run()
    {
		$RolesPermission = [
		[ 'role_id'=>1, 'permission_id'=>1, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>2, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>3, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>4, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>5, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>6, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>7, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>8, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>9, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>10, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>11, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>12, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>13, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>14, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>15, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>16, 'created'=>'2020-09-04 15:26:54'],		
		[ 'role_id'=>2, 'permission_id'=>17, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>2, 'permission_id'=>18, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>19, 'created'=>'2020-09-04 15:26:54'],
		[ 'role_id'=>1, 'permission_id'=>20, 'created'=>'2020-09-04 15:26:54']];
		

        RolesPermission::insert($RolesPermission);
    }
}
?>