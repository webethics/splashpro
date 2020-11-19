@extends('layouts.app')
@section('content')
			<div class="row h-100">
                <div class="col-12 col-md-8 col-lg-6 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="form-side">
                            <a href="Dashboard.Default.html">
                                <span class="logo d-block mb-3"></span>
                            </a>
                           
							@if(\Session::has('message'))
								<p class="alert alert-success">
									{{ \Session::get('message') }}
								</p>
							@endif
							@if(\Session::has('error'))
							 <div class="error_margin"><span class="error"> {{ \Session::get('error') }} </span></div>
							@endif
                            <form method="POST" action="{{url('send_otp')}}" class="frm_class">
							 {{ csrf_field() }}
                                <label class="has-float-label 	@if(!\Session::has('errors')) form-group mb-4 @else labelcls @endif">
                                  <input name="otp" type="text" class="form-control">
                                    <span>{{ trans('global.otp') }}</span>
                                </label>
								<div class="error_margin"><span class="error" >  {{ $errors->first('otp')  }} </span></div>

                                <div class="d-flex justify-content-between align-items-center">
                                  
                                    
									<input type="submit" class="btn btn-primary btn-lg btn-shadow uppercase_button" value='{{ trans('global.submit') }}'>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection