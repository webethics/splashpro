  <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left">
			@php
				$redirect = url('/');
				$role_id = Config::get('constant.role_id');
				if($role_id['SUPER_ADMIN']== current_user_role_id()){
					$redirect =  url('/account'); 
				}
				else if($role_id['NORMAL_USER']== current_user_role_id()){
					$redirect =  url('/account');					
				}else{
					$redirect =  url('/account');		
				}
				@endphp
		   
		    <a class="navbar-logo" href="{{$redirect }}">
				<span class="logo d-none d-xs-block" style="background-image: url('<?php echo showSiteTitle("logo") ?>')">
                </span>
				<span class="logo-mobile d-block d-xs-none"></span>
			</a>
	
            <a href="#" class="menu-button d-none d-md-block">
                <svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg>
                <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg>
            </a>

            <a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg>
            </a>

        </div>
        <div class="navbar-right">
            
			    @include('partials.account')	 
        </div>
    </nav>