 <form>
 @csrf
 <div class="crdsl-fields row">
	   <div class="col-md-4 col-sm-12">
		  <div class="add-code">
				<div class="pb-ns ">
				   <label>Current password*</label>
				   <input name="old_password" placeholder="Current Password" required="required" class="input" type="password">
				   <div class="error_margin"><span class="old_password_error error" ></span></div>
				</div>
		  </div>
	   </div>
	   <div class="col-md-4 col-sm-12">
		  <div class="add-code">
				<div class="pb-ns ">
				   <label>New password*</label>
				   <input name="password" placeholder="New Password" required="required" class="input" type="password">
				    <div class="error_margin"><span class="password_error error" ></span></div>
				</div>
		  </div>
	   </div>
	   <div class="col-md-4 col-sm-12">
		  <div class="add-code">
				<div class="pb-ns ">
				   <label>Verify password*</label>
				   <input name="confirm_password" placeholder="Confirm Password" required="required" class="input" type="password">
				   <div class="error_margin"><span class="confirm_password_error error" ></span></div>
				</div>
			
		  </div>
	   </div>
		<div class="col-md-12 col-sm-12">
	   <div class="save-btn"><a href="javascript:void(0)" class="update_password"> Update Password </a></div>
	   </div>
	</div>	
 </form>	