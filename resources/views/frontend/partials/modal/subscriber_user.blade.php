
<!---------------  SUBSCRIBER POPUP ---------------> 
@php
	$profile_photo =  profile_photo($user_data->id);
@endphp
    <!-- PLAN DETAIL BY USER ID --> 
	@php
	  $plan_details = getPlanDetails($user_data->id);
   @endphp	
<!-- USER SET PRICE FOR PROFILE  -->
@if(count($plan_details)>0)
 <div class="modal-dialog modal-lg subs-modal">
    <div class="modal-content">
			<div class="modal-body">
			      <div class="modal-header md-header">
					@if($user_data->profile_photo==NULL)
					   <div class="header-cont">
						 <div class="subscribe_you_thumb">
							<a href="javascript:void(0)"><span> {{ substr($user_data->username,0,1) }} </span></a>
						  </div>
						  </div>
						  @else

						 <div class="header-cont">
							<img class="uspop-img" src="{{timthumb($profile_photo,100,100)}}" alt="image">
						</div>

					@endif
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
 
			  <div class="mod-content">
			    <h2> {{ucwords($user_data->username)}} {{--ucwords($user_data->last_name)--}}</h2>
			    <span class="price"> <strong>Price : {{config('constant.SET_CURRENCY_SIGN')}}{{price_number_format($plan_details[0]->price) }}</strong></span>
				<h5> Subscription Benefits:  </h5>
				<ul>
				 <li> Full access to this user's content  </li>
				 <li> Direct message with this user </li>
				 <li> Cancel your subscription at any time  </li> 
				</ul>
				
		
				<div id="paypal-button-container_{{$user_data->id}}" style="width: 400px;max-width:100%;height:auto;"></div>
				<div class="loading_subscriber" style="display:none;"><img src="{{url('/frontend/images')}}/loader.gif" /></div>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			  </div>	

          
	
		  </div>
    </div>
  </div>
  @else
   <!--    FOLLOW FREE USER MODAL -->
   <!--div class="modal-dialog modal-lg subs-modal">
    <div class="modal-content">
			<div class="modal-body">
			      <div class="modal-header md-header">
						@if($user_data->profile_photo==NULL)
					   <div class="header-cont">
						 <div class="subscribe_you_thumb">
							<a href="javascript:void(0)"><span> {{ substr($user_data->first_name,0,1) }} </span></a>
						  </div>
						  </div>
						  @else
						 <div class="header-cont">
							<img class="uspop-img" src="{{timthumb($profile_photo,100,100)}}" alt="image">
						</div>

					@endif

				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
 
			  <div class="mod-content">
			   <h2> {{ucwords($user_data->first_name)}} {{ucwords($user_data->last_name)}}</h2>
				<h5> Subscription Benefits:  </h5>
				<ul>
				 <li> Full access to this user's content  </li>
				 <li> Direct message with this user </li>
				 <li> Cancel your subscription at any time  </li> 
				</ul>
				
				<a href="javascript:void(0)" class="follow_user" data-user_id="{{$user_data->id}}" > Follow Now</a>
				<input type="hidden" name="_token" value="{{ csrf_token() }}">
			  </div>			  
		  </div>
     </div>
   </div-->
@endif


<!--   IF USER IS SET PRICE THEN SUBSCRIBE THE PLAN  -->
@if(count($plan_details)>0)
@php 
$planID = $plan_details[0]->plan_id;
@endphp 
<?php 
	if(config('paypal.settings.mode') == 'live'){
		$client_id = config('paypal.live_client_id');
		$secret = config('paypal.live_secret');
		$api_url = config('paypal.live_api_url');
		$paypalproductId = config('paypal.live_productId');
	} else {
		$client_id = config('paypal.sandbox_client_id');
		$secret = config('paypal.sandbox_secret');
		$api_url = config('paypal.sandbax_api_url');
		$paypalproductId = config('paypal.sandbox_productId');
	}
?>
<script>

var planId = '{{$planID}}';
var apiKey = '{{$client_id}}';
var password = '{{$secret}}';
var api_url = '{{$api_url}}';
var user_id = '{{$plan_details[0]->user_id}}';
var plan_price = '{{$plan_details[0]->price}}';
var csrf_token = $('input[name="_token"]').val();
button_id = '{{$user_data->id}}';
//PAYPAL BUTTON FOR PAYMENT
paypal.Buttons({
	  createSubscription: function(data, actions) {
		return actions.subscription.create({
		  'plan_id': planId
		});
	  },
	  onApprove: function(data, actions) {
			//alert(JSON.stringify(data));
			
			//GET TOKEN 
			  $.ajax({
				type: "POST",
				url: api_url+"/v1/oauth2/token",
				dataType: "json",
				data: {grant_type: "client_credentials"},
				beforeSend: function(xhr) { 
					xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); 
					xhr.setRequestHeader("Authorization", "Basic " + btoa([apiKey, password].join(":"))); 
				},
				 success: function (result) {
					// alert(JSON.stringify(result));
					$(".loading_subscriber").show();
					//GET TOKEN 
					$.ajax(api_url+"/v1/billing/subscriptions/"+data.subscriptionID, {
								method: "GET",
								headers: {
								  "Content-Type": "application/json",
								  "Authorization": "Bearer "+result.access_token
								},
								dataType: "json",
								success: function (data) {
									//alert(JSON.stringify(data));
									var subscription_id = data.id;
									var plan_id = data.plan_id;
									//var quantity = data.quantity;
									var PayerName = data.subscriber.name.given_name+' '+data.subscriber.name.surname;
									var PayerMail = data.subscriber.email_address;
									var payer_id = data.subscriber.payer_id;
									//var Total = data.shipping_amount.value;
									var CreateTime = data.start_time;
									var UpdateTime = data.status_update_time;
									var next_billing_time = data.billing_info.next_billing_time;
									var status = data.status;
										  $.ajax({
												url: base_url +'/SaveSubscribedUserData',
												dataType: 'json',
												type: 'post',
												contentType: 'application/x-www-form-urlencoded',
												data: {_token:csrf_token,subscription_id:subscription_id,plan_id:plan_id,user_id:user_id,PayerName:PayerName,PayerMail:PayerMail,payer_id:payer_id,plan_price:plan_price,CreateTime:CreateTime,UpdateTime:UpdateTime,status:status,next_billing_time:next_billing_time},
												success: function(data){
													if(data.success){
														$(".loading_subscriber").hide();
														$('.user_subscribe_'+user_id).hide();  //Hide followed user from list 
														notification('Success','You have subscribed Successfully.','top-right','success',2000);
														setTimeout(function(){ $('.subscribeModal_'+user_id).modal('hide'); }, 1000);
													}else{
														
													}	
												}
											});
								},
								error: (xhr, textStatus, errorThrown) => {
									console.log(textStatus, errorThrown);
									$('.error-message-box').show();
									notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
									
								}
					});
				},
				error: (xhr, textStatus, errorThrown) => {
					notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
					
				}
			});  
	  },
	  onError: function (err) {
			notification('Error',' There is some issue processing your request.You can try later.','top-right','error',3000);
  },
  onCancel: function (data) {
    setTimeout(function(){ $('.subscribeModal_'+user_id).modal('hide'); }, 1000);
  }
}).render('#paypal-button-container_'+button_id); 
</script>

@endif