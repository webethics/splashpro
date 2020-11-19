@extends('admin.layouts.master')
@section('content')
    <div class="wrapper">
      <!-- Main Header -->
     @include('admin.common.admin_header')
      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.common.sidebar')
        @include('admin.common.confirm')
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
       @include('admin.common.breadcrumb')
        <!-- Main content -->

		<section class="content usr-contnt">
			<div class="row">
				<!--a href="#" data-toggle="modal" data-target="#signup-next" data-dismiss="modal" class="loginmodal-submit">Next</a-->
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-body">
							@if(Session::has('success'))
								<div class="success-msg">
								   {{Session::get('success')}}
								</div>
					        @endif
							@if(Session::has('error'))
								<div class="error-msg">
								   {{Session::get('error')}}
								</div>
					        @endif
							<div class ="user_profile" style="margin-bottom:30px">
								<h2 >Add New Email Template</h2>
							</div>

							{{ Form::open(array('url' => 'admin/email/add', 'method' => 'post','class'=>'profile form-horizontal','enctype'=>'multipart/form-data')) }}
							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field">
											{{ Form::label('Title') }}
											{{ Form::text('title', '' ,array('id'=>'title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>

										<div class="col-md-12 col-xs-12 field">
											{{ Form::label('Subject') }}
											{{ Form::text('subject', '' ,array('id'=>'subject','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('subject')  }} </span>
										</div>

										
										<div class="clearfix"></div>

										<div class="col-md-12 col-xs-12 field">
											{{ Form::label('Message Body') }}
											{{ Form::textarea('description','',array('id'=>'title','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description') }} </span>
										</div>


									</div>

								</div>
							</div>

							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									 <input name="login" class="loginmodal-submit btn btn-primary" id="profile_update" value="Submit" type="submit">
									 <a href="{{url('admin/email')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
								</div>
							</div>
								  {{ Form::close() }}
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>

    <script>
        CKEDITOR.replace( 'description',{
		    allowedContent: true
		} );
    </script>

 @stop
