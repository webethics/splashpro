<?php 
use App\Models\PermissionList;
use Illuminate\Database\Seeder;

class PermissionListTableSeeder extends Seeder
{
    public function run()
    {
		$PermissionList = [
		['id'         => 1, 'category_id'=>3, 'name'=>'Email: Listing', 'slug'=>'email_listing'],
		['id'         => 2, 'category_id'=>3, 'name'=>'Email: Edit', 'slug'=>'email_edit'],
		['id'         => 3, 'category_id'=>4, 'name'=>'Config: Listing','slug'=> 'config_listing'],
		['id'         => 4,'category_id'=> 2,'name'=> 'Customer: Listing', 'slug'=>'customer_listing'],
		['id'         => 5, 'category_id'=>2, 'name'=>'Customer: Edit', 'slug'=>'customer_edit'],
		['id'         => 6, 'category_id'=>2, 'name'=>'Customer: Manage','slug'=> 'customer_manage'],
		['id'         => 7, 'category_id'=>2, 'name'=>'Customer Status: Edit','slug'=> 'customer_status_edit'],
		['id'         => 8,'category_id'=> 1, 'name'=>'Dashboard : Listing', 'slug'=>'dashboard_listing'],
		['id'         => 9, 'category_id'=>5, 'name'=>'Roles: Listing','slug'=> 'roles_listing'],
		['id'         => 10, 'category_id'=>5, 'name'=>'Roles: Edit', 'slug'=>'roles_edit'],
		['id'         => 11, 'category_id'=>5, 'name'=>'Roles: Create New','slug'=> 'roles_create'],
		['id'         => 12, 'category_id'=>2, 'name'=>'Customer: Create New', 'slug'=>'customer_create'],
		['id'         => 13, 'category_id'=>6, 'name'=>'Account: Listing', 'slug'=>'account_listing'],
		['id'         => 14, 'category_id'=>6, 'name'=>'Account:Edit', 'slug'=>'account_edit'],
		['id'         => 15, 'category_id'=>6, 'name'=>'Account:Reset Password','slug'=> 'account_reset_password'],
		['id'         => 16, 'category_id'=>2, 'name'=>'Customer: Delete','slug'=> 'customer_delete'],
		['id'         => 17, 'category_id'=>7, 'name'=>'CMS Pages: Listing', 'slug'=>'cms_pages_listing'],
		['id'         => 18, 'category_id'=>7, 'name'=>'CMS Pages: Create', 'slug'=>'cms_pages_create'],
		['id'         => 19, 'category_id'=>7, 'name'=>'CMS Pages: Edit', 'slug'=>'cms_pages_edit'],
		['id'         => 20, 'category_id'=>7, 'name'=>'CMS Pages: Delete', 'slug'=>'cms_pages_delete']];

        PermissionList::insert($PermissionList);
    }
}
?>