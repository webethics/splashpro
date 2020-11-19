@extends('frontend.layouts.master')
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
                     <h6 class="mb-4">Forget Password </h6>
                       @include('flash-message')
					 @if($notwork)
                      <form method="POST" action="{{ $url_post }}">
							 {{ csrf_field() }}
						<input name="token" value="{{ $token }}" type="hidden">	 
                        <div class="form-group">
                            <input type="password" name="password" class="form-control"  placeholder="Enter Password">
                                @if($errors->has('password'))
                                    <div class="error_margin"><span class="error">
                                        {{ $errors->first('password') }}
                                    </span>
                                    </div>
                                @endif
                         <!-- <div class="error_margin"><span class="error" >  {{ $errors->first('email')  }} </span></div>-->
                        </div>
                        <div class="form-group">
                          <input type="password" name="password_confirmation" class="form-control"placeholder="Confirm Password">
                                @if($errors->has('password_confirmation'))
                                    <div class="error_margin"><span class="error">
                                        {{ $errors->first('password_confirmation') }} </span>
                                    </div>
                                @endif
                        </div>
                
                        <div class="form-group">
                           <div class="captcha_wrapper"></div>
                           <div class="error_place error_place_for_captcha"></div>
                        </div>
                        <div class="form-group btns-group">
                           <button type="submit" class="btn btn-default btn-lg btn-login">
                                   Reset Password 
                                </button>
                        </div>
                        

                        
                     </form>
					@else
						 <h1>
                           
                                <div class="" style="font-size:14px">This link is not working any more.Please click <strong><a data-toggle="modal" href="#" data-target="#forget_modal" class="forget_password">Here</a></strong> to reset password </div>
                           
                        </h1>
					@endif 
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
    @include('frontend.partials.about_goal_section_login')  
   </div>
 @include('frontend.common.modal')
  @include('frontend.common.footer')
@section('userJs')
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
@stop
@stop