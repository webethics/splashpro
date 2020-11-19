<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">ID</th>
		<th scope="col">Name</th>
		<th scope="col">Slug</th>
		<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
	 @if(is_object($roles) && !empty($roles) && $roles->count())
	  @foreach($roles as $key => $roles)
		<tr data-roles-id="{{ $roles->id }}" class="user_row_{{$roles->id}}" >
			<td id="business_name_{{$roles->id}}">{{$roles->id}}</td>
			<td id="business_name_{{$roles->id}}">{{$roles->title}}</td>
			<td id="business_name_{{$roles->id}}">{{$roles->slug}}</td>
			
			<td id="business_url_{{$roles->id}}">
				<a class="action editRole" href="javascript:void(0)" data-role_id="{{ $roles->id }}" title="Edit Role"><i class="simple-icon-note"></i> </a>
				
				<a title="Delete Role"  data-id="{{ $roles->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Role?"  data-left_button_name ="Yes" data-left_button_id ="delete_role" data-left_button_cls="btn-primary" class="open_confirmBox action deleteRole"  href="javascript:void(0)" data-role_id="{{ $roles->id }}"><i class="simple-icon-trash"></i></a>
				
				
			</td>	
		</tr>
		
	 @endforeach
 @else
<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
 @endif	
		
	</tbody>
</table> 
	