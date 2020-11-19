<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Validator;
use App\Models\User;
use App\Models\EmailTemplate;
use DB;
class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }
	 
	public function showLinkRequestForm()
    {
		
        return view('auth.passwords.email');	
    }
	
	
	public function sendResetLinkEmail(Request $request)
    {
	
		$rules = array('email' => 'required|email');
		$validator = Validator::make($request->input(), $rules);
		if ($validator->fails())
		{
		
			return redirect('password/reset')->withErrors($validator);
		}
		else
		{
	
			$user = User::where('email',$request->email)->get();
			
			//IF EMAIL FOUND IN DB THEN NEED TO SEND EMAIL LINK TO RESET THE PASSWORD 
			if(count($user)>0){
				
			//SEND PASSWORD RESET LINK IN EMAIL .
			$token	= getToken();
			$uname 	= $user[0]->owner_name;
			$logo 	= url('/img/logo.png');
			$url 	= url('password/reset/'.$token);
			$link   = $url ;
			$to 	= $request->email;
			//EMAIL FORGOT EMAIL TEMPLATE 
			$result = EmailTemplate::where('template_name','forgot_password')->get();
			$subject = $result[0]->subject;
      		$message_body = $result[0]->content;
      		
      		$list = Array
              ( 
                 '[NAME]' => $uname,
                 '[LINK]' => $link,
                 '[LOGO]' => $logo,
              );

      		$find = array_keys($list);
      		$replace = array_values($list);
      		$message = str_ireplace($find, $replace, $message_body);
			
      		//$from = 'test@test.com';
      		//$fromname = 'cdr';

           // echo $message; die;
			//$mail = send_email($to, $subject, $message, $from, $fromname);
			$data = array('email'=>$request->email,'token'=>$token,'created_at'=>date('Y-m-d H:i:s'));
			//$result = DB::table('password_resets')->where('email', '=' ,$request->email)->get();
			DB::table('password_resets')->where('email', '=',$request->email)->delete();
			DB::table('password_resets')->insert($data);
			
			$mail = send_email($to, $subject, $message);
			return redirect('password/reset')->with('success','Please check your email for password reset.');	
		
			}else{
				
				    return redirect('password/reset')->with('error','Your email not found.');
			}
		   
		}
    }
	
	
	
}
