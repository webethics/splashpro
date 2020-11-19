 <form action="{{ url('customer/advance-search') }}" method="POST" id="searchForm" >
		@csrf
<div class="row">
	<div class="col-md-12 mb-4">
	<div class="card h-100">
		<div class="card-body">
			<div class="row">
				<div class=" col-md-6">
					<div class="row">
						<div class="form-group col-lg-6">
							<input type="text" name="first_name" id="first_name" class="form-control" placeholder="{{trans('global.search_by_first_name')}}">
						</div>
						<div class="form-group col-lg-6">
							<input type="text" name="last_name" id="last_name" class="form-control" placeholder="{{trans('global.search_by_last_name')}}">
						</div>
						<div class="form-group col-lg-6">
							<input type="text" name="email" id="email" class="form-control" placeholder="{{trans('global.search_by_email')}}">
						</div>
						<!-- If User is Super Admin --> 
						@if(current_user_role_id() == '1')
						<div class="form-group col-lg-6">
							<select  id="role_id"  class="form-control select2-single"  name="role_id"  data-width="100%">
										
								<option value=" ">{{trans('global.filter_by_role')}}</option>
								@foreach($roles as $key=>$role)
								@if($role->id!=1)
								<option value="{{$role->id}}">{{$role->title}}</option>
								@endif
								@endforeach
							</select>
						</div>
						@endif
						
					</div>
				</div>	
				
				<div class="col-lg-6">
					<div class="row">
						<div class="form-group col-lg-6">
							<div class="input-group date">
								<input type="text" class="form-control"  id="start_date" name="start_date"
									placeholder="{{trans('global.start_date')}}">
								<span class="input-group-text input-group-append input-group-addon">
									<i class="simple-icon-calendar"></i>
								</span>
							</div>
						</div>
						<div class="form-group col-lg-6">
							  
							<div class="input-group date">
								<input type="text" class="form-control"  placeholder="{{trans('global.end_date')}}" name="end_date" id="end_date">
								
								<span class="input-group-text input-group-append input-group-addon">
									<i class="simple-icon-calendar"></i>
								</span>
							</div>
							
						</div>
						<!-- <div class="form-group col-lg-6">
							<input type="text" name="mobile_number" id="mobile_number" class="form-control" placeholder="Search by Mobile Number">
						</div>
						 -->
						<!--<div class="form-group col-lg-6">
							<select  id="gender"  class="form-control select2-single"  name="gender"  data-width="100%">
										
								<option value=" ">{{trans('global.filter_by_gender')}}</option>
								<option value="male">Male</option>
								<option value="female">Female</option>
							</select>
						</div>
						<div class="form-group col-lg-3">
							<select id="age_from"  class="form-control select2-single"  name="age_from"  data-width="100%">
								<option value=" ">{{trans('global.filter_by_age_from')}}</option>
								@for($i=12;$i<=65;$i++)
									<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div>
						<div class="form-group col-lg-3">						
							<select id="age_to"  class="form-control select2-single"  name="age_to"  data-width="100%">
								<option value=" ">{{trans('global.filter_by_age_to')}}</option>
								@for($i=12;$i<=65;$i++)
									<option value="{{$i}}">{{$i}}</option>
								@endfor
							</select>
						</div> 
						-->
					</div>	
				</div>
			</div>
			<div class="row">
				<div class="form-group col-lg-6">
					<button type="submit" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto">{{trans('global.submit')}}</button>
					<button type="button" id="export_customers_left" class="btn btn-primary default  btn-lg mb-2 mb-lg-0 col-12 col-lg-auto">Export</button>
					<div class="spinner-border text-primary search_spinloder" style="display:none"></div>
				</div>	
			</div>
		</div>
	</div>				
	</div>
	</div>	
</form>