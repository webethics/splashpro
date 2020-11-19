<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
   <title>{{ showSiteTitle('title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

 
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/fontawesome.min.css') }}"> 
    <link rel="stylesheet" href="{{ asset('css/style.css') }}" />
		<link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
  <script> 
	 base_url ="{{ url('/') }}";
	</script > 
</head>
<body class="">
 <main>
	<div class="main thank-you-template">
		
			@yield("content")
	</div>
	  
	  </main> 
	  
	<script src="{{ asset('js/vendor/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
	@yield('extraJsCss')
</body>

</html>