@extends('frontend.layouts.landing')
@section('pageTitle','Error')
@section('content')
<div class="content-section">
	<div class="container-fluid">
		<div class="row">
     
			Invalid user token provided. Please <a class="error_sign_in" href="https://mytrendingstories.com/auth/login">Sign In</a>.
		</div>
	</div>
</div>

	  @endsection