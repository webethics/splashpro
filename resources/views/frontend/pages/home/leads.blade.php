@extends('frontend.layouts.landing')
@section('pageTitle','Leads')
@section('content')
<div class="content-section">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h1 class="traffic-hd"> Leads </h1>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="trf-box">
          <div class="grey-box">
            <p> STARTER PACKAGE </p>
            <h2> $500 </h2>
            <span> per month </span> </div>
          <div class="gry-txt-box">
            <h6> Lead Starter </h6>
            <p> This is a blended campaign to get you started by providing impressions across multiple  platforms including mobile, desktop and high visibility sites. </p>
            <p class="fade-txt"> Plus 25% management fee 5,000 impressions per month Spans 200M platforms Mobile friendly 
              Includes all major ad channels Shared reporting </p>
            @if(Session::get('token_validation') == 'yes')
				<a href="javascript:void(0);" class="submit-button updatePlan" data-stripe="{{config('constant.leads_products.product_1')}}" data-cost="$500" >BUY NOW</a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				 <a href="javascript:void(0);" class="no-submit-button">BUY NOW</a> 
			@endif
        </div>
      </div>
      </div>
      <div class="col-lg-3 col-md-6 col-12">
        <div class="trf-box">
          <div class="grey-box">
            <p> LEVEL 1 PACKAGE </p>
            <h2> $2,500 </h2>
            <span> per month </span> </div>
          <div class="gry-txt-box">
            <h6> Lead Level 1 </h6>
            <p>When you are ready to step up your game and really increase leads to your website or e-commerce store. Level 1 is the first step in driving numbers.</p>
            <p class="fade-txt"> Plus 15% management fee 5,000 impressions per month Spans 200M platforms Mobile friendly Includes all major ad channels Shared reporting </p>
           @if(Session::get('token_validation') == 'yes')
				<a href="javascript:void(0);" class="submit-button updatePlan" data-stripe="{{config('constant.leads_products.product_2')}}" data-cost="$2500" >BUY NOW</a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				 <a href="javascript:void(0);" class="no-submit-button">BUY NOW</a> 
			@endif
        </div>
       </div>
      </div>
     <div class="col-lg-3 col-md-6 col-12">
        <div class="trf-box">
          <div class="grey-box">
            <p> LEVEL 2 PACKAGE </p>
            <h2> $5,000 </h2>
            <span> per month </span> </div>
          <div class="gry-txt-box">
            <h6> Lead Level 2 </h6>
            <p> Level 2 is for the serial e-commerce store owner. All blended packages like this are best for your ROI and this package provides a punch.</p>
            <p class="fade-txt"> Plus 10% management fee 5,000 impressions per month Spans 200M platforms Mobile friendly Includes all major ad channels Shared reporting </p>
            @if(Session::get('token_validation') == 'yes')
				<a href="javascript:void(0);" class="submit-button updatePlan" data-stripe="{{config('constant.leads_products.product_3')}}" data-cost="$5000" >BUY NOW</a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				 <a href="javascript:void(0);" class="no-submit-button">BUY NOW</a> 
			@endif
        </div>
      </div>
	  </div>
	  <!------------------------- To create duplicate start from here ----------------------->
      <div class="col-lg-3 col-md-6 col-12">
        <div class="trf-box">
          <div class="grey-box">
            <p> PRO </p>
            <h2> $10,000 </h2>
            <span> per month </span> </div>
          <div class="gry-txt-box">
            <h6> Lead Pro </h6>
            <p> At the top of the leaderboard you have to fight hard for the leads you need to generate increasing revenue. The Pro Package delivers. </p>
            <p class="fade-txt"> Plus 7% management fee 5,000 impressions per month Spans 200M platforms Mobile friendly Includes all major ad channels Shared reporting </p>
            @if(Session::get('token_validation') == 'yes')
				<a href="javascript:void(0);" class="submit-button updatePlan" data-stripe="{{config('constant.leads_products.product_4')}}" data-cost="$10,000" >BUY NOW</a> 
			@endif
			 @if(Session::get('token_validation') == 'no')
				 <a href="javascript:void(0);" class="no-submit-button">BUY NOW</a> 
			@endif
        </div>
      </div>
	  </div>
	  <!------------------------- To create duplicate end from here ----------------------->
    </div>
  </div>
</div>
@include('modal.stripeCard')
@include('modal.tokenError')

	  @endsection
	  
@section('extraJsCss')
  <script src="https://js.stripe.com/v3/"></script>
  <script type="text/javascript">
   var stripeClient = "{{config('services.stripe.key')}}";
  </script>
  <script src="{!! asset('frontend/js/payment-method.js') !!}"></script>
  <script>
  
  $(document).on('click','.submit-button', function(e) {
	  $('.updatePlan').removeClass('selected');
	  $("#stripeCardModal").modal("show");
	  $(this).addClass('selected');
  });
  $(document).on('click','.no-submit-button', function(e) {
	  $("#tokenErrorModal").modal("show");
	 
  });
  </script>
@stop