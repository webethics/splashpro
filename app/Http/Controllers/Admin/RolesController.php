<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\PermissionList;
use App\Models\PermissionCategory;
use App\Models\RolesPermission;
use Auth;
use Config;
use Response;
use Hash;
use DB;
use DateTime;
use Carbon\Carbon;

class RolesController extends Controller
{
	protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
    }
	
	public function roles()
    {
		access_denied_user('roles_listing');
		$roles = Role::get();
        return view('admin.roles.roles',compact('roles'));	
	}
	
	public function roles_edit($role_id)
    {
		access_denied_user('roles_edit');
        $roles = Role::where('id',$role_id)->with('rolePermissions')->first();
		
		$permission_array = array();
		foreach($roles->rolePermissions as $permission){
			 $permission_array[] = $permission->permission_id;
			 $roles->permissionArray = $permission_array;
		}
		$listPermission  = PermissionCategory::with('permissionList')->get();
		
		//$listPermission = PermissionList::all();
		if($roles){
			$view = view("modal.roleEdit",compact('roles','listPermission'))->render();
			$success = true;
		}else{
			$view = '';
			$success = false;
		}
		
		return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200);
    }
	
	public function role_create()
    {
		access_denied_user('roles_create');
		$roles = Role::all();
		//$listPermission = PermissionList::all();
		$listPermission  = PermissionCategory::with('permissionList')->get();
		//echo '<pre>';print_r($listPermission->toArray());die;
		$view = view("modal.roleCreate",compact('roles','listPermission'))->render();
		$success = true;

        return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200);
    }
	
	public function role_permission_update(UpdateRoleRequest $request)
    {
		/* $roles = Role::all();
		$listPermission = PermissionList::all();
		$view = view("modal.roleCreate",compact('roles','listPermission'))->render(); */
		//echo '<pre>';print_r($request->all());die;
		if($request->ajax()){
			
			$data =array();
			$rolesData = Role::where('id',$request->role_id);
			$data['title']	= $request->title;
			$data['slug']	= $this->slugify($request->title);
			//$data['id']		= $request->role_id;
			if($data['title']){
				$roledata = $rolesData->update($data);
				if($roledata){
					RolesPermission::where('role_id',$request->role_id)->delete();
					$permission_data = $request->permissions;
					foreach($permission_data as $value){
						$final_permission['role_id'] = $request->role_id;
						$final_permission['permission_id'] = $value;
						$permission_data_final = RolesPermission::create($final_permission);
					}
				}
			}
			 return Response::json(array(
					  'success'=>true,
					  
					), 200);
		
		}

       
    }
	public function role_permission_create(CreateRoleRequest $request)
    {
		if($request->ajax()){
			
			$data =array();
			$data['title']	= $request->title;
			$data['slug']	= $this->slugify($request->title);
			if($data['title']){
				$roledata = Role::create($data);
				if($roledata){
					$permission_data = $request->permissions;
					foreach($permission_data as $value){
						$final_permission['role_id'] = $roledata->id;
						$final_permission['permission_id'] = $value;
						$permission_data_final = RolesPermission::create($final_permission);
					}
				}
			}
			return Response::json(array(
			  'success'=>true,
			 ), 200);
			 
		
		}
    }
	
	
	
	public function role_delete($role_id){
		if($role_id){
			$main_user  = Role::where('id',$role_id)->first();
			$userWithRole = User::where('role_id',$role_id)->first();
			if($role_id != 1 && $role_id!= 2){
				
				if($userWithRole){
					$result =array('success' => false,'message'=>'This Role Contained Users So it cannot be deleted.');	
					return Response::json($result, 200);
				}else{
					Role::where('id',$role_id)->delete();
					$result =array('success' => true);	
					return Response::json($result, 200);
				}
			}else{
				
				$result =array('success' => false,'message'=>'This account can not be deleted');	
				return Response::json($result, 200);
			}
			
		}
	}
	
	function slugify($string, $replace = array(), $delimiter = '-') {
		// https://github.com/phalcon/incubator/blob/master/Library/Phalcon/Utils/Slug.php
		if (!extension_loaded('iconv')) {
		throw new Exception('iconv module not loaded');
		}
		// Save the old locale and set the new locale to UTF-8
		$oldLocale = setlocale(LC_ALL, '0');
		setlocale(LC_ALL, 'en_US.UTF-8');
		$clean = iconv('UTF-8', 'ASCII//TRANSLIT', $string);
		if (!empty($replace)) {
		$clean = str_replace((array) $replace, ' ', $clean);
		}
		// $clean = preg_replace("/[^a-zA-Z0-9\/_|+ -]/", '', $clean);
		$clean = strtolower($clean);
		$clean = preg_replace("/[\/_|+ -!@#$%^&*()]+/", $delimiter, $clean);
		$clean = trim($clean, $delimiter);
		// Revert back to the old locale
		setlocale(LC_ALL, $oldLocale);
		return $clean;
	}
	
	
}	