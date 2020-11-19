<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;
//use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Config;
use App\Models\TempRequestUser;
use App\Models\Setting;
use App\Models\User;
use App\Models\EmailTemplate;
use Auth;
use Session;
use App\Models\Role;
use App\Models\AuditLog;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

   // use AuthenticatesUsers;
	
	  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
		//$this->middleware('guest')->except('logout');
	
	 }
	
	
	
	public function index(){
		
		
		
		if(Session::get('admin_user_id')) {
			
    		if(!empty(Session::get('is_admin_login'))  && Session::get('is_admin_login') == 1 && !empty(Session::get('user_id'))){
				Auth::loginUsingId(Session::get('user_id'));
			}
			$user = user_data();
			$user_id = $user->id;
			$temp_details =  TempRequestUser::where('user_id',$user_id)->orderBy('id','desc')->first();
			//echo '<pre>';print_r($nominee_details->toArray());die;
			return view('admin.account.account', compact('user','temp_details'));
    	}
	    else {
			return view('admin.login');	
	    }

	} 
	
	public function login(){
		//check session admin id
		if(Session::get('admin_user_id'))
			return redirect('/admin');
		else
			return view('admin.login');
	}
	
	public function checklogin(Request $request){
		
		//pr($request->all());
		$rules = array('email' => 'required|email',
			'password' => 'required'
		);
		// check login fields validations
		$validator = Validator::make($request->input(), $rules);
		if ($validator->fails()) {
			return redirect('/admin/login')->withErrors($validator)->withInput($request->except('password'));
		}else{
			
			if(Auth::attempt(array('email' =>$request->email, 'password' =>$request->password)))
			{ 
		        //IF STATUS IS NOT ACTIVE 
				if(Auth::check() && Auth::user()->verify_token !=NULL){
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Your account is not verified.Please check your email and verify your account.');
				}else if(Auth::check() && Auth::user()->status == 0){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Your account is deactivated.');
				}else if(Auth::check() && Auth::user()->role_id != 1){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					Auth::logout();
					return redirect('/admin/login')->with('error', 'Please fill correct credential.');
				}
				
				if(Auth::check() && Auth::user()->status == 1){
					$user = Auth::user();
					$role_id =  $user->role_id;
					//$role_id = Config::get('constant.role_id');
					/*flag variables*/
					$is_admin = 0;

					if(!empty($role_id)){
						$fetchUserRole = Role::where('id',$role_id)->first();
						/*If data present*/
						if(!is_null($fetchUserRole) && ($fetchUserRole->count())>0){
							$user_role = $fetchUserRole->slug;
							if($user_role == 'super-admin'){
								// set session value
								Session::put('is_admin_login', '1');
								Session::put('admin_user_id', $user->id);
								Session::put('user_id','');
							}else{
								Session::put('is_admin_login', '0');
								Session::put('admin_user_id','');
								Session::put('user_id',$user->id);
							}
						}
		
					}
					
				}else{
					
					return redirect()->route('/admin/login');
				}
				
			  /* USE/ANALYST/USER-ADMIN LOGIN SETTING ADMIN ENABLE DOUBLE AUTHENTICATION  */ 
			  $setting = Setting::where('user_id',1)->get();
			  //pr($setting);
			  // IF DOUBLE AUTHENTICATION IS ON 
			  if($setting[0]->double_authentication){
				  /* Send OTP to User in email or phone */
				    $otp  = getToken(7); 
				    $usertData = User::where('id',$user->id);
					$data =array();
					$data['otp'] =$otp; 
					$usertData->update($data);
					$to  = $user->email; 
					//EMAIL REGISTER EMAIL TEMPLATE 
					$result = EmailTemplate::where('template_name','one_time_otp')->get();
					$subject = $result[0]->subject;
					$message_body = $result[0]->content;
					$uname = $user->first_name .' '.$user->last_name;
					$logo = url('/img/logo.png');
					
					$list = Array
					  ( 
						 '[NAME]' => $uname,
						 '[OTP]' => $otp,
						 '[LOGO]' => $logo,
					  );

					$find = array_keys($list);
					$replace = array_values($list);
					$message = str_ireplace($find, $replace, $message_body);
	
					$mail = send_email($to, $subject, $message); 
				
				 /*   */
				 return redirect('send-otp')
				->with('message','Please check email or phone for OTP.');
				  
			  }else{		
					
					// IF DOUBLE AUTHENTICATION IS OFF : ANALYST/ADMIN/USER/USER_ADMIN 
					 return redirect(redirect_route_name());
			  }
			}else{
				Session::flash('error', 'Please fill correct credential.');
				return redirect('/admin/login');
			}
			

			/* $result = User::where('email', '=', $request->get('email'))
			->where('password', '=', md5($request->get('password')))
			->where('role_id', '=', '1')
			->first();

			if(!empty($result)){
				$first = $result->first_name;
				$last = $result->last_name;
				$email = $result->email;
				$role_id = $result->role_id;
				$name = $first.' '.$last;
				// set session value
				Session::put('admin_user_id', $result->id);
				Session::put('admin_user_name',ucwords($name));
				Session::put('admin_user_email',$email);
				Session::put('role_id',$role_id);

				return redirect('/admin/');
			}else{
				Session::flash('error', 'Please fill correct credential.');
				return redirect('/admin/login');
			} */
		}
	}
	
}
