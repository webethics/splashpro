<div class="nav-section border-bottom">
  <div class="container-fluid">
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-dark">
      <div class="logo"> <a class="navbar-brand" href="#"> <img src="{{asset('frontend/images/logo.png')}}" class="img-fluid" alt="Responsive image"> </a> <a class="service-btn" href="{{  url( 'services' ) }}"> Services </a> </div>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation"> <span class="navbar-toggler-icon"></span> </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav left-nv mr-auto">
          @php $services = $traffics = $leads = '' @endphp
		 @if(collect(request()->segments())->last()=='/' || collect(request()->segments())->last()=='services')
			@php $services ='active' @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='traffics')
			@php $traffics ='active' @endphp
		 @endif
		 @if(collect(request()->segments())->last()=='leads')
			@php $leads ='active' @endphp
		 @endif
		 
          <li class="nav-item {{$services}} "> <a class="nav-link" href="{{  url( 'services' ) }}">Service Home </a> </li>
          <li class="nav-item {{$traffics}} "> <a class="nav-link" href="{{  url( 'traffics' ) }}">Traffic</a> </li>
          <li class="nav-item {{$leads}} "> <a class="nav-link" href="{{  url( 'leads' ) }}">Leads</a> </li>
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
          <li class="nav-item"> <a class="nav-link login" href="#">Login</a> </li>
          <li class="nav-item"> <a class="nav-link signup" href="#">Sign Up <i class="fas fa-sign-in-alt"></i></a> </li>
        </ul>
      </div>
    </nav>
  </div>
</div>


