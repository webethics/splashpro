<?php 
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
//use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\CreateCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Http\Requests\UpdateUserPassword;
use App\Http\Requests\sendEmailNotification;
use App\Http\Requests\ResetPassword;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\EmailTemplate;
use League\Csv\Writer;	
use Auth;
use Config;
use Response;
use Session;
use Hash;
use DB;
use DateTime;
use Carbon\Carbon;

class CustomersController extends Controller
{
	protected $per_page;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
    }
	
	public function customers(Request $request)
    {
		access_denied_user('customer_listing');
		
        $customers_data = $this->customer_search($request,$pagination=true);
		if($customers_data['success']){
			$customers = $customers_data['customers'];
			$page_number =  $customers_data['current_page'];
			if(empty($page_number))
				$page_number = 1;
			$roles = Role::all();
			if(!is_object($customers)) return $customers;
			if ($request->ajax()) {
				return view('admin.customers.customersPagination', compact('customers','page_number','roles'));
			}
			return view('admin.customers.customers',compact('customers','page_number','roles'));	
		}else{
			return $customers_data['message'];
		}
		
		
	}
	public function customer_view($user_id)
    {
		access_denied_user('customer_certificate_download');
        $user = User::where('id',$user_id)->with('plan')->get();
		
		$roles = Role::all();
		if(count($user)>0){
			$user =$user[0];
			$view = view("modal.customerView",compact('user','roles'))->render();
			$success = true;
		}else{
			$view = '';
			$success = false;
		}
		
        //abort_unless(\Gate::allows('request_edit'), 403);
		
		return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200);
    }
	
	public function customer_search($request,$pagination)
	{
		
		$page_number = $request->page;
		$number_of_records =$this->per_page;
		$first_name = $request->first_name;
		$last_name = $request->last_name;
		$email = $request->email;
		$role_id = $request->role_id;
		$start_date = $request->start_date;
		$end_date = $request->end_date;
		// $mobile = $request->mobile_number;
		$gender = $request->gender;
		$age_from = $request->age_from;
		$age_to = $request->age_to;
			
		
		$result = User::where(`1`, '=', `1`);
			
		if($first_name!='' || $last_name!='' || $role_id!='' || $start_date!='' || $end_date!='' || $email!='' || $gender !='' || $age_from!='' || $age_to!=''){
			
			if($start_date!= '' || $end_date!=''){
				if(empty($end_date))
					$end_date = date('Y-m-d');
				
				if((($start_date!= '' && $end_date=='') || ($start_date== '' && $end_date!='')) || (strtotime($start_date) >= strtotime($end_date))){	
					
					$data = array();
					$data['success'] = false;
					$data['message'] = "date_error";
					return $data; 
				}
			}
			if($age_from!= '' || $age_to!=''){
				if((($age_from!= '' && $age_to=='') || ($age_from== '' && $age_to!='')) || ($age_from >= $age_to)){	
					$data = array();
					$data['success'] = false;
					$data['message'] = "age_error";
					return $data; 
				}else{
					$result->whereBetween('age', array($age_from, $age_to));
				}
			}
			
			$start_date_c = date('Y-m-d',strtotime($start_date));
			$end_date_c= date('Y-m-d',strtotime($end_date));
			
			if(!empty($start_date) &&  !empty($end_date)){
				$result->where(function($q) use ($start_date_c,$end_date_c) {
				$q->whereDate('created_at','>=' ,$start_date_c);
				$q->whereDate('created_at','<=', $end_date_c );
			  });
			} 
			
			
			
			$email_q = '%' . $request->email .'%';
			// check email 
			if(isset($email) && !empty($email)){
				$result->where('email','LIKE',$email_q);
			} 
			
			$first_name_s = '%' . $first_name . '%';
			$last_name_s = '%' . $last_name . '%';
			
			
			// check name 
			if(isset($first_name) && !empty($first_name)){
				$result->where('first_name','LIKE',$first_name_s);
			}
			if(isset($last_name) && !empty($last_name)){
				$result->where('last_name','LIKE',$last_name_s);
			}
		 // 	if(isset($mobile) && !empty($mobile)){
			// 	$result->where('mobile_number','=',$mobile);
			// }
		 	
		 	if(isset($gender) && !empty($gender)){
				$result->where('gender','=',$gender);
			}
		 	
		 	if(isset($role_id) && !empty($role_id)){
				$result->where('role_id',$role_id);
			} 
		}
		
		
		$result->where('role_id', '!=', 1);
		//echo $result->orderBy('created_at', 'desc')->toSql();die;
		
		if($pagination == true){
			$customers = $result->orderBy('created_at', 'desc')->paginate($number_of_records);
		}else{
			$customers = $result->orderBy('created_at', 'desc')->get();
		}
		
		
		$data = array();
		$data['success'] = true;
		$data['customers'] = $customers;
		$data['current_page'] = $page_number;
		return $data;
	}
	
	public function customer_edit($user_id)
    {
		access_denied_user('customer_edit');
        $user = User::where('id',$user_id)->get();
		$roles = Role::all();
		if(count($user)>0){
			$user =$user[0];
			$view = view("modal.customerEdit",compact('user','roles'))->render();
			$success = true;
		}else{
			$view = '';
			$success = false;
		}
		
        //abort_unless(\Gate::allows('request_edit'), 403);
		
		return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200);
    }
	public function customer_create_new(CreateCustomerRequest $request){
		$response = [];
    	$response['success'] = false;
    	$response['message'] = 'Invalid Request';
		if($request->ajax()){
			$data =array();
			$data['first_name']	= $request->first_name;
			$data['last_name'] = $request->last_name; 
			$data['email'] = $request->email;
			$hashed = Hash::make($request->password);
			$data['password'] = $hashed;
			$data['role_id'] = $request->role_id;
			$dat = User::create($data);

			$response['success'] = true;
			$response['message'] = 'New Customer created Successfully';
			
		}
		return Response::json($response, 200);
	}
	public function update_customer(UpdateCustomerRequest $request,$customer_id){
		$data=array();
		$result =array();
		$requestData = User::find($customer_id);
		$stored_data = User::where('id',$customer_id)->first();
		
		if($request->ajax()){
			$data =array();
			$data['first_name']= $request->first_name;
			$data['last_name']= $request->last_name;
			$data['role_id'] = $stored_data->role_id;
			
			$requestData->update($data);
			$result['success'] = true;
			
			//UPDATE PROFILE EVENT LOG END  
			
			$result['full_name'] = $request->first_name.' '.$request->last_name;
			$sno = isset($request->sno) ? $request->sno : 1;
    		$page_number = isset($request->page_number) ? $request->page_number : 1;

    		$customer = $requestData;

    		$result['view'] = view("admin.customers.customerSingleRow",compact('customer','sno','page_number'))->render();
    		$result['class'] = 'user_row_'.$customer->id;
			
			return Response::json($result, 200);
		}
	}
	
	public function customer_create()
    {
		access_denied_user('customer_create');
		//$roles = Role::WhereNotIn('id',[1,3])->get();
		$roles = Role::get();
		//pr($roles);
		$view = view("modal.customerCreate",compact('roles'))->render();
		$success = true;

        return Response::json(array(
		  'success'=>$success,
		  'data'=>$view
		 ), 200);
    }
	
	public function customer_delete($customer_id)
    {
		access_denied_user('customer_delete');
		if($customer_id){
			$main_customer  = User::where('id',$customer_id)->first();
			if($main_customer){
				User::where('id',$customer_id)->delete();
				$result =array('success' => true);	
				return Response::json($result, 200);
			}else{
				$result =array('success' => false);	
				return Response::json($result, 200);
			}
			
		}
	}
	public function export_customers(Request $request)
	{
		$customers_data = $this->customer_search($request,$pagination = false);
		
		$customers  = $customers_data['customers'];
		
		if($customers && count($customers) > 0){
			$records = [];
			foreach ($customers as $key => $customer) {
				$records[$key]['sl_no'] = ++$key;
				$records[$key]['first_name'] = $customer->first_name;
				$records[$key]['last_name'] = $customer->last_name;
				$records[$key]['email'] = $customer->email;
				// $records[$key]['phone'] = $customer->mobile_number;
				
				$records[$key]['address'] =  $customer->address;
				$records[$key]['role'] =  $customer->role_id;
				$records[$key]['registraion'] =  date('d-m-Y h:i:s', strtotime($customer->created_at));
			}
			$header = ['S.No.', 'First Name','Last Name', 'Email', 'Address', 'Role', 'Registration Date/Time'];
		

			//load the CSV document from a string
			$csv = Writer::createFromString('');

			//insert the header
			$csv->insertOne($header);

			//insert all the records
			$csv->insertAll($records);
			@header("Last-Modified: " . @gmdate("D, d M Y H:i:s",$_GET['timestamp']) . " GMT");
			@header("Content-type: text/x-csv");
			// If the file is NOT requested via AJAX, force-download
			if(!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
				header("Content-Disposition: attachment; filename=search_results.csv");
			}
			//
			//Generate csv
			//
			echo $csv;
			exit();
		}else{
			$result =array('success' => false);	
		    return Response::json($result, 200);
		}
		
	}
	
	public function manageCustomer($id){
		// edit user profile
	    $result = DB::table('users')->where('id', '=' , $id)->get();
	    //$email=$result[0]->email;
		
	    if (Auth::loginUsingId($id))
		{
			Session::put('is_admin_login', '1');
			Session::put('user_id',$id);
			return redirect('admin/account');
		}
		else
		{
			return redirect('/admin/login');
		}
		//Session::put('user_id', $result[0]->id);
		
		//return redirect('dashboard');
	}
}
?>