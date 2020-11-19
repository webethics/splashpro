<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResetPassword;
use App\Models\User;
use App\Models\EmailTemplate;
use DB;
use Hash;
class ResetPasswordController extends Controller
{
    
	
	//RESET FORM DATA 
	public function showResetForm($token)
    {
		
		
		$result = DB::table('password_resets')->where('token', '=' ,$token)->get();
		$notwork =false; 
		if(count($result)>0){
		 //$current_date = '2019-12-13 14:30:12'; 
		/* $current_date = date('Y-m-d H:i:s'); 
		$to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $result[0]->created_at);
		$from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $current_date);
        $diff_in_hours = $to->diffInHours($from); */
      // echo $diff_in_days = $to->diffInHours($from);
		//IF NUMBER OF DAY MORE THEN 24 HOURS
		/* $expired =false; 
		if($diff_in_hours>24){
			$expired =true; 
		 } */
		    $url_post = url('password/reset');
			$notwork =true; 
			return view('auth.passwords.reset',compact('token','notwork','url_post'));	
		}else{
			
			 return view('auth.passwords.reset',compact('token','notwork','url_post'));
		}
        	
    }
	
	//RESET FORM DATA 
	public function reset(ResetPassword $request)
    {
		
		$result = DB::table('password_resets')->where('token', '=' ,$request->token)->get();
		if(count($result)>0){
		
			$user_Data =  User::where('email',$result[0]->email)->get();
			$userUpdate = User::where('email',$result[0]->email);
			if(count($user_Data)>0){
				$user =DB::table('password_resets')->where('email', '=',$result[0]->email)->delete();
				$newPassword=$request->password; //NEW PASSWORD
				$hashed = Hash::make($newPassword);
				$data['password'] = $hashed;			
				$userUpdate->update($data);
				$url = 'password/reset/'.$request->token;
				return redirect('/login')->with('success','Password has been reset.Please login here.');	
			}else{
				return redirect('password/reset/'.$request->token)->with('error','Something Went Wrong.');	
			}
			
		}
		
        	
    }
	
	
	
	
	//RESET Password of New user 
	public function reset_new_user_password(ResetPassword $request)
    {
	
		$result = User::where('verify_token', '=' ,$request->token)->get();
		if(count($result)>0){
			$userUpdate = User::where('email',$result[0]->email);
			$newPassword=$request->password; //NEW PASSWORD
			$hashed = Hash::make($newPassword);
			$data['verify_token'] =NULL;			
		    $data['status'] =1;	
			$data['password'] = $hashed;			
			$userUpdate->update($data);
			//$url = 'password/reset/'.$request->token;
			return redirect('/login')->with('success','Password has been reset. You can login now.');	
		}  	
    }
	
	
	
}
