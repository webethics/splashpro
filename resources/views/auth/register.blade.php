@extends('frontend.layouts.master')
@section('pageTitle', 'Signup')
@section('content')
<div class="login-wraper">
   <div class="container">
      <div class="row">
         <div class="login-cont">
            <div class="col-md-6 col-sm-6 hidden-xs">
               <div class="login-banner"> <img class="img-responsive center-block" src="{{ url('frontend/images/login-page.jpg')}}" alt="logo"> </div>
            </div>
            <div class="col-md-5 col-sm-6">
               <div class="login-text">
                  <div class="panel-register"> 
                     <a class="logo" href="{{url('/')}}"><img class="img-responsive" src="<?php echo showSiteTitle("logo") ?>"></a>
                     <h6>Sign up to earn money off your content and chat with fans</h6>
                 
                     <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group">
                           <input class="form-control" type="text" name="first_name" placeholder="First Name"  value="{{ old('first_name') }}">
                           
                                @if ($errors->has('first_name'))
									<div class="error_margin">
                                    <span class="error" role="alert">
                                        {{ $errors->first('first_name') }}
                                    </span>
                                    </div>
                                @endif
                        </div>
						<div class="form-group">
                           <input class="form-control" type="text" name="last_name" placeholder="Last Name"  value="{{ old('last_name') }}">
                           
                                @if ($errors->has('last_name'))
									<div class="error_margin">
                                    <span class="error" role="alert">
                                        {{ $errors->first('last_name') }}
                                    </span>
                                    </div>
                                @endif
                        </div>
						<div class="form-group">
                           <input class="form-control" type="text" name="email" placeholder="E-mail"  value="{{ old('email') }}">
                           
                                @if ($errors->has('email'))
									<div class="error_margin">
                                    <span class="error" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                           <input class="form-control" type="password" name="password" placeholder="Password"  aria-autocomplete="list">
								@if ($errors->has('password'))
									<div class="error_margin">
                                    <span class="error" role="alert">
                                        {{ $errors->first('password') }}
                                    </span>
                                    </div>
                                @endif
                        </div>
                        <div class="form-group">
                           <input id="password-confirm" class="form-control" type="password" name="password_confirmation" placeholder="Confirm Password"  aria-autocomplete="list">
                           @if($errors->has('password_confirmation'))
                                    <div class="error_margin"><span class="error">
                                        {{ $errors->first('password_confirmation') }} </span>
                                    </div>
                                @endif
                        </div>
						
						<div class="form-group">
                           <input id="terms_condition" class="form-control" value="1" type="checkbox" @if(old('terms_condition')==1) checked="checked" @endif name="terms_condition" style="width:20px;height:20px;float:left">
						   <span style="margin-top: 3px;display: inline-flex;">I agree to the <a href="{{url('/terms')}}">&nbsp;terms and conditions&nbsp;</a> of the site </span>
                           @if($errors->has('terms_condition'))
								<div class="error_margin"><span class="error">
									{{ $errors->first('terms_condition') }} </span>
								</div>
                           @endif
                        </div>
                
                        <div class="form-group">
                           <div class="captcha_wrapper"></div>
                           <div class="error_place error_place_for_captcha"></div>
                        </div>
                        <div class="form-group btns-group">
                           <button class="btn btn-default btn-lg btn-login" type="submit">Sign up</button>
                        </div>
                        <a  href="{{url('/login')}}" class="register-btn">Already have an account? <span> Login </span></a>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 
 
</div>
@include('frontend.common.footer')
@stop
