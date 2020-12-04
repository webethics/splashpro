@extends('frontend.layouts.landing')
@section('pageTitle','Services')
@section('content')
<div class="content-section">
  <div class="container-fluid">
	<div class="row">
      <div class="col-lg-3 col-md-4 col-12">
        <div class="card mb-4 box-shadow"> <img src="{{asset('frontend/images/img1.jpg')}}" class="img-fluid" alt="Responsive image">
          <div class="card-body crdb-txt">
            <h3> Traffic </h3>
            <p class="card-text">Supercharge the traffic to your site and generate more business. Our paid ad systems aren't like the other guys.</p>
			 @if(Session::get('token_validation') == 'yes')
				<a href="{{url('/traffic')}}/{{Session::get('token')}}"> Packages </a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				<a href="{{url('/traffic')}}"> Packages </a> 
			@endif
        </div>
		</div>
		
		
		
      </div>
	  
	  <div class="col-lg-3 col-md-4 col-12">
        <div class="card mb-4 box-shadow"> <img src="{{asset('frontend/images/img2.jpg')}}" class="img-fluid" alt="Responsive image">
          <div class="card-body crdb-txt">
            <h3> Leads </h3>
            <p class="card-text">When you need highly targeted people who are looking to buy your product or service, then there isn't a better source of high-quality leads.</p>
			@if(Session::get('token_validation') == 'yes')
				<a href="{{url('/leads')}}/{{Session::get('token')}}"> Packages </a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				<a href="{{url('/leads')}}"> Packages </a> 
			@endif
			
            </div> 
        </div>
	</div>
	
	 <!------------------------- To create duplicate start from here ----------------------->
	<div class="col-lg-3 col-md-4 col-12">
        <div class="card mb-4 box-shadow"> <img src="{{asset('frontend/images/img1.jpg')}}" class="img-fluid" alt="Responsive image">
          <div class="card-body crdb-txt">
            <h3> vSEO </h3>
            <p class="card-text">Supercharge the traffic to your site and generate more business. Our paid ad systems aren't like the other guys.</p>
			 @if(Session::get('token_validation') == 'yes')
				<a href="{{url('/vseo')}}/{{Session::get('token')}}"> Packages </a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				<a href="{{url('/vseo')}}"> Packages </a> 
			@endif
        </div>
		</div>
		
		
		
      </div>
	   <!------------------------- To create duplicate start from here ----------------------->
	
	</div>
    
  </div>
</div>
@endsection