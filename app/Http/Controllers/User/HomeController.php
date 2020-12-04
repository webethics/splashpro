<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UpdatePlanRequest;


use App\Models\Download;
use App\Models\Role;
use App\Models\User;use App\Models\Plan;
use App\Models\Subscription;
use App\Models\EmailTemplate;
use App\Models\TempRequestUser;
use League\Csv\Writer;	
use Auth;
use Config;
use App\Models\CmsPage;
use Response;
use Hash;
use DB;
use Stripe;
use DateTime;
use Session;
use Carbon\Carbon;

class HomeController extends Controller
{
	//Records per page 
	protected $per_page;
	private $qr_code_path;
	public function __construct()
    {
		
		
    }
	
	public function home_page(Request $request)
    {
		
		
		if (request()->token) {
			$token =request()->token;
			$data = validate_token($token);
			if($data['success']){
				$user_data = $data['data'];
				Session::put('user_email',$user_data->email);
				Session::put('token',$token);
				Session::put('token_validation','yes');
				return view('frontend.pages.home.services',compact('user_data'));
			}else{
				Session::put('user_email','');
				Session::put('token','');
				Session::put('token_validation','no');
				return redirect('error')->with('error',$data['data']);
			}
		}else{
			Session::put('token','');
			Session::put('token_validation','no');
			return view('frontend.pages.home.services');
		}
		
    }
	public function services(Request $request)
    {
		
		if (request()->token) {
			$token =request()->token;
			$data = validate_token($token);
			if($data['success']){
				$user_data = $data['data'];
				Session::put('token',$token);
				Session::put('user_email',$user_data->email);
				Session::put('token_validation','yes');
				return view('frontend.pages.home.services',compact('user_data'));
			}else{
				Session::put('user_email','');
				Session::put('token','');
				Session::put('token_validation','no');
				return redirect('error')->with('error',$data['data']);
			}
		}else{
			Session::put('token','');
			Session::put('token_validation','no');
			return view('frontend.pages.home.services');
		}
		
		
    }

	public function traffic(Request $request)
    {
		if (request()->token) {
			$token =request()->token;
			$data = validate_token($token);
			if($data['success']){
				$user_data = $data['data'];
				Session::put('token',$token);
				Session::put('user_email',$user_data->email);
				Session::put('token_validation','yes');
				return view('frontend.pages.home.traffics',compact('user_data'));
			}else{
				Session::put('user_email','');
				Session::put('token','');
				Session::put('token_validation','no');
				return redirect('error')->with('error',$data['data']);
			}
		}else{
			Session::put('token','');
			Session::put('token_validation','no');
			return view('frontend.pages.home.traffics');
		}
		
    }
	public function leads(Request $request)
    {
		if (request()->token) {
			$token =request()->token;
			$data = validate_token($token);
			if($data['success']){
				$user_data = $data['data'];
				Session::put('token',$token);
				Session::put('user_email',$user_data->email);
				Session::put('token_validation','yes');
				return view('frontend.pages.home.leads',compact('user_data'));
			}else{
				Session::put('user_email','');
				Session::put('token','');
				Session::put('token_validation','no');
				return redirect('error')->with('error',$data['data']);
			}
		}else{
			Session::put('token','');
			Session::put('token_validation','no');
			return view('frontend.pages.home.leads');
		}
		
    }
	public function vseo(Request $request)
    {
		if (request()->token) {
			$token =request()->token;
			$data = validate_token($token);
			if($data['success']){
				$user_data = $data['data'];
				Session::put('token',$token);
				Session::put('user_email',$user_data->email);
				Session::put('token_validation','yes');
				return view('frontend.pages.home.vseo',compact('user_data'));
			}else{
				Session::put('token','');
				Session::put('user_email','');
				Session::put('token_validation','no');
				return redirect('error')->with('error',$data['data']);
			}
		}else{
			Session::put('token','');
			Session::put('token_validation','no');
			return view('frontend.pages.home.vseo');
		}
		
    }
	
	public function error(){
		return view('frontend.pages.home.error');
		
	}
	public function updatePlan(UpdatePlanRequest $request){
		
		$data = [];
        $data['success'] = false;
        $data['message'] = 'Something went wrong';

    	if($request->ajax()){
			$stripe = Stripe::make(config('services.stripe.secret'));
			try{
				$stripe_plan_id = $request->get('plan');
				$customer = $stripe->customers()->create([
					'email' => Session::get('user_email')
				]);

				if(!empty($customer)){
					$customer_id = $customer['id'];
				}
				
				if(!empty($customer_id))
				{
					//check token exist
					$cardTokenId = $request->get('stripeToken');
					$card = $stripe->cards()->create($customer_id, $cardTokenId);

					$cardId = $card['id'];

					$userCard = [
						'stripe_card_id' => $card['id'],
						'last4' => $card['last4'],
					];

					/* 
					//check if already subscription created
					if($oldSubscription && !empty($oldSubscription->subscription_id)){
						$destroySubscription = $this->cancelSubscription($oldSubscription->subscription_id);
					} */

					/*Create New Subscription*/
					$createSubscription = $stripe->subscriptions()->create($customer_id, [
						'plan' => $stripe_plan_id,
					]);

					$createSubscriptionId = $createSubscription['id'];

					

					if(!empty($createSubscriptionId)){
						/*Save data to subscription table*/
						

						$data['success'] = true;
						$data['message'] = 'Your Plan is successfully activated';
					}
				}
			}catch (Exception $e) {
				//Session::put('error',$e->getMessage());
				$response['msg'] = $e->getMessage();
				return $response;
			} catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {

				$response['msg'] = $e->getMessage();
				return $response;
			 } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
				 $response['msg'] = $e->getMessage();
				 return $response;
			 }
			 return Response::json($data, 200);
		}	
	}
	 public function cancelStripeSubscription($subscription){
    	$response['success'] = false;
    	$stripe = Stripe::make(env('STRIPE_SECRET'));
    	if(!empty($subscription)){
    		//get customer id
    		$user = User::where('id',$subscription->user_id)->first();
    		if($user && !empty($user->stripe_customer_id) && !empty($subscription->subscription_id)){
    			$retrivesSbscription = $stripe->subscriptions()->find($user->stripe_customer_id, $subscription->subscription_id);
    			/*Check if subscribtion exist*/
    			if(!empty($retrivesSbscription['id'])){
    				$cancelSubscription = $stripe->subscriptions()->cancel($user->stripe_customer_id, $subscription->subscription_id);
    			}
    			$response['success'] = true;
    		}

    	}
    	return $response;
    }
	
	public function updatePlanCopy(UpdatePlanRequest $request){
		
    	$data = [];
        $data['success'] = false;
        $data['message'] = 'Something went wrong';

    	if($request->ajax()){
    		$request_data = $request->all();
    		$user_id = auth::user()->id; 
    		$user = User::where('id',$user_id)->first();
    		if($user){
    			if(!empty($request_data['payment_method']) && !empty($request_data['plan'])){
		        	$payment_method = $request_data['payment_method'];
		        	$stripe = Stripe::make(env('STRIPE_SECRET'));
		        	$plan = Plan::where('id',$request_data['plan'])->first();
		        	/*If plan exist*/
		        	if($plan){
		        		//check
		        		$oldSubscription = UserProfile::where('user_id',$user_id)->first();
		        		/*Stripe Payment Method*/
			        	if($user && $payment_method == 2){
			        		try{
				        		$customer_id = $user->stripe_customer_id;
				        		if(empty($customer_id)){
				        			$customer = $stripe->customers()->create([
						                'email' => $user->email,
						            ]);

						            if(!empty($customer)){
						            	$customer_id = $customer['id'];
						            }
				        		}

				        		if(!empty($customer_id))
				        		{
					        		//check token exist
				                	$cardTokenId = $request->get('stripeToken');
				                	$card = $stripe->cards()->create($customer_id, $cardTokenId);

				                	$cardId = $card['id'];

					                $userCard = [
					                    'stripe_card_id' => $card['id'],
					                    'last4' => $card['last4'],
					                    'user_id'=>$user_id
					                ];

					                //Save to db
					                $saveCard = UserCard::create($userCard);

					                //check if already subscription created
					                if($oldSubscription && !empty($oldSubscription->subscription_id)){
					                	$destroySubscription = $this->cancelSubscription($oldSubscription->subscription_id);
					                }

					                /*Create New Subscription*/
				                    $createSubscription = $stripe->subscriptions()->create($customer_id, [
									    'plan' => $plan->stripe_plan_id,
									]);

									$createSubscriptionId = $createSubscription['id'];

				                    $users = User::find($user_id);
				                    //save db
				                    $users->stripe_customer_id = $customer_id;
				                    $users->plan_id = $request_data['plan'];
				                    $users->save();

				                    if(!empty($createSubscriptionId)){
					                	/*Save data to subscription table*/
					                	$subscription = [
					                		'user_id'=>$user_id,
					                		'payment_method_id' => $payment_method,
					                		'status' => 1,
					                		'subscription_id' => $createSubscriptionId,
					                		'plan_id' => $request_data['plan'],
					                		'plan_price' => $plan->amount
					                	];

					                	$saveSubscription = Subscription::create($subscription);

					                	if($saveSubscription){
					                		$subscription_id = $saveSubscription->id;

					                		if($oldSubscription && !empty($oldSubscription->id)){
					                			
							                	$saveProfile = UserProfile::find($oldSubscription->id);
							                	$saveProfile->subscription_id = $subscription_id;
							                	$saveProfile->save();
					                		}else{

						                		$userProfile = [
							                		'subscription_id' => $subscription_id,
							                		'user_id'=>$user_id
							                	];

						                		$saveProfile = UserProfile::create($userProfile);
						                	}
					                		$data['success'] = true;
					                		$data['message'] = 'Your Plan is successfully activated';
					                	}
					                }
				                }
				        	}catch (Exception $e) {
				                //Session::put('error',$e->getMessage());
				                $response['msg'] = $e->getMessage();
				                return $response;
				            } catch(\Cartalyst\Stripe\Exception\CardErrorException $e) {

				                $response['msg'] = $e->getMessage();
				                return $response;
				             } catch(\Cartalyst\Stripe\Exception\MissingParameterException $e) {
				                 $response['msg'] = $e->getMessage();
				                 return $response;
				             }
			        	}elseif ($user && $payment_method == 1){
			        		//check if already subscription created
			                if($oldSubscription && !empty($oldSubscription->subscription_id)){
			                	$destroySubscription = $this->cancelSubscription($oldSubscription->subscription_id);
			                }
			                $new_Subscriber  = new Subscription;
							//SET DATA TO SAVE SUBSCRIPTION 
							
							
							$new_Subscriber->subscription_id   	= $request->subscription_id;
							$new_Subscriber->plan_id  			= $request->plan_id;
							$new_Subscriber->user_id  			= $user_id;
							$new_Subscriber->payer_name   		= $request->PayerName;
							$new_Subscriber->payer_mail   		= $request->PayerMail;
							$new_Subscriber->payer_id   		= $request->payer_id;
							$new_Subscriber->plan_price   		= $plan->amount;
							$new_Subscriber->status   			= $request->status;
							
							$strtotime_subscription_start = strtotime($request->CreateTime);
							$subscription_start = date('Y-m-d H:i:s', $strtotime_subscription_start);
							$subscription_end = date('Y-m-d H:i:s', strtotime('1 month',$strtotime_subscription_start));
							
							
							$new_Subscriber->subscription_start   = $subscription_start;
							$new_Subscriber->subscription_end   = $subscription_end;
							$new_Subscriber->save();

							if($new_Subscriber){
		                		$subscription_id = $new_Subscriber->id;

		                		$userProfile = UserProfile::where('user_id',$user_id)->first();
		                		if($userProfile){
		                			$uProfile =array();
									$uProfile['subscription_id']=$subscription_id;
									$userProfile->update($uProfile);

		                		}else{
		                			$userProfile = [
				                		'subscription_id' => $subscription_id,
				                		'user_id'=>$user_id
				                	];

			                		$saveProfile = UserProfile::create($userProfile);
		                		}

		                		
		                	}

		                	$users = User::find($user_id);
		                    //save db
		                    $users->plan_id = $request_data['plan'];
		                    $users->save();

		                    $data['success'] = true;
		                    $data['message'] = 'Your Plan is successfully activated';
			        	}
			        }
    		}
    	}
    	return Response::json($data, 200);
    }

    }
	
}
