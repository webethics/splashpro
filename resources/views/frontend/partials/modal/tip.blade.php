
<!-- USER SET PRICE FOR PROFILE  -->
 <div class="modal-dialog modal-lg subs-modal">
    <div class="modal-content">
			<div class="modal-body">
			      <div class="modal-header md-header">
					
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
              <div class="mod-content1"><input type="text" name="tip" id="tip" class="tip" placeholder="Enter tip amount in USD"/> </div>	
			  <div class="mod-content">
			     
				
				<!--a href="#" > Subscribe Now </a-->
				<div id="paypal-button-container" style="width: 400px;max-width:100%;height:auto;"></div>
				
				<div class="loading-image1" style="display:none;"><img src="{{url('/frontend/images')}}/loader.gif" /></div>
			  </div>	
		  </div>
    </div>
  </div>


<!--   IF USER IS SET PRICE THEN SUBSCRIBE THE PLAN  -->

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
var tip_amount='' ;
$(document).ready(function(){	
	$('.tip').keyup(function(){	
		tip_amount = $(this).val();
	})
	
})

var apiKey = '{{$client_id}}';
var password = '{{$secret}}';
var api_url = '{{$api_url}}';
var post_id = '{{$post_data->id}}';
var user_id = '{{$post_data->user_id}}';
var csrf_token = $('meta[name="csrf-token"]').attr('content');
//PAYPAL BUTTON FOR PAYMENT
 paypal.Buttons({
    createOrder: function(data, actions) {
      // This function sets up the details of the transaction, including the amount and line item details.
      return actions.order.create({
        purchase_units: [{
          amount: {
            value: tip_amount
          }
        }]
      });
    },
    onApprove: function(data, actions) {
			//alert(JSON.stringify(data));
			//alert(JSON.stringify(data));
			var orderID = data.orderID;
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
					 //alert(JSON.stringify(result));
					$(".loading-image1").show();
					$.ajax(api_url+"/v2/checkout/orders/"+data.orderID+"/capture", {
								method: "POST",
								headers: {
								  "Content-Type": "application/json",
								  "Authorization": "Bearer "+result.access_token
								},
								dataType: "json",
								success: function (data) {
									//alert(JSON.stringify(data));
										var order_id = data.id;
										var PayerName = data.payer.name.given_name+' '+data.payer.name.surname;
										var PayerMail = data.payer.email_address;
										var payer_id = data.payer.payer_id;
										var CreateTime = "";
										var UpdateTime = "";
										var tip_amount = "";
										$(data.purchase_units).each(function (index, item) {
												tip_amount = item.payments.captures[0].amount.value;  //done
												CreateTime =  item.payments.captures[0].create_time;
												UpdateTime =  item.payments.captures[0].update_time;
													
											});
									
										var status = data.status;
										  $.ajax({
												url: base_url+'/saveTipPayments',
												dataType: 'json',
												type: 'post',
												contentType: 'application/x-www-form-urlencoded',
												data: {_token:csrf_token,order_id:order_id,user_id:user_id,post_id:post_id,PayerName:PayerName,PayerMail:PayerMail,payer_id:payer_id,tip_amount:tip_amount,CreateTime:CreateTime,UpdateTime:UpdateTime,status:status},
												success: function(data){
													$(".loading-image1").hide();
													if(data){
														notification('Success','Tip paid Successfully.','top-right','success',2000);
														setTimeout(function(){ $('.tipModal_'+post_id).modal('hide'); }, 1000);
													}
												}
											});
								},
								error: (xhr, textStatus, errorThrown) => {
									console.log(textStatus, errorThrown);
									notification('Error','There is some issue processing your request.You can try later.','top-right','error',3000);
									
								}
							});
				},
				error: (xhr, textStatus, errorThrown) => {
					console.log(textStatus, errorThrown);
					notification('Error','There is some issue processing your request.You can try later.','top-right','error',3000);
					
				}
			});
    },
	  onError: function (err) {
			notification('Error','There is some issue processing your request.You can try later.','top-right','error',3000);

  },
  onCancel: function (data) {
    setTimeout(function(){ $('.tipModal_'+post_id).modal('hide'); }, 1000);
  }
  }).render('#paypal-button-container'); 
</script>