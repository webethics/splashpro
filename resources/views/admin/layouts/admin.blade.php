<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ showSiteTitle('title') }}</title>
    <link rel="stylesheet" href="{{ asset('font/iconsmind-s/css/iconsminds.css')}}" />
    <link rel="stylesheet" href="{{ asset('font/simple-line-icons/css/simple-line-icons.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/dataTables.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/datatables.responsive.bootstrap4.min.css')}}" />
    <link rel="stylesheet" href="{{ asset('css/vendor/bootstrap.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-datepicker3.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/bootstrap-colorpicker.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/select2.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/select2-bootstrap.min.css')}}" />
	
    <link rel="stylesheet" href="{{ asset('css/vendor/perfect-scrollbar.css')}}" />
	
	<link rel="stylesheet" href="{{ asset('css/vendor/component-custom-switch.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/dore.light.blue.min.css')}}" />
	<link rel="stylesheet" href="{{ asset('css/vendor/dropzone.min.css')}}" />
	<!---  Notification Css--> 
	<link rel="stylesheet" href="{{ asset('css/vendor/notifications.css')}}" />
	
    <link rel="stylesheet" href="{{ asset('css/main.css')}}" />
	<link href="{{ asset('css/custom.css') }}" rel="stylesheet" />
	@yield('additionalCss')
	<link rel="shortcut icon" href="{{ asset('img/favicon.ico')}}">
	<script> 
	 base_url ="{{ url('/admin') }}";
	 site_url ="{{ url('/') }}";
	</script > 
</head>

<body id="app-container" class="menu-default menu-sub-hidden show-spinner flat">
      @include('admin.common_layout.header')
      @include('admin.partials.menu')
        <main class="main">
			<div class="container-fluid">
                @yield('content')
			</div>
        </main>  
<script src="{{ asset('js/vendor/jquery-3.3.1.min.js')}}"></script>
<script src="{{ asset('js/vendor/bootstrap.bundle.min.js')}}"></script>
<script src="{{ asset('js/vendor/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{ asset('js/vendor/perfect-scrollbar.min.js')}}"></script>
<script src="{{ asset('js/vendor/datatables.min.js')}}"></script>
<script src="{{ asset('js/vendor/bootstrap-datepicker.js')}}"></script>

<script src="{{ asset('js/vendor/bootstrap-editable.min.js')}}"></script>
<script src="{{ asset('js/vendor/select2.full.js')}}"></script>
<script src="{{ asset('js/dore.script.js')}}"></script>
<script src="{{ asset('js/vendor/dropzone.min.js')}}"></script>
<!---  Notification Js--> 
<script src="{{ asset('js/vendor/notifications.js')}}"></script>		
<script src="{{ asset('js/scripts.single.theme.js')}}"></script>		
<script src="{{ asset('js/custom.js')}}"></script>

<!--  Add js For Add/edit/listing request page --> 	
@yield('addEditRequestjs')
<!--  Add js profile page/password  page --> 		

@yield('profilepageJsCss')

<!---    UserJs module/user.js  -->
@yield('userJs')

<!---    UserJs module/audits.js  -->
@yield('auditJs')
<!-- email template ckeditor js -->
@yield('ckeditor') 

@yield('cancelsubscriptionJsAccountBlade')

@include('admin.common_layout.footer')