<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header py-1">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form action="" method="POST" id="createNewCustomer" >
	 @csrf
		
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.first_name') }}<em>*</em></label>
			<div class="d-flex control-group">
				<input type="text" name="first_name" value="" class="form-control" placeholder="First Name">									
			</div>	
			<div class="first_name_error errors"></div>	
		</div>
		
		
	
		<div class="form-group form-row-parent">
			<label class="col-form-label">{{ trans('global.last_name') }}<em>*</em></label>
			<div class="d-flex control-group">
				<input type="text" name="last_name" value="" class="form-control" placeholder="Last Name">									
			</div>	
			<div class="last_name_error errors"></div>	
		</div>
		
		
		
		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.email') }}</label>
		<div class="d-flex control-group">
		<input type="email" name="email" value="" class="form-control" placeholder="{{ trans('global.email') }}">								
		</div>		
		<div class="email_error errors"></div>		
		</div>	
		
		<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.password') }}<em>*</em></label>
		<div class="d-flex control-group">
		<input type="password" name="password" value="" class="form-control" placeholder="{{ trans('global.password') }}">							
		</div>
		 <div class="password_error errors"></div>	
		</div>	
		
		
		<!--<div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.address') }}<em>*</em></label>
		<div class="d-flex control-group">
		<input type="address" name="address" value="" class="form-control" placeholder="{{ trans('global.address') }}">								
		</div>	
			<div class="address_error errors"></div>			
		</div>	 -->
	

		<!-- <div class="form-group form-row-parent">
		<label class="col-form-label">{{ trans('global.phone_number') }}<em>*</em></label>
		<div class="d-flex control-group">
		<input type="text" name="mobile_number" value="" class="form-control" placeholder="{{ trans('global.phone_number') }}">							
		</div>
		 <div class="mobile_number_error errors"></div>	
		</div>	 -->
		
		<div class="form-group form-row-parent">
		<label class="col-form-label">Role<em>*</em></label>
		<div class="d-flex control-group">
			<select  id="role_id"  class="form-control select2-single"  name="role_id"  data-width="100%">
							
				<option value=" ">Select Role</option>
				@foreach($roles as $key=>$role)
				
				<option value="{{$role->id}}">{{$role->title}}</option>
				
				@endforeach
			</select>
		</div>
		 <div class="role_id_error errors"></div>	
		</div>	
							
		<div class="form-row mt-4">
		<div class="col-md-12">
		<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
		<div class="spinner-border text-primary request_loader" style="display:none"></div>
		</div>
		</div>
		</form>

				</div>
			</div>
		</div>