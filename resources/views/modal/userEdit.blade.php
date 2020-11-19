<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header py-1">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form action="{{ url('update-profile/') }}/{{ $user->id }}" method="POST" id="updateUser" >
	 @csrf
		
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.owner_name') }}<em>*</em></label>
			<div class="d-flex control-group">
			 <input type="text" name="owner_name" value="{{$user->owner_name}}" class="form-control" placeholder="Business Owner Name">									
			</div>	
			<div class="owner_name_error errors"></div>	
		</div>
		
		
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.business_name') }}<em>*</em></label>
			<div class="d-flex control-group">
			 <input type="text" name="business_name" value="{{$user->business_name}}" class="form-control" placeholder="{{ trans('global.business_name') }}">									
			</div>	
			<div class="business_name_error errors"></div>	
		</div>
		
	
		
	
		
		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.email') }}</label>
		<div class="d-flex control-group">
		<input type="email" name="email" disabled="disabled" value="{{$user->email}}" class="form-control" placeholder="{{ trans('global.email') }}">								
		</div>								
		</div>	
	
		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.address') }}<em>*</em></label>
		<div class="d-flex control-group">
		<input type="address" name="address" value="{{$user->address}}" class="form-control" placeholder="{{ trans('global.address') }}">								
		</div>	
			<div class="address_error errors"></div>			
		</div>	
	

		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.phone_number') }}<em>*</em></label>
		<div class="d-flex control-group">
		<input type="text" name="mobile_number" value="{{$user->mobile_number}}" class="form-control" placeholder="{{$user->mobile_number}}">							
		</div>
		 <div class="mobile_number_error errors"></div>	
		</div>	
		
		<!--div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.tax_number') }}</label>
		<div class="d-flex control-group">
		<input type="text" name="tax_number" value="{{$user->tax_number}}" class="form-control" placeholder="Tax Number">							
		</div>
		 <div class="mobile_number_error errors"></div>	
		</div-->	
		
		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.business_url') }}</label>
		<div class="d-flex control-group">
		<input type="text" name="business_url" value="{{$user->business_url}}" class="form-control" placeholder="{{ trans('global.business_url') }}">							
		</div>
		 <div class="business_url_error errors"></div>	
		</div>	
		
		
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.qr_code_label') }}</label>
			<div class="d-flex control-group">
			{!! QrCode::size(150)->generate($user->qr_code); !!}
			</div>				
			<a target = "_blank" href="{{ url('user/print')}}/{{$user->id}}">Print Your Code</a><br>
			<a target = "_blank" href="{{ url('customer-info')}}/{{$user->id}}">Open Url in Browser</a>			
		</div>	
		
		
		
								
		<div class="form-row mt-4">
		<div class="col-md-12 offset-lg-3 offset-xl-2">
		<input id ="user_id" class="form-check-input" type="hidden" value="{{$user->id}}">
		<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
		<div class="spinner-border text-primary request_loader" style="display:none"></div>
		</div>
		</div>
		</form>

				</div>
			</div>
		</div>