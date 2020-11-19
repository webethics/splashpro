@php 
$plan_price= getPlanDetails(user_data()->id);
@endphp 
@php 
$price_or_free ='FREE'
@endphp
@if(count($plan_price)>0)
  @php 
  $price_or_free =  $plan_price[0]->price_without_fee
  @endphp 	

@endif
<form>
<div class="col-md-9 col-sm-12 col-md-offset-3 ">
	  <div class="add-code">
			<div class="pb-ns ">
			
			<div class="form-group">
                <label for="country">Set Price :</label>
                <select name="select_subscription_fee" id="select_subscription_fee" class="form-control" style="width:300px">
                    <option value="">--- Set Price ---</option>
                    <option value="FREE"
					@if ($price_or_free=='FREE')
						selected="selected"
					@endif>FREE</option>
                    @foreach (getListPrice() as $key => $value)
                    <option value="{{ $value->price }}"
					@if ($value->price == $price_or_free)
						selected="selected"
					@endif
					>${{ $value->price }}</option>
                    @endforeach
                </select>
				<div class="error_margin"><span class="subscription_fee_error error" ></span></div>
            </div>
			<input name="price_without_fee" id="price_without_fee" class="input inputcls price_without_fee" type="hidden" value="">
			<input name="subscription_fee" id="subscription_fee" class="input inputcls subscription_fee" type="hidden" value="">
			<input name="fee_checked" id="fee_checked" class="input inputcls fee_checked" type="hidden" value="">
			   <!-- <label>Subscription  Fee</label> -->
			   <!--input name="subscription_fee" placeholder="Set Subscription Price" required="required" class="input inputcls" type="text" value="@if(count($plan_price)>0){{$plan_price[0]->price}} @endif"-->
			 			   
			  
			</div>
			<div class="pb-ns checkbox_fee">  
			   <input type="checkbox" name="fee_deduction" value="1" class="fee_deduction_checkbox"
			   @if(count($plan_price)>0)
			   @if ($plan_price[0]->fee_deduction==1)
						checked="checked"
				@endif
				@endif
			   > <span class="pricetxt">Fan Pay Credit card fees for the transaction (4.9%+30cents) </span>
			</div>
			<div class="pb-ns selected_price">  
			 <strong>Final Subscription Price : $<span class="final_subscription_price"></span></strong>
			</div>
			
			<div class="col-md-12 col-sm-12 set_price_button">
					<div class="save-btn"><a href="javascript:void(0)" class="subscription_update"><i class="fa fa-spinner fa-spin loader_subscription_price" style="display:none"></i> Set</a></div>
			</div>
			<div class="col-md-12 col-sm-12 set_free_button">
					<div class="save-btn"><a href="javascript:void(0)" class="subscription_update_as_free"><i class="fa fa-spinner fa-spin loader_subscription_update_as_free" style="display:none"></i> Set</a></div>
			</div>
	  </div>
   </div>
</form>