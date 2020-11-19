<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">{{ trans('global.business_name') }}</th>
		<th scope="col">{{ trans('global.owner_name') }}</th>
		<th scope="col">{{ trans('global.email') }}</th>
		<th scope="col">{{ trans('global.phone') }}</th>
		<th scope="col">{{ trans('global.business_url') }}</th>
		<th scope="col">{{ trans('global.activation') }}</th>
		<th scope="col">{{ trans('global.status') }}</th>								
		<th scope="col">{{ trans('global.qr_code_label') }}</th>								
		</tr>
	</thead>
	<tbody>
	 @if(is_object($users) && !empty($users) && $users->count())
	  @foreach($users as $key => $user)
		<tr data-user-id="{{ $user->id }}" class="user_row_{{$user->id}}" >
			<!--td id="name_{{$user->id}}"><a href="{{url('customers-listing')}}/{{$user->id}}">{{ $user->business_name ?? '' }}</a></td-->
			<td id="business_name_{{$user->id}}"><a href="javascript:void(0)" class="editUser" data-user_id="{{ $user->id }}">{{ $user->business_name ?? '' }}</a></td>
			<td id="name_{{$user->id}}">{{ $user->owner_name ?? '' }}</td>
			<td id="email_{{$user->id}}"> {{ $user->email  ?? '' }}</td>
			<td id="mobile_number_{{$user->id}}"> {{ $user->mobile_number  ?? '' }}</td>
			<td id="business_url_{{$user->id}}"> {{ $user->business_url  ?? '' }}</td>
			
			@php  $selected=''; @endphp
			 @if($user->status==1)
			@php	$selected = 'checked=checked'@endphp
		     @endif		
			
			<td id="created_at_{{$user->id}}"> {{ date('m/d/Y', strtotime($user->created_at))  ?? '' }}</td>

			<td><div class="custom-switch  custom-switch-primary custom-switch-small">
						<input class="custom-switch-input switch_status" id="switch{{ $user->id }}" type="checkbox" data-user_id="{{ $user->id }}" {{$selected}}>
						   <label class="custom-switch-btn" for="switch{{ $user->id }}"></label>
	
					  </div>
			</td>
			
			<td>
				<a title="Edit User" href="javascript:void(0)" class="editUser" data-user_id="{{ $user->id }}"><i class="simple-icon-note"></i></a>
				<a title="View Customers" href="{{url('customers-listing')}}/{{$user->id}}" data-user_id="{{ $user->id }}"><i class="simple-icon-eye"></i></a>
				<a title="Delete"  data-id="{{$user->id}}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the User ?"  data-left_button_name ="Yes" data-left_button_id ="delete_user" data-left_button_cls="btn-primary" class="open_confirmBox" href="javascript:void(0)" data-user_id="{{ $user->id }}"><i class="simple-icon-trash"></i></a>
			</td>
		</tr>
		
	 @endforeach
 @else
<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
 @endif	
		
	</tbody>
</table> 
	<!------------ Pagination -------------->
		@if(is_object($users) && !empty($users) && $users->count()) 
		 {!! $users->render() !!}  
		 @endif	