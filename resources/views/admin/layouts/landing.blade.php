<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
   <title>{{ showSiteTitle('title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

 
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/landing_style.css') }}" />
		<link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
  <script> 
	 base_url ="{{ url('/') }}";
	</script > 
</head>
<body >
 	
	@yield("content")

	  
	<script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/vendor/PageScroll2id.min.js') }}"></script>
	@yield('extraJsCss')
</body>

</html>