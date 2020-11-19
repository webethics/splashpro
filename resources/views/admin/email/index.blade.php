@extends('admin.layouts.admin')
@section('content')
<div class="row">
	<div class="col-12">
		<h1>Emails</h1>
		<div class="separator mb-5"></div>
	</div>
</div>
            <div class="row mb-4">
                <div class="col-12 mb-4">
				<!--div class="row">
					<div class="col-md-12 mb-4">
					<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ url('user/create') }}" class="btn btn-warning default  btn-xl mb-2">{{ trans('global.add_user') }}</a>
                                </div>
                            </div>						
                        </div>
                    </div>				
                    </div>
                    </div-->
				   
									
					<div class="card">
						<div class="card-body">
						<div class="table-responsive"  id="tag_container">
							 <table class="table table-hover mb-0">
								<thead class="bg-primary">
									<tr>
									<th scope="col">#No.</th>
									<th scope="col">{{ trans('global.title') }}</th>
									<th scope="col">{{ trans('global.subject') }}</th>
										
									<th scope="col">{{ trans('global.actinos') }}</th>								
									</tr>
								</thead>
								<tbody>
								 @if(is_object($emailTemplate) && !empty($emailTemplate) && $emailTemplate->count())
									 @php $i=1;  @endphp
								  @foreach($emailTemplate as $key => $email)
									<tr data-user-id="{{ $email->id }}" >
										<td id="name_{{$email->id}}">{{$i}}</td>
										<td id="name_{{$email->id}}">{{ $email->title ?? '' }} </td>
										<td id="email_{{$email->id}}"> {{ $email->subject  ?? '' }}</td>
										
										

										<td>
										@if(check_role_access('email_edit'))
											<a class="action" href ="{{url('admin/email/edit')}}/{{$email->id}}" title="Edit"><i class="simple-icon-note"></i></a>
										@endif
										</td>
									</tr>
									@php $i++;  @endphp
								 @endforeach
								@else
									<tr><td colspan="7" class="error" style="text-align:center">No Data Found.</td></tr>
								@endif	
								</tbody>
							</table> 
						</div>
						</div>
					</div>
                </div>
            </div>
<div class="modal fade modal-right userEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
 </div>
@section('userJs')
<script src="{{ asset('js/module/user.js')}}"></script>	
@stop
@endsection