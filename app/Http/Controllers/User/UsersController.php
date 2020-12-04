<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Frontend\UpdateUserProfile;
use App\Http\Requests\Frontend\UpdateUserPassword;

use App\Http\Requests\Frontend\UploadProfilePhoto;
use App\Http\Requests\Frontend\UploadBanner;

use App\Models\Role;
use App\Models\User;
use App\Models\EmailTemplate;
use App\Models\TempRequestUser;
use League\Csv\Writer;	
use Auth;
use Config;
use Response;
use Hash;
use DB;
use DateTime;
use Session;
use Carbon\Carbon;
use Stripe;

class UsersController extends Controller
{
	//Records per page 
	protected $per_page;
	private $qr_code_path;
	public function __construct()
    {
	    
        $this->per_page = Config::get('constant.per_page');
		$this->report_path = public_path('/uploads/users');
    }
	
	public function editProfile()
    {
		//Subscriber list 
		//$subscriber_list = Subscriber::where('user_id', auth::user()->id)->where('status',1)->get();
		
		
		//pr($subscriber_list);
		return view('frontend.creaters.account.account');
		
    }
	/*==================================================
	UPDATE USER PROFILE 
==================================================*/ 	
	public function UpdateEditProfile(UpdateUserProfile $request)
	{
		if($request->ajax()){
			$request->first_name;
			$id = auth::user()->id; 
			$data=array(
			'first_name'=>$request->first_name,
			'last_name'=>$request->last_name,
			);
			
			//check if other user take this name or not 
			$user = User::where('id','==',$id)->get();
			if(count($user) <=0){
				if($request->user_bio)
					$data['user_bio']=$request->user_bio;
					User::where('id',$id)->update($data);
					$result = array('success'=>true);
			}else{
				 $result = array('success'=>false);
			}	
			return Response::json($result, 200);
		}
    }
	
	
	
	
	public function landing_page()
    {
    	
       return view('frontend.creaters.landing.landing');
    }
    
	//VERIFY ACCOUNT  
	public function verifyAccount($token)
    {
		
		$result = User::where('verify_token', '=' ,$token)->get();
		$notwork =false; 
		if(count($result)>0){
			if($result[0]->created_by == 0){
				$userUpdate = User::where('email',$result[0]->email);
				$data['verify_token'] =NULL;			
				$data['status'] =1;		
				$data['created_by'] = 1;
				$userUpdate->update($data);
				return redirect('login')->with('success','Your account is verified.');	;
			}else{
				$url_post = url('password/reset_new_user_password');
				$notwork =true;  
				return view('auth.passwords.reset',compact('token','notwork','url_post'));	
			}
			
		}else{
			 return redirect('login')->with('error','Your Link is not correct to reset password.');	;
		}
		
		
        	
    }
	public function passwordUpdate(UpdateUserPassword $request)
    {
		// IF AJAX
		if($request->ajax()){
			$data=array();
			$userData = user_data();
			$user_id = auth::user()->id; 
			$userUpdate = User::where('id',$user_id);
			$newPassword=$request->password; //NEW PASSWORD
			$hashed = $userData->password;  //DB PASSWORD
	   
			if(Hash::check($request->old_password, $hashed)){
				$hashed = Hash::make($newPassword);
				
				$data['password'] = $hashed;			
				$userUpdate->update($data);
				$result =array(
				'success' => true
				);	
			}else{
				$result =array(
				'success' => false,
				'errors' => array('old_password'=>'Password does not match.')
				);	
			}
			return Response::json($result, 200);
		}
    }	
	
    public function uploadProfilePhoto(UploadProfilePhoto $request)
    {
		// IF AJAX
		if($request->ajax()){
			
			$image_file = $request->upload_profile_file;
			list($type, $image_file) = explode(';', $image_file);
			list(, $image_file)      = explode(',', $image_file);
			$image_file = base64_decode($image_file);
			$image_name= time().'_'.rand(100,999).'.png';
			
			
			$user_data =user_data();
			$user_id =$user_data->id;
			
					
			//CREATE REPORT FOLDER IF NOT 
			if (!is_dir($this->report_path)) {
				mkdir($this->report_path, 0777);
			}
			//CREATE USER ID FOLDER 
			$user_id_path = $this->report_path.'/'.$user_id;
			if (!is_dir($user_id_path)) {
				mkdir($user_id_path, 0777);
			}
			@unlink($user_id_path.'/'.$user_data->profile_photo);
			file_put_contents($user_id_path.'/'.$image_name, $image_file);
			//$image->move($user_id_path, $new_name);
			$userUpdate = User::where('id',$user_id);
			$data['profile_photo'] = $image_name;			
			$userUpdate->update($data);
			$path = url('uploads/users').'/'.$user_id.'/'.$image_name;
		
			$image_url  =  timthumb($path,80,80);
			
			
			  return response()->json([
			   'success'=>true,
			   'message' => 'Image Upload Successfully',
			   'image_url'  => $image_url
			  ]);  
				
		}
    }

	
	public function uploadBannerPhoto(UploadBanner $request)
    {
		// IF AJAX
		if($request->ajax()){
			
				$image = $request->file('upload_banner_file');
				// pr($image->getClientOriginalName());
				//$document_type = $request->document_type;
				$new_name = rand() . '_banner.' . $image->getClientOriginalExtension();
				
				$user_data =user_data();
				$user_id =$user_data->id;
			
					
				//CREATE REPORT FOLDER IF NOT 
				if (!is_dir($this->report_path)) {
					mkdir($this->report_path, 0777);
				}
				//CREATE USER ID FOLDER 
				$user_id_path = $this->report_path.'/'.$user_id;
				if (!is_dir($user_id_path)) {
					mkdir($user_id_path, 0777);
				}
				
			 	@unlink($user_id_path.'/'.$user_data->banner_photo);
				$image->move($user_id_path, $new_name);
				$userUpdate = User::where('id',$user_id);
				$data['banner_photo'] = $new_name;			
			    $userUpdate->update($data);
				$path = url('uploads/users').'/'.$user_id.'/'.$new_name;
				
                $image_url  =  timthumb($path,448,155);
				
				  return response()->json([
				   'success'=>true,
				   'message' => 'Image Upload Successfully',
				   'image_url'  => $image_url
				  ]); 
				
		}
    }	
	
	
   //logout 	
   public function logout()
    {
		 \Auth::logout();
		 Session::put('is_admin_login', '');
		 return redirect('login');
		
    }
	function password_generate($chars) 
	{
	  $data = '1234567890ABCDEFGHIJKLMNOPQRSTUVWXYZabcefghijklmnopqrstuvwxyz';
	  return substr(str_shuffle($data), 0, $chars);
	}
  
}
