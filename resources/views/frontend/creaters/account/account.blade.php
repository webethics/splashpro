@extends('frontend.layouts.master')
@section('pageTitle','Edit Profile')
@section('content')
@include('frontend.common.header')
<div class="main-container">
         <div class="container-fluid full-cont-nav">
            <div class="row dash-tabs">
               @include('frontend.partials.account_sidebar')
               <div class="col-md-8 col-sm-8 col-xs-12">
                  <div class="tab-content dbd-right-cont">
                     <div  class="tab-pane active" id="account">
                       				 
						<div class="clearfix seprator"></div>
                        <h1>Basic Info</h1>
						<p style="padding:10px 30px;font-size:13px;font-style:italic">Your username is how you will be seen and identified on the site. Your First and last name are not displayed.</p>
						 <!--- EDIT PROFILE  -->
						 <div class="crdsl-fields row edit_profile_box" >
                          @include('frontend.creaters.account.edit_profile')
						  </div>
							<div class="clearfix seprator"></div>
							<h1> Password </h1>
						
							<!--- CHANGE PASSWORD  -->
							 @include('frontend.creaters.account.change_password')		

							<div class="clearfix seprator"></div>
								
							
                     </div>

				
					

					

							 
                  </div>
               </div>
            </div>
         </div>
      </div>
@include('frontend.common.footer')
@section('userJs')
<link rel="stylesheet" href="{{ url('frontend/css/croppie.min.css')}}">
<script src="{{ url('frontend/js/croppie.js')}}"></script>
<script src="{{ url('frontend/js/module/user.js')}}"></script>	
<script src="{{ url('frontend/js/module/plan.js')}}"></script>	


<script type="text/javascript">
/* For TAB selected */
$(document).ready(() => {
  let url = location.href.replace(/\/$/, "");
  if (location.hash) {
    const hash = url.split("#");
    $('#test a[href="#'+hash[1]+'"]').tab("show");
    url = location.href.replace(/\/#/, "#");
    history.replaceState(null, null, url);
    setTimeout(() => {
      $(window).scrollTop(0);
    }, 400);
  }
  $('a[data-toggle="tab"]').on("click", function() {
    let newUrl;
    const hash = $(this).attr("href");
    if(hash == "#home") {
      newUrl = url.split("#")[0];
    } else {
      newUrl = url.split("#")[0] + hash;
    }
    newUrl += "/";
    history.replaceState(null, null, newUrl);
  });
});


</script>
 
@stop
@stop
