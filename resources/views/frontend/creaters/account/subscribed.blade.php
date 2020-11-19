@php
$count =1;
@endphp 

@php
$subscribed_list =getSubscribedUserList(user_id());
@endphp 

@if(count($subscribed_list)>0)	 
<div class="col-md-6 col-sm-12">
  <div class="add-code">	
@foreach($subscribed_list as $key => $subscriber)
         @php 
		   $user_detail =user_data_by_id($subscriber->user_id)
		 @endphp
		  @php 
		   $profile_photo =profile_photo($subscriber->user_id)
		 @endphp
		<div class="user-area subscribed_id_{{$subscriber->id}}">
			<div class="user-cont">
					@if($user_detail->profile_photo==NULL)
						 <div class="people_you_thumb" style="float:left">
							<a href="{{url('/u')}}/{{$user_detail->username}}"><span> {{ substr($user_detail->first_name,0,1) }} </span></a>
						  </div>
						  @else

						<a href="{{url('/u')}}/{{$user_detail->username}}">
							<img class="img-responsive img" src="{{timthumb($profile_photo,70,70)}}" alt="image"></a>
						
					@endif
			
		
			<div class="user-des">
			  <h5><a href="{{url('/u')}}/{{$user_detail->username}}"> {{ $user_detail->first_name }}  {{ $user_detail->last_name }} </a></h5>
			</div>
			</div> 
			<a href="javascript:void(0)" class="add-user cancel_subscribeModal_Open" data-subscription="paid" data-subscription_id="{{$subscriber->id}}"> <i class="fa fa-minus-circle" aria-hidden="true"></i></a>
		</div>	
	   @if($count%5 ==0 )
	  </div></div><div class="col-md-6 col-sm-12"><div class="add-code">
	@endif 
	@php
	$count++
	@endphp 
	<div class="modal fade canelSubscrptionModal_{{$subscriber->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"></div>
	@endforeach 
	
	</div></div>	
@else
	<div class="col-md-12 col-sm-12">
	  <div class="add-code">	
  <h5 class="notfound" style="text-align:center;font-size:16px">No Records Found</h5>
  </div></div>	
@endif	

			
			   


						   