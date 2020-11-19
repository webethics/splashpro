@extends('layouts.admin')
@section('content')
@section('profilepageJsCss')
<script src="{{ asset('js/module/jquery.customer.js')}}"></script>

<script>
$(document).ready(function(){
	$('#background_color').colorpicker({
		horizontal: true,
		inline:false,
		align:'right',
		container:'.demo',
		customClass:'positions'
	});
      $('#font_color').colorpicker({
		horizontal: false,
		inline:false,
		align:'right',
		horizontal: true,
		container:'.demo1',
		
	});
      
});

</script>
@stop
<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h1>Site Settings </h1>
			<div class="separator mb-5"></div>
		</div>
	</div>

	<div class="row global_settings">
		
		
		<div class="col-lg-12 mb-4">							
			<div class="card h-100">
				<div class="card-body">
					<h5 class="mb-4">Site Settings</h5> 
					<div id="msg" class="alert hide"></div>
					<form name="site_customer_settings" id="site_customer_settings" data-id="{{$user_id}}" enctype="multipart/form-data">					
						<!--div class="form-group">
							<label class="col-form-label">Site Title</label>
							<div class="d-flex control-group">
								<input type="text"  name="site_title" id="site_title" value="{{$site_settings && $site_settings->site_title?$site_settings->site_title:'Safe Trace'}}" class="form-control">
							</div>
							<div class="site_title_error errors"></div>
						</div--->
						
						<div class="form-group ">
							<label class="col-form-label">Background Color</label>
							<div class="d-flex control-group demo colorpicker-parent">
								<input type="text" class="form-control" name="background_color" id="background_color" value="{{$site_settings && $site_settings->background_color?$site_settings->background_color:'#af172e'}}">
							</div>
							<p>(click on box to choose color)</p>
							<div class="background_color_error errors"></div>
						</div>
						<div class="form-group">
							<label class="col-form-label">Font Color</label>
							<div class="d-flex control-group demo1 colorpicker-parent">
								<input type="text" class="form-control" name="font_color" id="font_color" value="{{$site_settings && $site_settings->font_color?$site_settings->font_color:'#FFFFFF'}}">
							</div>
							<p>(click on box to choose color)</p>
							<div class="font_color_error errors"></div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Welcome Text</label>
							<div class="d-flex control-group">
								<textarea name="welcome_text" id="welcome_text" class="form-control">{{$site_settings && $site_settings->welcome_text?$site_settings->welcome_text:'Thank you for coming to our restaurant during these trying times. Due to COVID-19 we are required to take your information for public safety measures. We appreciate your understanding and cooperation and hope your family and friends are safe and healthy.'}}</textarea>
							</div>
							<div class="welcome_text_error errors"></div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Upload Header Image (2000x320)</label>
						
							<div id="drop_here_header" data-type="header" class="dropzone drop_here_logo"></div>
							<div class="dropzoneError errors"></div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Upload Footer Image (2000x320)</label>
						
							<div id="drop_here_footer" data-type="footer" class="dropzone drop_here_logo"></div>
							<div class="dropzoneError errors"></div>
						</div>
						
						<div class="form-group">
							<label class="col-form-label">Loyalty Program Text</label>
							<div class="d-flex control-group">
								<textarea name="verbiage_text" id="verbiage_text" class="form-control">{{$site_settings && $site_settings->verbiage_text?$site_settings->verbiage_text:''}}</textarea>
							</div>
							<div class="welcome_text_error errors"></div>
						</div>
						
						
						<div class="clearfix"></div>
						<div class="form-group mt-5  ">								
							<div class="form-row customAdjust">
								<div class="col-md-12">
									<button type="button" id="updateCustomerSiteSettings" class="btn btn-primary default btn-lg  col-12 col-sm-auto">Submit</button>
								</div>
							</div>
						</div>
					</form>
				</div>
					
			</div>				

		</div>				
		
	</div>
</div>
		
@endsection