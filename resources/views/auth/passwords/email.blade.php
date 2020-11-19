@extends('layouts.app')
@section('content')
 <div class="row h-100">
                <div class="col-12 col-md-8 col-lg-6 mx-auto my-auto">
                    <div class="card auth-card">
                        <div class="form-side">
                            <span class="logo_image d-block mb-3"><img src="<?php echo showSiteTitle("logo") ?>"></span>
							<?php  //pr($errors);?>
                            <h6 class="mb-4">{{ trans('global.forgot_password')}}</h6>
							@include('flash-message')
                            <form method="POST" action="{{ route('password.email') }}">
							 {{ csrf_field() }}
							  @php $cls = 'mb-4' @endphp 
							  @if(count($errors)>0)
								  @php $cls = 'mb-0' @endphp 
							  @endif
                                <label class="form-group has-float-label {{$cls}}">
                                   <input type="text" name="email" class="form-control">
									
                                    <span>{{ trans('global.E-mail') }}</span>
                                </label>
							
								    @if(count($errors)>0)
										<em class="invalid-feedback" style="display:block">
											{{ $errors->first('email') }}
										</em>
									@endif
								
								<div class="d-flex justify-content-between align-items-center">
                                    <a href="{{ route('login') }}">{{ trans('global.login') }}</a>
                                    
									<button type="submit" class="btn btn-primary btn-lg btn-shadow uppercase_button">
                                    {{ trans('global.reset_password') }}
                                </button>
								
                                </div>
								
                            </form>
                        </div>
                    </div>
                </div>
            </div>

@endsection