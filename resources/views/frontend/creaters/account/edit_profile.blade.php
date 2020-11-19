					  <form method="POST"  class="frm_class">
					    @csrf
                           <div class="col-lg-3 col-md-6 col-sm-12">
                              <div class="add-code">  
                                    <div class="pb-ns ">
                                       <label>First Name*</label>
                                       <input name="first_name" id="first_name" value="{{user_data()->first_name}} " placeholder="First Name" required="required" class="input" type="text">
									   <div class="error_margin"><span class="first_name_error error" ></span></div>
                                    </div>
                              </div>
                           </div>
                           <div class="col-lg-3 col-md-6 col-sm-12">
                              <div class="add-code">
                                    <div class="pb-ns ">
                                       <label>Last Name*</label>
                                       <input name="last_name" id="last_name" value="{{user_data()->last_name}}" placeholder="Last Name" required="required" class="input" type="text">
									    <div class="error_margin"><span class="last_name_error error" ></span></div>
                                    </div>
                              </div>
                           </div>
                        					   
                           <div class="col-lg-3 col-md-6 col-sm-12">
                              <div class="add-code">
                                    <div class="pb-ns ">
                                       <label>Email Address*</label>
                                       <input type="email"  class="input" value="{{user_data()->email}}" placeholder="Email" disabled="disabled">
                                    </div>
                             
                              </div>
                           </div>	
						  
						   <div class="col-md-12 col-sm-12">
                           <div class="save-btn"><a href="javascript:void(0)" class="update_profile">Update Info</a></div>
						   
						   </div>
			        </form>
						   
                      