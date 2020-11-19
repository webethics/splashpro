<div class="modal-dialog" role="document">
	<div class="modal-content">
	<div class="modal-header py-1">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
		</button>
	</div>
	<div class="modal-body">
	<form action="{{ url('request-update-profile') }}/{{$tempRequestUser->id}}" method="POST" id="updateRequestUser" >
	 @csrf
	 
		<h6 class="heading-background">Current Details</h6>
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">First Name</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->first_name}}</label>
		</div>
		
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Last Name</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->last_name}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Email</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->email}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Mobile</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->mobile_number}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Aadhaar</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->aadhar_number}}</label>
		</div>
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Address</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->user->address}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">State</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$currentStateName->state_name ?? ''}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">District</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$currentDistrictName->city_name ?? ''}}</label>
		</div>
									
		<h6 class="heading-background">Requested Details</h6>
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">First Name</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->first_name}}</label>
		</div>
		
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Last Name</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->last_name}}</label>
		</div>
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Email</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->email}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Mobile</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->mobile_number}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Aadhaar</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->aadhar_number}}</label>
		</div>
		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">Address</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$tempRequestUser->address}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">State</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$requestStateName->state_name ?? ''}}</label>
		</div>

		<div class="form-group row">
			<label class="col-lg-3 col-xl-4 col-form-label">District</label>
			<label class="col-lg-9 col-xl-8 col-form-label">{{$requestDistrictName->city_name ?? ''}}</label>
		</div>

		<div class="form-group form-row-parent reason-area d-none">
			<label class="col-form-label">{{ trans('global.reason') }}</label>
			<div class="d-flex control-group">
				<textarea rows="3" cols="50" class="form-control reason_description" name="description" placeholder="Reason for disapprove">{{$tempRequestUser->description}}</textarea>							
			</div>
			<div class="description_error errors"></div>									
		</div>						
								
		<div class="form-row mt-4">
		<div class="col-md-12">
		<input id ="user_id" class="form-check-input" type="hidden" value="{{$tempRequestUser->id}}">
		<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto request_approve">Approve</button>
		<button type="submit" class="btn btn-danger default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto request_disapprove">Disapprove</button>
		<div class="spinner-border text-primary request_loader" style="display:none"></div>
		</div>
 		</div>
		</form>

				</div>
			</div>
		</div>