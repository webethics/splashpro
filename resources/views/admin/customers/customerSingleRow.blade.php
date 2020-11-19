<tr data-customer-id="{{ $customer->id }}" class="user_row_{{$customer->id}}" >		
	<td id="sno_{{$customer->id}}">{{(($page_number-1) * 10)+$sno}} 
		<input type="hidden" name="page_number" value="{{$page_number}}" id="page_number_{{$customer->id}}"/>
		<input type="hidden" name="sno" value="{{$sno}}" id="s_number_{{$customer->id}}"/>
	</td>
	<td id="registation_{{$customer->id}}">{{viewDateFormat($customer->created_at)}}</td>
	<td id="full_name_{{$customer->id}}">{{$customer->first_name}} {{$customer->last_name}}</td>
	<td id="email_{{$customer->id}}">{{$customer->email}}</td>
	<!-- <td id="email_{{$customer->id}}">{{$customer->mobile_number}}</td> -->
	<td id="status_{{$customer->id}}">
		@php  $selected=''; @endphp
		@if($customer->status==1)
		@php	$selected = 'checked=checked'@endphp
		@endif	
		<div class="custom-switch  custom-switch-primary custom-switch-small">
			<input class="custom-switch-input switch_status" id="switch{{ $customer->id }}" type="checkbox" data-user_id="{{ $customer->id }}" {{$selected}}>
			   <label class="custom-switch-btn" for="switch{{ $customer->id }}"></label>

		  </div>
	</td>
	<td id="action_{{$customer->id}}">
		
		@if(check_role_access('customer_edit'))
			<a class="action editCustomer" href="javascript:void(0)" data-user_id="{{ $customer->id }}" title="Edit Customer"><i class="simple-icon-note"></i> </a> 
		@endif
		<!-- @if(check_role_access('customer_manage') && ($customer->role_id == 3 || $customer->role_id == 2))
			<a class="action" target = "_blank" href="{{url('manage-customer')}}/{{$customer->id}}"  data-user_id="{{ $customer->id }}" title="Manage Customer"><i class="simple-icon-login"></i> </a> 
		@endif -->
		
		@if(check_role_access('customer_delete'))
			<a title="Delete Customer"  data-id="{{ $customer->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Customer?"  data-left_button_name ="Yes" data-left_button_id ="delete_customer" data-left_button_cls="btn-primary" class="open_confirmBox action deleteCustomer"  href="javascript:void(0)" data-customer_id="{{ $customer->id }}"><i class="simple-icon-trash"></i></a>
		@endif	
		
	</td>	
</tr>