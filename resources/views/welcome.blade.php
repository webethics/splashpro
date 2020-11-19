@extends('admin.layouts.masterlogin')
@section('content')
<div class="login-wraper">
    <div class="container">
        <div class="row">
         <div class="login-cont">
            <div class="col-md-4 col-md-offset-2 col-sm-6">
                <div class="login-banner">
                    
                    <img class="img-responsive center-block" src="{{ url('assets/admin/dist/img/welcome.jpeg') }}" alt="logo">
                </div>
            </div>
            <div class="col-md-4 col-sm-6 login_box_new">
            <div class="login-text">
            <div class="panel-register">
              <div class="login-logo">
                <!-- <img class="img-responsive center-block" src="{{ url('images/logo.png') }}" width="130px" alt="logo"> -->
                <!-- <a href="#"><b>Page not found</b></a> -->
              </div>
              <!-- /.login-logo -->
                
              <div class="login-box-body">
               <p class="alert alert-error">We're sorry, we couldn't find the page you requested.</p>
                        
               
              </div>
            </div>  
            </div>  
        </div>
        </div>
    </div>
</div>
</div>
   
@stop
