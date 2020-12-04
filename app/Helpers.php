<?php
//use DB;

//namespace App\Http\Middleware;
use App\Models\Role;
use App\Models\User;
use App\Models\RolesPermission;
use App\Models\PermissionList;
use App\Models\Setting;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use App\Models\Notification;
use App\Models\EmailTemplate;
use App\Models\StateList;
use App\Models\CityLists;
use App\Models\Company;
use App\Models\Plan;
use Carbon\Carbon;


function banner_photo($user_id){
	
	      $user_data = User::where('id',$user_id)->get();
		  $banner_image =   url('/uploads/users').'/'. $user_data[0]->id .'/'. $user_data[0]->banner_photo;
		  return $banner_image ;

}

//use Config;
// Return User Role ID 
function current_user_role_id(){
	$user = \Auth::user();
	return $user->role_id;
}

function current_user_role_name(){
	$user = \Auth::user();
	$role = Role::where('id',$user->role_id)->get();
	return $role[0]->slug;
} 
/* Get Loggedin User data */
function user_data(){
	$user = \Auth::user();
	return $user;
}

/* Get Current User ID */
function user_id(){
	$user = \Auth::user();
	return $user->id;
}

/* Get User data by ID  */
function user_data_by_id($id){
	$userData = User::where('id',$id)->get();
	return $userData[0];
}

/* Explode by  */
function explodeTo($sign,$data){
	$exp = explode($sign,$data);
	return $exp;
}


function role_data_by_id($id){
	$role = Role::where('id',$id)->get();
	return $role[0];
} 


function validate_token($token){
	
	if($token){
		 //$tokendata = explode('token=',$token);
		
		$accessToken = $token;
		$headers = array(
						 "cache-control: no-cache",
						"content-type: application/json",
						
					);
		$decoded_url = config("services.docoded.url");	
		$urln1 = $decoded_url.'/api/v1/agency/token/';
		
		  
		$curl1 = curl_init($urln1);
		curl_setopt($curl1, CURLOPT_RETURNTRANSFER, 1);
		//curl_setopt($curl1, CURLOPT_POST, true);
		curl_setopt($curl1, CURLOPT_HTTPHEADER, $headers);

		curl_setopt($curl1, CURLOPT_TIMEOUT ,30);
		curl_setopt($curl1, CURLOPT_HTTP_VERSION ,'CURL_HTTP_VERSION_1_1');
		curl_setopt($curl1,   CURLOPT_CUSTOMREQUEST ,'POST');
		curl_setopt($curl1,   CURLOPT_POSTFIELDS ,"{\"token\":\"$accessToken\"}");
		
		$response2 = curl_exec($curl1);
		$response_data = json_decode($response2);
		//pr($response_data);
		$response_array = array();
			
		if($response_data){
			if(isset($response_data->error) && !empty($response_data->error)){
				$response_array['success'] = false;
				$response_array['data'] = $response_data->error;
			}else{
				$response_array['success'] = true;
				$response_array['data'] = $response_data->decodedToken;
				
			}
		}else{
			$response_array['success'] = false;
			$response_array['data'] = "No Data recieved";
		} 
		
		return $response_array;
		
			
	}
	
}

/* Exploade by |  */ 
function split_to_array($sign,$data){
		$data = explode($sign,$data);
		return $data;
}

/* ================================
   If double authentication not set then redirect to below routes of user role base 
============================*/
function redirect_route_name(){
	
	  $role_id = Config::get('constant.role_id');
	  $user_id =user_id();
	  $user_data = user_data_by_id($user_id);
			
	  if(is_null($user_data->otp)){
		  
	   // IF DATA_ADMIN/DATA_ANALYST/CUSTOMER_USER/CUSTOMER_ADMIN 
	   
	   if($role_id['SUPER_ADMIN']== current_user_role_id()){
		  return 'admin/dashboard'; 
	   }
	   else if($role_id['NORMAL_USER']== current_user_role_id()){
		 	return 'edit-profile';				
	   } else if($role_id['INDIA_HEAD']== current_user_role_id()){
		 	return 'edit-profile';					
	   }else if(current_user_role_id() > 2){
		  return 'edit-profile';	
	   }
	   	  
	   }else{
		    \Auth::logout();
		   return 'login'; 
	  }  
}

function profile_photo($user_id){
	   
	  $user_data = User::where('id',$user_id)->get();

	  $profile_photo =  url('/uploads/users').'/'. $user_data[0]->id .'/'. $user_data[0]->profile_photo;
	  return $profile_photo ;

}

function check_role_access($permission_slug){
	
	$user = \Auth::user();
	$current_user_role_id = $user->role_id;
	
	$permission_list_for_role = RolesPermission::where('role_id',$current_user_role_id)->get();
	
	
	$permission_array = array();
	foreach($permission_list_for_role as $permission){
			
		 $slug = PermissionList::where('id',$permission->permission_id)->select('slug')->first();
		 $permission_array[] = $slug->slug;
	}
	
	if(in_array($permission_slug,$permission_array)){
		return true;
	}else{
		return false;
	}
}


//EMAIL SEND 
 function send_email($to='',$subject='',$message='',$from='',$fromname=''){
	try {	
			$mail = new PHPMailer();
			$mail->isSMTP(); // tell to use smtp
			$mail->CharSet = "utf-8"; // set charset to utf8
			
			$setting = Setting::where('id',1)->get();
	
			$mail->SMTPAuth = true;
			$mail->Host = $setting[0]->smtp_host;
			$mail->Port = $setting[0]->smtp_port;
			$mail->Username =$setting[0]->smtp_user;
            $mail->Password = urlsafe_b64decode($setting[0]->smtp_password); 		
			/* $mail->Host = "webethicssolutions.com";
			$mail->Port =587;
			$mail->Username = "php@webethicssolutions.com";
			$mail->Password = "el*cBt#TuRH^"; */
			  
			  //Client SMTP 
			/* $mail->Host = "mail.mgdsw.info";
			$mail->Port =587;
			$mail->Username = "cdr@mgdsw.info";
			$mail->Password = "+UI4cK~Jq2D@bFIB";  */
			
			
			
			if($from!='')
			 $mail->From = $from;
		     else
			 $mail->From = $setting[0]->from_email ;
		 
			if($fromname!='')
			 $mail->FromName = $fromname;
		     else
			 $mail->FromName = $setting[0]->from_name;
			
			$mail->AddAddress($to);
			$mail->IsHTML(true);
			$mail->Subject = $subject;
			$mail->Body = $message;
			//$mail->addReplyTo(‘examle@examle.net’, ‘Information’);
			//$mail->addBCC(‘examle@examle.net’);
			//$mail->addAttachment(‘/home/kundan/Desktop/abc.doc’, ‘abc.doc’); // Optional name
			$mail->SMTPOptions= array(
			'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
			)
			);

			$mail->send();
			return true ;
		}catch (phpmailerException $e) {
				dd($e);
		} catch (Exception $e) {
				dd($e);
		}
		 return false ;
   }
// TOKEN 
	function getToken($length='')
	{
		if($length=='')
			$length =20;
		
		    $token = "";
		    $codeAlphabet = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		    $codeAlphabet.= "abcdefghijklmnopqrstuvwxyz";
		    $codeAlphabet.= "0123456789";
		    $max = strlen($codeAlphabet); // edited

		    for ($i=0; $i < $length; $i++) {
		        $token .= $codeAlphabet[rand(0, $max-1)];
		    }

		    return $token;
	}
	

// GET THE IP ADDRESS 
function get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
  return $ipaddress;
}

// Show Site Title and LOGO 
function showSiteTitle($title){
	$setting = Setting::where('id',1)->first();
	
	if($setting && $title == 'title'){
		if($setting->site_title && $setting->site_title != ''){
			return $setting->site_title;
		}else{
			return trans('global.site_title');
		}
	}else if($setting && $title == 'logo'){
		if($setting->site_logo && $setting->site_logo != ''){

			return url('uploads/logo/'.$setting->site_logo);
		}else{
			return url('/img/logo.svg');
		}
	}
}

function urlsafe_b64decode($string)
{
	$ciphering = "AES-128-CTR";
	$decryption_key = "GeeksforGeeks";
	$options = 0;
	$iv_length = openssl_cipher_iv_length($ciphering);
	$decryption_iv = '1234567891011121';
	return openssl_decrypt ($string, $ciphering,$decryption_key, $options, $decryption_iv);
}

/* Function For the image */ 
function timthumb($img,$w,$h){

		  $user_img =  url('plugin/timthumb/timthumb.php').'?src='.$img.'&w='.$w.'&h='.$h.'&zc=0&q=99';

		  return $user_img ;

}

function list_states(){
	$statesData = StateList::all();
	return $statesData;
}

function list_companies(){
	$CompanyData = Company::all();
	return $CompanyData;
}

function list_plans(){
	$planData = Plan::all();
	return $planData;
}

function relationsArray(){
	//$array = array();
	$array = array(
				'wife'=>'Wife',
				'husband'=>'Husband',
				'daughter'=>'Daughter',
				'son'=>'Son',
				'mother'=>'Mother',
				'father'=>'Father',
				'brother'=>'Brother', 	
				'sister'=>'Sister',
			);

	return $array;			
}
function birth_years(){
	$birth_years = collect(range(12, 5))->map(function ($item) {
		return (string) date('Y') - $item;
	});
	return $birth_years;
}
function getStateNameByStateId($state_id){
	$state_name = '';
	$getname = StateList::where('id',$state_id)->select('state_name')->first();
	if(!is_null($getname) && ($getname->count())>0)
		$state_name = $getname->state_name;
	return $state_name;
}
function getDistrictNameByDistrictId($district_id){
	$district_name = '';
	$getname = CityLists::where('id',$district_id)->select('city_name')->first();
	if(!is_null($getname) && ($getname->count())>0)
		$district_name = $getname->city_name;
	return $district_name;
}
function viewDateFormat($date){
	return Carbon::parse($date)->format(config('constant.FRONT_DATE_FORMAT'));
}
function pr($data){

  echo "<pre>";
  print_r($data);
  echo "</pre>" ;die;
}
/*
*Display policy number
*/
function generatePolicyNumber($userId){
	$policyId = '#'.str_pad($userId, 8, '0', STR_PAD_LEFT);
	return $policyId;
}

