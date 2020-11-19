@extends('frontend.layouts.landing')
@section('content')
@section('extraJsCss')

@stop

  <nav class="navbar navbar-expand-lg navbar-light py-2 fixed-top" id="mainNav" data-scroll-header>
         <div class="container">
            <a class="navbar-brand " href="{{url('/')}}"><img class="img-fluid" src="{{asset('img/bigfoot.jpeg')}}"></a>
			   <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
			</button>
      
         </div>
      </nav>
	  

  <div class="wrapper-main">
	 <section id="home-banner" class="masthead page-section">
            <div class="container h-100">
               <div class="row h-100 align-items-center justify-content-center text-center">
                  <div class="col-lg-12 align-self-end">
                     <h1 class="text-uppercase ">Coming Soon...</h1>
                  </div>
                 
               </div>
            </div>
         </section>
		 
		
  </div>
   <footer class="footer">
	 <div class="container">
		<div class="row align-items-center">
		   
		   <div class="col-md-6 mt-4 mt-md-0">
			  <span class="copytext" style="float:left">© 2020 BigFoot Reviews. All rights reserved.</span>
		   </div>
		</div>
	 </div>
  </footer>
	  
 
 
@endsection