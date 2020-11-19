@extends('admin.layouts.admin')
@section('content')
@section('profilepageJsCss')
<script src="{{ asset('js/module/jquery.account.js')}}"></script>
@stop
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h1>Global Settings </h1>
			<div class="separator mb-5"></div>
		</div>
	</div>

	<div class="row global_settings">
		<div class="col-lg-6 mb-4">							
		  <div class="card h-100">
				<div class="card-body">
					<h5 class="mb-4">SMTP Settings</h5>
					<form name="smtp_settings" id="smtp_settings"  data-id="{{$user_id}}">
						<div class="form-group">
							<label class="col-form-label">Host</label>
							<div class="d-flex control-group">
								<input type="text" name="smtp_host" id="smtp_host" value="{{$settings->smtp_host}}" class="form-control">
							</div>
							<div class="smtp_host_error errors"></div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Port</label>
							<div class="d-flex control-group">
								<input type="text" name="smtp_port" id="smtp_port" value="{{$settings->smtp_port}}" class="form-control">
							</div>
							<div class="smtp_port_error errors"></div>
						</div>								
						
						<div class="form-group">
							<label class="col-form-label">User</label>
							<div class="d-flex control-group">
								<input type="text" name="smtp_user" id="smtp_user"  value="{{$settings->smtp_user}}"class="form-control">
							</div>
							<div class="smtp_user_error errors"></div>	
						</div>		

						<div class="form-group">
							<label class="col-form-label">Password</label>
							<div class="d-flex control-group">
								<input type="password" name="smtp_password" id="smtp_password"  value="{{$settings->smtp_password}}"class="form-control">
							</div>
							<div class="smtp_password_error errors"></div>	
						</div>		

						<h5 class="mt-3 mb-3">Email Settings</h5> 
						<div class="form-row">
							<div class="form-group col-md-6">
								<label class="col-form-label">Email</label>
								<div class="d-flex control-group">
									<input type="text" name="from_email" id="from_email"  value="{{$settings->from_email}}"  class="form-control">
								</div>
								<div class="from_email_error errors"></div>
							</div>	
							<div class="form-group col-md-6 mb-0">
								<label class="col-form-label">From Name</label>
								<div class="d-flex control-group">
									<input type="text" name="from_name" id="from_name"  value="{{$settings->from_name}}" class="form-control">
								</div>
								<div class="from_name_error errors"></div>
							</div>									
						</div>	
												
					<div class="form-row mt-4">
						<div class="col-md-12">
							<button type="button" id="updateEmailSettings" class="btn btn-primary default btn-lg col-12 col-sm-auto">Submit</button>
						</div>
						
					</div>
					</form>
				</div>
					
			</div>				

		</div>
		
		<div class="col-lg-6 mb-4">							
			<div class="card h-100">
				<div class="card-body">
					<h5 class="mb-4">Site Settings</h5> 
					<form name="site_settings" id="site_settings" data-id="{{$user_id}}" enctype="multipart/form-data">					
						<div class="form-group">
							<label class="col-form-label">Site Title</label>
							<div class="d-flex control-group">
								<input type="text"  name="site_title" id="site_title" value="{{$settings->site_title}}" class="form-control">
							</div>
							<div class="site_title_error errors"></div>
						</div>
							
						<div class="form-group">
							<label class="col-form-label">Upload Logo</label>
						
							<div id="drop_here" class="dropzone"></div>
							<div class="dropzoneError errors"></div>
						</div>
						@php  $auth_checked=''	 @endphp
						 @if($settings->double_authentication == 1)
						@php $auth_checked = 'checked=checked'@endphp
						 @endif
						<div class="config-notification">
							<h5 class="mb-3">Notification</h5> 
							<div class="form-group mb-0">
								<label class="col-form-label">Two Factor Authentication</label>
								<div class="custom-switch  custom-switch-primary custom-switch-small">
									<input class="custom-switch-input" name="two_factor_authentication" id="switch" value="{{$settings->double_authentication}}"  type="checkbox" {{$auth_checked}}>
									<label class="custom-switch-btn" for="switch"></label>
								</div>
							</div>									
						</div>	
								
						<!--h5 class="mt-3 mb-3">Message API</h5> 
						<div class="form-row">
							<div class="form-group col-md-6">
								<div class="d-flex control-group">
									<input type="text" name="api_name" id="api_name" class="form-control" value="{{$settings->message_api_name}}"  placeholder="API Name">
								</div>
								<div class="api_name_error errors"></div>
							</div>	
							<div class="form-group col-md-6 mb-0">
								<div class="d-flex control-group">
									<input type="text" name="api_key" id="api_key" class="form-control" value="{{$settings->message_api_key}}"  placeholder="API Key">
								</div>
								<div class="api_key_error errors"></div>
							</div>									
						</div-->	
													
						<div class="form-row mt-4 customAdjust">
							<div class="col-md-12">
								<button type="button" id="updateSiteSettings" class="btn btn-primary default btn-lg  col-12 col-sm-auto">Submit</button>
							</div>
						</div>
					</form>
				</div>
					
			</div>				

		</div>				
		
	</div>
</div>
		
@endsection