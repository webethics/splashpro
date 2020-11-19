<div class="col-md-4 col-sm-4 col-xs-12">
  <div class="dbd-left-cont ">
  
     <!--  Banner Photo -->
     @if(auth::user()->banner_photo==NULL)
	     <div class="banner-pro" >
	       <a href="#" data-toggle="modal" data-target=".upload_banner_modal" class="show_banner"  >
			<div id='profile-uploadb' class="banner_photo" style="background-image:{{url('/frontend/images/dashboard-semi-banner.jpg')}}">
				<i class="fa fa-camera"></i>
			</div>
			 </a>	
	    </div>
		@else
		 
	     @php
		 $photo =  banner_photo(auth::user()->id);
		 @endphp
		
		 <div class="banner-pro"> 
			 <a href="#" data-toggle="modal" data-target=".upload_banner_modal" class="show_banner"  >
				<div id='profile-uploadb' class="banner_photo" style="background-image:url({{timthumb($photo,458,155)}})">
				  <i class="fa fa-camera"></i>		
				</div>
			 </a>	
		</div>
		 
		@endif
  
  
	
    <!--   profile_photo -->
	<div class="user-panel">
	    @if(auth::user()->profile_photo==NULL)
	       <div class="thumb profile_photo image">
              <a href="javascript:void(0)" data-toggle="modal" data-target=".upload_photo_modal" class="show_image"  ><span> {{ substr(auth::user()->first_name,0,1) }}</span></a>
           </div>
		@else
		 
	     @php
			$photo =  profile_photo(auth::user()->id);
		 @endphp
		<div class="image profile_photo">
			 <a href="javascript:void(0)" data-toggle="modal" data-target=".upload_photo_modal" class="show_image"  >
				<div id='profile-upload'>
		         <img class="profile_photo_change" src="{{timthumb($photo,80,80)}}">
				  <i class="fa fa-camera"></i>
				</div>
			 </a>	
		</div>
		 
		@endif
		<div class="info">
		{{user_data()->first_name}} {{user_data()->last_name}} 
		</div>
	  </div>					 
	 
	 
  </div>
</div>


<!-- ************************** Profile Pic Pload  POPUP ****************************** -->  


<div class="modal fade upload_photo_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg subs-modal profile_photo_modal">
    <div class="modal-content">
			<div class="modal-body">
			
			
		    	<div class="modal-header md-header" >
				 <div class="header-cont"><span style="color:#fff;font-size:16px">Upload Photo </span>  </div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			
			  </div>
			
			
				
					  <div class="row upload_box">
						<div class="col-md-6 text-center">
						<div id="upload-demo"></div>
						</div>
						<div class="col-md-6" style="padding:5%;">
						<strong>Choose image to crop:</strong>
						<!--input type="file" id="image_file"--> 
						 <input type="file" id="upload_profile_file" name="upload_profile_file" class="upload_input" accept="image/*" onChange="validate(this.value)"/>
						<p class="upload_profile_file_error error">&nbsp; </p>
						<button class="btn  btn-block upload-image" disabled="disabled" style="margin-top:2%">Upload Image</button>
						<div class="alert alert-success" id="upload-success" style="display: none;margin-top:10px;"></div>
						</div>
						<!--div class="col-md-4">
						<div id="preview-crop-image" style="background:#9d9d9d;width:200px;padding:50px 50px;height:200px;"></div>
						</div-->
					  </div>

		  </div>
   
    </div>
  </div>
</div>


<!-- ************************** BANNER UPLOAD PHOTO MODAL ****************************** -->  


<div class="modal fade upload_banner_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg subs-modal">
    <div class="modal-content">
			<div class="modal-body">
			
			   <div class="modal-header md-header" >
				 <div class="header-cont"><span style="color:#fff;font-size:16px">Upload Banner </span>  </div>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				  <span aria-hidden="true">&times;</span>
				</button>
			  </div>
			
			
			  <form method="POST" action="{{url('/upload_banner_photo')}}" id="upload_banner_form">
			   @csrf
			     <div class="mod-content">
				  <input type="file" id="upload_banner_file" name="upload_banner_file" class="upload_banner_file upload_input" />
				    <p class="upload_banner_file_error error">&nbsp; </p>
				 </div>
				  <div class="mod-content1">
					<a href="javascript:void(0)" class="upload_banner" id="upload_banner"><i class="fa fa-spinner fa-spin loader_banner" style="display:none"></i> Upload </a> 
				  </div>
			  </form>

		  </div>
   
    </div>
  </div>
</div>