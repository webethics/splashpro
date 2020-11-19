<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Config;
use App\Models\Setting;
use App\Models\User;
use App\Models\EmailTemplate;
use Auth;
use Session;
use App\Models\Role;
use App\Models\AuditLog;
class LoginController extends Controller
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

    use AuthenticatesUsers;
	
	  
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
		
		$this->middleware('guest')->except('logout');
	 //  $this->middleware('auth');
	
    }
	
	
	
	public function login(Request $request)
    {   
		
	
        $input = $request->all();
		
		$rules = array('email' => 'required|email|exists:users,email',
				   'password' => 'required',
				   );

		$validator = Validator::make($request->input(), $rules);
		if ($validator->fails())
		{
			//EVENT FAILED
			return redirect('login')->withErrors($validator)->withInput($request->except('password'));
		}else
		{
			
			if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password'])))
			{ 
	
	
		        //IF STATUS IS NOT ACTIVE 
				if(Auth::check() && Auth::user()->verify_token !=NULL){
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return redirect('/login')->with('error', 'Please be sure to check your junk mail as well - sometimes it ends up there sadly!');
				}else if(Auth::check() && Auth::user()->status == 0){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return redirect('/login')->with('error', 'Your account is deactivated.');
				
				}else if(Auth::check() && Auth::user()->role_id == 1){ 
					//IF STATUS IS NOT ACTIVE 
					//EVENT FAILED
					//create_failed_attemp_log($input['email'],$input['password']);
					Auth::logout();
					return redirect('/login')->with('error', 'Please enter correct credentials.');
				}
				
				
			  $user = auth()->user();
			  $role_id =  $user->role_id;
			  Session::put('is_admin_login', '');
			  if( $request->session()->get('user-profile')){
				  if(strpos($request->session()->get('user-profile'), '/u') !== false)
				   return redirect( $request->session()->get('user_profile'));
			  }else{
				return redirect('user-profile');
			  }
			
			}
			else{
				//EVENT FAILED
				//create_failed_attemp_log($input['email'],$input['password']);
				return redirect()->route('login')
					->with('error','You have entered wrong details.');
			}
		}

    }
	
}
