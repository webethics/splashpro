@extends('admin.layouts.admin')
@section('content')
@section('profilepageJsCss')


<script src="{{ asset('js/module/jquery.account.js')}}"></script>
<script src="{{ asset('js/module/account_form.js')}}"></script>
<script src="{{ asset('js/module/jquery.customer_1.js')}}"></script>
@stop

<div class="row">
	<div class="col-12">
		<h1>{{trans('global.account_fields')}}</h1>
		<div class="separator mb-5"></div>
	</div>
</div>
<div class="row">
	<div class="col-12 mb-4">			
		<div class="card mb-4">
			<div class="row">
				<div class="col-md-3">
					<div class="card-header tabs-header">
						<ul class="nav nav-tabs vertical-tabs flex-column card-header-tabs " role="tablist">
							<li class="nav-item">
								<a class="nav-link active" id="first-tab" data-toggle="tab" href="#first" role="tab"
									aria-controls="first" aria-selected="true">{{trans('global.basic')}}</a>
							</li>
							
							@if(check_role_access('account_reset_password'))
								<li class="nav-item">
									<a class="nav-link" id="fifth-tab" data-toggle="tab" href="#fifth" role="tab"
										aria-controls="fifth" aria-selected="false">{{trans('global.reset_password')}}</a>
								</li>
							@endif
						</ul>
					</div>				  
				</div>	
				<div class="col-md-9">						
					<div class="card-body">
						<div class="tab-content">
							<div id="msg" class="alert hide"></div>
							<div class="tab-pane fade show active" id="first" role="tabpanel"  aria-labelledby="first-tab">
								@include('admin.account.basic_info')
							</div>	

							<div class="tab-pane fade" id="fifth" role="tabpanel" aria-labelledby="fifth-tab">
								<form name="reset_pass" id="reset_pass" data-id="{{$user->id}}">
									<div class="form-group row">
										<label class="col-lg-3 col-xl-2 col-form-label">{{trans('global.old_password')}}</label>
										<div class="col-lg-9 col-xl-10">
										<div class="d-flex control-group">
											<input type="password" name="old_password" id="old_password" class="form-control">
										</div>
										<div class="old_password_error errors"></div>
										</div>
										
									</div>
									
									<div class="form-group row">
										<label class="col-lg-3 col-xl-2 col-form-label">{{trans('global.new_password')}}</label>
										<div class="col-lg-9 col-xl-10">
										<div class="d-flex control-group">
											<input type="password" name="password" id="password" class="form-control">
										</div>
										<div class="password_error errors"></div>
										</div>
										
									</div>								
									
									<div class="form-group row">
										<label class="col-lg-3 col-xl-2 col-form-label">{{trans('global.confirm_password')}}</label>
										<div class="col-lg-9 col-xl-10">
										<div class="d-flex control-group">
											<input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
										</div>
										<div class="password_confirmation_error errors"></div>
										</div>
										
									</div>
									
									
									<div class="form-row mt-4">
										<label class="col-lg-3 col-xl-2 col-form-label"></label>
										<div class="col-lg-9 col-xl-10">
											<button type="button" id="reset" class="btn btn-primary default btn-lg mb-1 mr-2">{{trans('global.submit')}}</button>
										</div>
									</div>
								</form>
							</div>
							
							
							
							
							
						</div>			
					</div>			
				</div>			
			</div>			
		</div>				

	</div>
</div>
@section('cancelsubscriptionJsAccountBlade')


<script>

jQuery('#basic_info').click(function(){
	jQuery('#first_account_info').hide('slow');
	jQuery('#accountinfo').show('slow');
});

jQuery('#basic_info_cancel').click(function(){
	jQuery('#first_account_info').show('slow');
	jQuery('#accountinfo').hide('slow');
});

jQuery('.nav-link').click(function(){
	jQuery('#first_account_info').show('slow');
	jQuery('#site_customer_settings_info').show('slow');
	jQuery('#site_customer_settings').hide('');		
	jQuery('#accountinfo').hide('');	
});
	
	
	
	
$(document).ready(function(){
	
	 $('#update-basic-request').prop('disabled', true);
	 
     $('form#accountinfo input[type="text"]').keyup(function() {
        if($(this).val() != '' && $('#submit_button').val() == 0) {
           $('#update-basic-request').prop('disabled', false);
        }
     });
	 
	$('form#accountinfo select').change(function() {
        if($(this).val() != '' && $('#submit_button').val() == 0) {
           $('#update-basic-request').prop('disabled', false);
        }
     });
	 
	 
	$(".box").hide();
	var  state = $('#state').val();
	if(state != ''){
		getCityDropDown(state);
	}
	
});

</script>
@stop			

@endsection
	