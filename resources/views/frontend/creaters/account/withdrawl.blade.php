@php 
$totalWalletAmount= UserAmountWallet();
@endphp 

@php 
$PendingWithdrawAmount= getPendingWithdrawAmount();
@endphp 
<div class="row" style="margin-bottom:20px;font-size:13px;">
		@if(count($totalWalletAmount)>0)
         <strong>			
		   <div class="col-md-4 col-sm-12 walltet_amount"> Wallet Amount : {{config('constant.SET_CURRENCY_SIGN')}}<span id="walltet_amount">{{$totalWalletAmount[0]->wallet_amount}}</span> </div>
  		  <div class="col-md-4 col-sm-12 requested_withdraw_amount"> Requested Amount : <span id="requested_withdraw_amount">{{config('constant.SET_CURRENCY_SIGN')}}{{$PendingWithdrawAmount}} </span> </div>
		  <div class="col-md-4 col-sm-12 remaining_balance">  Remaining Amount : {{config('constant.SET_CURRENCY_SIGN')}}<span id="remaining_balance">{{$totalWalletAmount[0]->wallet_amount- $PendingWithdrawAmount}}</span></div></strong>
		@endif			 

</div>
<form>
<div class="col-md-7 col-sm-12 col-md-offset-3 ">

     
	  <div class="add-code">
	    
			<div class="pb-ns ">
			   <!-- <label>Subscription  Fee</label> -->
			   <input name="withdraw_amount" placeholder="Enter Amount to Withdraw" required="required" class="input inputcls" type="text" value="">
			  
			   <div class="error_margin"><span class="withdraw_amount_error error" ></span></div>
			  
			</div>
			<!--div class="pb-ns ">  
			   <input type="checkbox" name="fee_deduction" disabled ="disabled"  value="1" checked> <span class="pricetxt">Credit card fees for the transaction ({{config('constant.SITE_FEE')}}{{config('constant.FEE_SIGN')}} {{config('constant.FEE_TEXT')}}) </span>
			</div-->
			
			<div class="col-md-12 col-sm-12">
					<div class="save-btn"><a href="javascript:void(0)" class="withdraw_request "><i class="fa fa-spinner fa-spin loader_withdraw_request" style="display:none"></i> Withdraw</a></div>
			</div>
			
			  <div class="note" style="color:red"> <b>Note </b>: To withdraw amount your wallet amount should be greater then {{config('constant.SET_CURRENCY_SIGN')}}{{config('constant.SET_WITHDRAW_AMOUNT')}}. </div>
	  </div>
   </div>
</form>







						