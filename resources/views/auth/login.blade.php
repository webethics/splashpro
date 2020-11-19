@extends('frontend.layouts.master')
@section('pageTitle', 'Login')
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
					  @if(Session::get('user_profile') == URL::previous())
						<div class="alert alert-success alert-block">
							<button type="button" class="close" data-dismiss="alert">×</button>	
							   {{ Session::get('user_profile_message') }}
						</div>
											  
				      @endif
                      @include('flash-message')	
                    <form method="POST" action="{{ route('login') }}" class="frm_class">
							 {{ csrf_field() }}
                        <div class="form-group">
                           <input class="form-control" type="email" name="email" placeholder="E-mail" >
                          <div class="error_margin"><span class="error" >  {{ $errors->first('email')  }} </span></div>
                        </div>
                        <div class="form-group">
                           <input class="form-control" type="password" name="password" placeholder="Password" >
                           <div class="error_margin"><span class="error" >  {{ $errors->first('password')  }} </span></div>
                        </div>
                
                        <div class="form-group">
                           <div class="captcha_wrapper"></div>
                           <div class="error_place error_place_for_captcha"></div>
                        </div>
                        <div class="form-group btns-group">
                           <button class="btn btn-default btn-lg btn-login" type="submit">Login</button>
                        </div>
                        <a data-toggle="modal" href="#" data-target="#forget_modal" class="forgot">forgot password?</a> 
								
									<?php /* <div class="col-md-12 col-sm-12 facebook">
                                        <div class="form-group position-relative">                                         
                                            <button class="form-control">
                                                <div class="icon d-inline-block ">
                                                    <i class="fa fa-facebook-f"></i>
                                                </div>
                                               @php 
												$facbookurl = url('/redirect')
											   @endphp
												<div class="text d-inline-block" onclick="return social_login_popup('{{$facbookurl}}')">
												   Sign in with Facebook
												</div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 google">
                                        <div class="form-group position-relative">                                         
                                            <button class="form-control">
                                                <div class="icon d-inline-block ">
                                                    <i class="fa  fa-google"></i>
                                                </div>
                                                @php 
													$google_url = url('/redirectg/0')
												@endphp
												<div class="text d-inline-block" onclick="return social_login_popup('{{$google_url}}')">
													Sign in with Google
												</div>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-sm-12 apple">
                                        <div class="form-group position-relative">                                         
                                            <button class="form-control">
                                                <div class="icon d-inline-block ">
                                                    <i class="fa  fa-twitter"></i>
                                                </div>
												@php 
													$twitter_url = url('/twitter/redirect/0')
												@endphp
											  <div class="text d-inline-block" onclick="return social_login_popup('{{$twitter_url}}')">
												Sign in with Twitter
											 </div>
                                            </button>
                                        </div>
                                    </div> */
									?>
						

                        <a  href="{{url('/register')}}" class="register-btn">Don't have an account? <span> Register </span></a> 
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
 
  
</div>
@include('frontend.common.modal')
@include('frontend.common.footer')

@section('userJs')
<style>
 .facebook .text, .google .text,  .apple .text {
    width: 76%;
    font-size: 11px;
    padding: 12px 4px;
}
.d-inline-block {
    display: inline-block!important;
}
 .facebook .icon,  .google .icon, .apple .icon {
    width: 11%;
}

 .facebook button,  .google button,.apple button {
    display: block;
    padding: 0;
    text-align: left;
    background: #428bca;
    color: #fff;
    height: 42px;
    border: #357ebd 1px solid;
}

.facebook .form-control,.google .form-control,.apple .form-control{
	padding: 0px 0px;
}
.facebook .icon, .google .icon,  .apple .icon {
    width: 11%;
    vertical-align: top;
    border-right: 1px solid #ffffff90;
    height: 100%;
    padding: 12px 12px;
    font-size: 11px;
    background: #5a98cc;
    border-radius: 9px 0 0 9px;
}
.google .icon {
    background: #e48d8b;
}
.apple .icon {
    background: #ffffff80;
    border-right: 1px solid #00000090;
    font-size: 15px;
    vertical-align: top;
    padding: 9px 11px;
}

.google button {
    background: #d9534f;
    border: #d43f3a 1px solid;
}

.apple button {
    background: #f3f3f3;
    color: #000000;
    border: #909599 1px solid;
}
</style>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
@stop
@stop
