<div class="nav-section border-bottom">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
	
	 @if(Session::get('token_validation') == 'yes')
		<div class="logo"> 
			<a class="navbar-brand desktop" href="{{ url( 'https://mytrendingstories.com/' ) }}"><img src="{{asset('frontend/images/logo-white.png')}}" class="img-fluid" alt="Responsive image"> </a> 
			<a class="navbar-brand mobilelogo" href="{{ url( 'https://mytrendingstories.com/' ) }}"><img src="{{asset('frontend/images/logo-black.png')}}" class="img-fluid" alt="Responsive image"> </a> 
			<a class="service-btn" href="{{  url( 'services' ) }}/{{Session::get('token')}}"> Services </a> 
		</div>
	  @endif
	  @if(Session::get('token_validation') == 'no')
		<div class="logo"> 
			<a class="navbar-brand desktop" href="{{ url( 'https://mytrendingstories.com/' ) }}"> <img src="{{asset('frontend/images/logo-white.png')}}" class="img-fluid" alt="Responsive image"> </a>
			<a class="navbar-brand mobilelogo" href="{{ url( 'https://mytrendingstories.com/' ) }}"> <img src="{{asset('frontend/images/logo-black.png')}}" class="img-fluid" alt="Responsive image"> </a>
			<a class="service-btn" href="{{  url( 'services' ) }}"> Services </a> </div>
	  @endif
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav left-nv mr-auto">
          @php $services = $traffics = $leads = $vseo = '' @endphp
		 @if(collect(request()->segments())->last()=='/' || collect(request()->segments())->last()=='services' || collect(request()->segments())->last()=='')
			@php $services ='active' @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='traffic')
			@php $traffics ='active' @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='leads')
			@php $leads ='active' @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='vseo')
			@php $vseo ='active' @endphp
		 @endif
		 
         
		  @if(Session::get('token_validation') == 'yes')
		 
			<li class="nav-item {{$services}} "> <a class="nav-link" href="{{  url( 'services' ) }}/{{Session::get('token')}}">Service Home </a> </li>
			<li class="nav-item {{$traffics}} "> <a class="nav-link" href="{{  url( 'traffic' ) }}/{{Session::get('token')}}">Traffic</a> </li>
			<li class="nav-item {{$leads}} "> <a class="nav-link" href="{{  url( 'leads' ) }}/{{Session::get('token')}}">Leads</a> </li>
		 	<li class="nav-item {{$vseo}} "> <a class="nav-link" href="{{  url( 'vseo' ) }}/{{Session::get('token')}}">vSEO </a> </li>
		  @endif
		   @if(Session::get('token_validation') == 'no')
		 
			<li class="nav-item {{$services}} "> <a class="nav-link" href="{{  url( 'services' ) }}">Service Home </a> </li>
			<li class="nav-item {{$traffics}} "> <a class="nav-link" href="{{  url( 'traffic' ) }}">Traffic</a> </li>
			<li class="nav-item {{$leads}} "> <a class="nav-link" href="{{  url( 'leads' ) }}">Leads</a> </li>
			<li class="nav-item {{$vseo}} "> <a class="nav-link" href="{{  url( 'vseo' ) }}">vSEO</a> </li>
			
		  @endif
		  
        </ul>
        <ul class="navbar-nav nav-rght mt-2 mt-md-0">
          <li class="nav-item ">
            <div class="search-field"> </div>
            <form role="search" method="get" class="search-form" action="{{ url( '/' ) }}">
              <label for="search-input" id="search-label" class="search-label"> Search for: </label>
              <input id="search-input" type="search" class="search-input" placeholder="Search …" value="" name="s" title="Search for:" />
              <input type="submit" class="search-submit" value="Search" />
            </form>
          </li>
          <li class="nav-item "> <a class="nav-link" href="#">
            <div class="select-data">
              <select class="selectpicker">
                <option>English</option>
                <option>French</option>
                <option>German </option>
              </select>
            </div>
            </a> </li>
			
			@if(Session::get('token_validation') == 'yes')
				<li class="nav-item"> <a class="nav-link signup name_auth" href="javascript:void(0)">{{$user_data->name}}</a></li>
			@else
				<li class="nav-item"> <a class="nav-link login" href="https://mytrendingstories.com/auth/login">Login</a> </li>
				<li class="nav-item"> <a class="nav-link signup" href="https://mytrendingstories.com/auth/signup">Sign Up <i class="fas fa-sign-in-alt"></i></a> </li>
			@endif
        </ul>
      </div>
    </nav>
  </div>
</div>


