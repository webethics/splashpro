<form method="POST" action="{{ url('/upload_verification_document') }}" id="uppload_document_form">
 @csrf
 <div class="col-md-4 col-sm-12 col-md-offset-4 ">
	  <div class="add-code">
			<div class="pb-ns ">
			   <label>Document Type</label>
			   <div class="all-btn add-code1">
			   <select class="selectpicker" name="document_type" id="document_type">
				<option value="Driving Licence">Driving Licence</option>
				<option value="Passport"> Passport </option>
				<option value="Country ID"> Country ID </option>
			   </select>
			    <div class="error_margin"><span class="document_type_error error" ></span></div>
			   </div>
			</div>
	  </div>
</div>
						   	   						   
<div class="col-md-12">
	<!-- <img style="margin-top:40px;" class="img-responsive center-block" src="images/file-upload.jpg"> -->
		
		<div class="upload-doc-txt">
			<div class="upload-doc"> <label for="img"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Front:</label>
		    <input type="file" id="document_front" name="document_front">
			 
		    </div>
			<div class="error_margin" style="text-align:center;display:block"><span class="document_front_error error" ></span></div>
			<div class="clearfix"></div>
			<div class="upload-doc" style="margin-top:10px;"> <label for="img"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Back:</label>
		    <input type="file" id="document_back" name="document_back">
			 <div class="error_margin" style="text-align:center"><span class="document_back_error error" ></span></div>
		    </div>
			
			<div class="upload-doc" style="margin-top:10px;"> <label for="img"><i class="fa fa-cloud-upload" aria-hidden="true"></i> Upload Selfie:</label>
		    <input type="file" id="upload_selfie" name="upload_selfie">
			 <div class="error_margin" style="text-align:center"><span class="document_back_error error" ></span></div>
		    </div>
			
		   
		    <button type="submit" id="upload_document" name="upload_document"><i class="fa fa-spinner fa-spin loader_profile_verification" style="display:none"></i> Upload </button> 
			
			
			{{-- <div class="note"> <b>Note </b>: This is required to make sure you are who you say you are, that you're over 18, and the content you post is in fact yours. </div>--}}																					
		  <div class="note"> <b>Note </b>:  Having your profile verified is not a requirement. This is to help with copyright claims if they arise - but is not needed to use or earn on the site. </div>																					
		   </div>														
													
</div>
</form>	