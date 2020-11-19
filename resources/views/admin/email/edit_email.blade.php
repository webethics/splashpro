@extends('admin.layouts.admin')
@section('content')
@section('ckeditor')
<script src="//cdn.ckeditor.com/4.13.1/standard/ckeditor.js"></script>
<script>
        CKEDITOR.replace( 'description',{
    allowedContent: true
} );
</script>
@stop
<div class="row">
<div class="col-12">
	<h1>Email Template</h1>
	<div class="separator mb-5"></div>
</div>
</div>
       <!-- Main content -->
				<div class="card">
				<div class="card-body">
				<div class="table-responsive"  id="tag_container">
				<div class="col-lg-12">
					<div class="box box-primary">
						<div class="box-body">
						  
							@include('flash-message')		
					        @foreach($result as $data)
							<div class ="user_profile" style="margin-bottom:30px">
								<h2 >{{ $data->title }}</h2>
							</div>

							{{ Form::open(array('url' => 'admin/email/update', 'method' => 'post','class'=>'profile form-horizontal')) }}


							<div class="form-group col-md-12">
								<div class="row">
									<div class="col-md-8 row col-xs-12">
										<div class="col-md-12 col-xs-12 field mb-4">
										{{ Form::label('title') }}
										{{ Form::text('title',$data->title,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('title')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Subject') }}
											{{ Form::text('subject',$data->subject,array('id'=>'subject','class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('subject')  }} </span>
										</div>
										<div class="clearfix"></div>
										<div class="col-md-12 col-xs-12 field mb-4">
											{{ Form::label('Description') }}
											{{ Form::textarea('description',$data->content,array('class'=>'form-control','placeholder'=>'')) }}
											<span class="error"> {{ $errors->first('description')  }} </span>
										</div>
										<div class="clearfix"></div>
									</div>

								</div>
							</div>


							<div class="form-group col-md-12">
								 <div class="sign-up-btn ">
									<input type="hidden" value="{{$data->id}}" name="email_id" id="email_id" >
									 <input name="login" class="loginmodal-submit btn btn-primary" id="profile_update" value="Update" type="submit">
									 <a href="{{url('admin/emails')}}" name="back" class="loginmodal-submit btn btn-primary" id="profile_back" value="Back" type="submit">Back</a>
								</div>
							</div>
							@endforeach
								  {{ Form::close() }}
					</div>
				</div>
			</div>
			</div>
			</div>
			</div>

	


  
    @stop
