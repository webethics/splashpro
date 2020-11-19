<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ trans('global.site_title') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-float-label.min.css') }}" />
	<link rel="stylesheet" href="{{ asset('css/dore.light.blue.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/dropzone.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/main.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}" />
    @yield('additionalCss')
	<link rel="shortcut icon" href="{{ asset('img/favicon.png')}}">
	<script> 
		base_url ="{{ url('/') }}";
	</script > 
</head>
<body class="background show-spinner no-footer">
     <div class="fixed-background"></div>
       <main>
        <div class="container login">
            @yield("content")
        </div>
	  </main>
	  
	  
	  
	<script src="{{ asset('js/vendor/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/vendor/bootstrap.bundle.min.js') }}"></script>
	<script src="{{ asset('js/vendor/bootstrap-datepicker.js')}}"></script>
    <script src="{{ asset('js/dore.script.js') }}"></script>
    <script src="{{ asset('js/vendor/dropzone.min.js')}}"></script>
    <script src="{{ asset('js/scripts.single.theme.js') }}"></script>
	@yield('strpieJs')
    <!---Add additionalJs-->
    @yield('additionalJs')
</body>

</html>