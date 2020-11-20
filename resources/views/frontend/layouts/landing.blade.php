<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ showSiteTitle('title') }}</title>
    
	
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-select.min.css') }}">
	<link rel="stylesheet" href="{{ asset('frontend/css/fontawesome.min.css') }}" type="text/css">
	
	<link rel="stylesheet" href="{{ asset('frontend/css/aos.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">
	<link rel="stylesheet" href="{{ asset('frontend/css/gijgo.min.css') }}" type="text/css">


		<link rel="shortcut icon" href="{{ asset('frontend/images/favicon.png')}}">
  <script> 
	 base_url ="{{ url('/') }}";
	</script > 
</head>
<body >
 	@include('frontend.common.header')
	@yield("content")

	<script src="{{ asset('frontend/js/jquery-3.2.1.slim.min.js') }}"></script> 
	<script src="{{ asset('frontend/js/bootstrap.bundle.min.js') }}"></script> 
	<script src="{{ asset('frontend/js/bootstrap-select.min.js') }}"></script> 
	<script src="{{ asset('frontend/js/gijgo.min.js') }}"></script> 
	<script src="{{ asset('frontend/js/defaults-en_US.min.js') }}"></script> 
	@include('frontend.common.footer')
	@yield('extraJsCss')
	
</body>

</html>