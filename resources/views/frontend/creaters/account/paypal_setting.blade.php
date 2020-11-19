 <form>
 @csrf
 <div class="crdsl-fields row">
	   <div class="col-md-5 col-sm-12">
		  <div class="add-code">
				<div class="pb-ns ">
				   <label>PayPal Email Address*</label>
				   <input name="paypal_id" id="paypal_id" placeholder="PayPal Email Address"  class="input inputcls" type="text" value="{{user_data()->paypal_id}}">
				   <div class="error_margin"><span class="paypal_id_error error" ></span></div>
				</div>
		  </div>
	   </div>
	  
	  
		<div class="col-md-12 col-sm-12">
	   <div class="save-btn"><a href="javascript:void(0)" class="update_paypal"><i class="fa fa-spinner fa-spin paypal_loader" style="display:none"></i> Update </a></div>
	   </div>
	</div>	
 </form>	