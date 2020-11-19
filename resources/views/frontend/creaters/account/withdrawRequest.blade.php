	@php
	$withdrawRequest =getPendingWithdrawAmountList(user_id());
	@endphp 

	@if(count($withdrawRequest)>0)
	<div class="table-responsive tip-info">
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">#No</th>
		  <th scope="col">User Name</th>
		  <th scope="col"> Amount</th>
		  <th scope="col">Status</th>
		  <th scope="col">Withdraw Date</th>
		</tr>
	  </thead>
	  <tbody>
	@foreach($withdrawRequest as $key => $withdraw)
	 @php 
	 $user_data = user_data_by_id($withdraw->user_id)
	 @endphp
			<tr>
			  <td>{{ ++$key }}</td>
			  <td>{{$user_data->first_name}} {{$user_data->last_name}}</td>
			  <td>{{config('constant.SET_CURRENCY_SIGN')}}{{$withdraw-> withdraw_amount }}</td>
			  <td>Pending</td>
			  
			  <td>{{ Carbon\Carbon::parse($withdraw->created_at)->format('jS  F, Y') }} </td>
			</tr>
	@endforeach							  			
		  </tbody>
	  </table>
	</div>
	@else
		<div class="col-md-12 col-sm-12">
	  <div class="add-code">	
      <h5 class="notfound" style="text-align:center;font-size:16px">No Records Found</h5>
  </div></div>	
		
	@endif

						