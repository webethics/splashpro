@php
$count =1;
@endphp 

@php
$subscriber_list =getSubscriberList(user_id());
@endphp 

@if(count($subscriber_list)>0)	 
<div class="col-md-6 col-sm-12">
	  <div class="add-code">	
 
@foreach($subscriber_list as $key => $subscriber)
         @php 
		   $user_detail =user_data_by_id($subscriber->subscriber_by)
		 @endphp
		  @php 
		   $profile_photo =profile_photo($subscriber->subscriber_by)
		 @endphp
		<div class="user-area">
			<div class="user-cont">
					@if($user_detail->profile_photo==NULL)
						 <div class="people_you_thumb" style="float:left">
							<a href="{{url('/u')}}/{{$user_detail->username}}"><span> {{ substr($user_detail->first_name,0,1) }} </span></a>
						  </div>
						  @else

						<a href="{{url('/u')}}/{{$user_detail->username}}">
							<img class="img-responsive img" src="{{timthumb($profile_photo,40,40)}}" alt="image"></a>
						
					@endif
			
		
			<div class="user-des">
			  <h5><a href="{{url('/u')}}/{{$user_detail->username}}"> {{ $user_detail->first_name }}  {{ $user_detail->last_name }}</a></h5>
			</div>
			</div> 
		</div>	
	   @if($count%5 ==0 )
	  </div></div><div class="col-md-6 col-sm-12"><div class="add-code">
	@endif 
	@php
	$count++
	@endphp 
	@endforeach 
	</div></div>	
@else
	<div class="col-md-12 col-sm-12">
	  <div class="add-code">	
  <h5 class="notfound" style="text-align:center;font-size:16px">No Records Found</h5>
  </div></div>	
@endif	

			
			   


						   