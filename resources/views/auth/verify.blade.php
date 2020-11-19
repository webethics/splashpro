@extends('frontend.layouts.master')

@section('content')
<div class="login-wraper">
  <div class="container">
    <div class="row">
      <div class="login-cont">
        <div class="col-md-6 col-sm-6 hidden-xs">
          <div class="login-banner"> <img class="img-responsive center-block" src="{{url('/frontend/images/login-page.jpg')}}" alt="logo"> </div>
        </div>
        <div class="col-md-5 col-sm-6">
          <div class="login-text">
            <div class="panel-register">
			<a class="logo" href="{{url('/')}}"><img class="img-responsive" src="<?php echo showSiteTitle("logo") ?>"></a>
              <h6 class="confirmation-message">Please check your email and verify your account.</h6> 
              <div class="have_account">Click here to <a href="{{url('/login')}}">Login</a></div>			  
            </div>
          </div>
        </div>
      </div>
    </div>	
  </div>
  
    <!-- Include Section from partial view --> 
    @include('frontend.partials.about_goal_section_login') 

</div>

@include('frontend.common.footer')
@endsection