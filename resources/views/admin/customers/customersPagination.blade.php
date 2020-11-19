<table class="table table-hover mb-0">
	<thead class="bg-primary">
		<tr>
		<th scope="col">ID</th>
		<th scope="col">Registration</th>
		<th scope="col">Name</th>
		<th scope="col">Email</th>
		<!-- <th scope="col">Mobile</th> -->
		<th scope="col">Status</th>
		<th scope="col">Action</th>
		</tr>
	</thead>
	<tbody>
	 @if(is_object($customers) && !empty($customers) && $customers->count())
		 @php $sno = 1;$sno_new = 0  @endphp
		
	  @foreach($customers as $key => $customer)
		@include('admin.customers.customerSingleRow')
		@php $sno++ @endphp
	 @endforeach
 @else
<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
 @endif	
		
	</tbody>
</table> 
	<!------------ Pagination -------------->
		@if(is_object($customers) && !empty($customers) && $customers->count()) 
		 {!! $customers->render() !!}  
		 @endif	