<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header py-1">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			
			<h2>Certificate Details</h2>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">First Name</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->first_name}}</label>
			</div>
			
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Last Name</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->last_name}}</label>
			</div>

			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Mobile</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->mobile_number}}</label>
			</div>

			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Aadhaar</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->aadhar_number}}</label>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Address</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->address}}</label>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Covered Amount</label>
				<label class="col-lg-9 col-xl-8 col-form-label">INR {{$user->plan->insurance_cover}}</label>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Locking Period</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{$user->plan->locking_period}} Months</label>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Insurance Cost</label>
				<label class="col-lg-9 col-xl-8 col-form-label">INR {{$user->plan->cost}}</label>
			</div>
			<div class="form-group row">
				<label class="col-lg-3 col-xl-4 col-form-label">Created On</label>
				<label class="col-lg-9 col-xl-8 col-form-label">{{date('d-m-Y h:i',strtotime($user->created_at))}}</label>
			</div>

		
			<a class="btn btn-primary default"  href="{{url('download-certificate')}}/{{ $user->id }}"  data-user_id="{{ $user->id }}" title="Download Certificate">Donwload Certificate</i> </a>
		</div>
	</div>
</div>