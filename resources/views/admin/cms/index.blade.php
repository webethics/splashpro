@extends('admin.layouts.admin')
@section('content')
<div class="row">
	<div class="col-12">
		<h1>CMS Pages</h1>
		<div class="separator mb-5"></div>
	</div>
</div>
            <div class="row mb-4">
                <div class="col-12 mb-4">
				<div class="row">
					<div class="col-md-12 mb-4">
					<div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <a href="{{ url('admin/cms-pages/create/') }}" class="btn btn-primary default  btn-xl mb-2">{{ trans('global.add_cms_page') }}</a>
                                </div>
                            </div>						
                        </div>
                    </div>				
                    </div>
                    </div>
				   
									
					<div class="card">
						<div class="card-body">
						<div class="table-responsive"  id="tag_container">
							 <table class="table table-hover mb-0">
								<thead class="bg-primary">
									<tr>
									<th scope="col">#No.</th>
									<th scope="col">{{ trans('global.title') }}</th>
									<th scope="col">{{ trans('global.slug') }}</th>
										
									<th scope="col">{{ trans('global.actinos') }}</th>								
									</tr>
								</thead>
								<tbody>
								 @if(is_object($CmsPage) && !empty($CmsPage) && $CmsPage->count())
									 @php $i=1;  @endphp
								  @foreach($CmsPage as $key => $page)
									<tr data-user-id="{{ $page->id }}" class="user_row_{{$page->id}}" >
										<td id="name_{{$page->id}}">{{$i}}</td>
										<td id="name_{{$page->id}}">{{ $page->title ?? '' }} </td>
										<td id="email_{{$page->id}}"> {{ $page->slug  ?? '' }}</td>
										
										

										<td>
										
											<a class="action" href ="{{url('admin/cms-pages/edit/')}}/{{$page->id}}" title="Edit"><i class="simple-icon-note"></i></a>
											
											<a title="Delete Page"  data-id="{{ $page->id }}" data-confirm_type="complete" data-confirm_message ="Are you sure you want to delete the Page?"  data-left_button_name ="Yes" data-left_button_id ="delete_page" data-left_button_cls="btn-primary" class="open_confirmBox action deletePage"  href="javascript:void(0)" data-role_id="{{ $page->id }}"><i class="simple-icon-trash"></i></a>
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
			<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
<div class="modal fade modal-right userEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
 </div>
@section('userJs')
<script src="{{ asset('js/module/page.js')}}"></script>	
@stop
@endsection