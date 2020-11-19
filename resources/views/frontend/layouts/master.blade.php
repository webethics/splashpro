<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
	<meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ showSiteTitle('title') }}</title>
    <link rel="shortcut icon" type="image/x-icon" href="{{ url('frontend/images/favicon.ico') }}">
    <!-- Bootstrap Core CSS -->
    <link href="{{ url('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{ url('frontend/css/font-awesome.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{ url('frontend/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('frontend/css/hover-min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ url('frontend/css/custom.css') }}" />
	<link rel="stylesheet" href="{{ url('frontend/css/vendor/notifications.css')}}"/>
	<link href="{{ url('frontend/css/bootstrap-select.min.css')}}" rel="stylesheet">
	  <link rel="stylesheet" href="{{ url('frontend/css/jquery.fancybox.min.css')}}">
	@yield('chatcss')
	<script> 
	 base_url ="{{ url('/') }}";
	</script > 
  </head>
  <!--body oncontextmenu="return false" onkeydown="return false;" onmousedown="return false;"-->
  <body>

    @yield('content')


   
	<script src="{{ url('frontend/js/jquery.js')}}"></script>
    <script src="{{ url('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{ url('frontend/js/bootstrap-select.min.js')}}"></script>
	<script src="{{ url('frontend/js/vendor/notifications.js')}}"></script>
	<script src="{{ url('frontend/js/common.js')}}"></script>
	  <script type="text/javascript" src="{{ url('frontend/js/jquery.fancybox.min.js')}}"></script>
	

    <script type="text/javascript">
       /*
        $(document).ready(function () {

            //Disable full page

            $("body").on("contextmenu",function(e){

               // alert("right click functionality is disabled for this page.");

                return false;

            });    
            
			$(document).keydown(function(e){
				if(e.which === 123){
				   return false;
				}
			});

        });

        $(document).ready(function () {       

           //Disable cut copy paste

            $('body').bind('cut paste', function (e) {

               // alert("cut copy paste functionalities are disabled for this page.");

                e.preventDefault();

            });       

        });
		
		document.onkeydown = function(e) {	
				if (e.ctrlKey && 
					(e.keyCode === 67 || 
					 e.keyCode === 86 || 
					 e.keyCode === 85 || 
					 e.keyCode === 117)) {
					return false;
				} else {
					return true;
				}
		};
		$(document).keypress("u",function(e) {
		 if(e.ctrlKey)
		 {
		return false;
		}
		else
		{
		return true;
		}
		});  */

     </script>

	
<!---    UserJs module/user.js  -->
@yield('userJs')
@yield('postJs')
@yield('planJs')

   
  </body>
</html>