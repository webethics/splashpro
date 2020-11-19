	@php
	$alltips =getAllUsertip();
	@endphp 

	@if(count($alltips)>0)
	<div class="table-responsive tip-info">
	<table class="table">
	  <thead>
		<tr>
		  <th scope="col">User Name</th>
		  <th scope="col">Amount</th>
		  <th scope="col">Post</th>
		  <th scope="col">Tip Date</th>
		</tr>
	  </thead>
	  <tbody>
	@foreach($alltips as $key => $tip)
	
			<tr>
			  <td>{{$tip->first_name}} {{$tip->last_name}}</td>
			  <td>{{config('constant.SET_CURRENCY_SIGN')}}{{ price_number_format($tip->tip_amount)}}</td>
			  <td><a href="{{url('post')}}/{{$tip->post_id}}" title="View"><i class="fa fa-eye" aria-hidden="true"></i>
</a></td>
			  
			  <td>{{ Carbon\Carbon::parse($tip->created_at)->format('jS  F, Y') }} </td>
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

						