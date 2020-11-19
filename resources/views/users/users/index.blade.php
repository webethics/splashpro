@extends('layouts.admin')
@section('content')
 <div class="row">
                <div class="col-12">
                    <h1>Business Listing</h1>
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
                                    <a href="{{ url('user/create') }}" class="btn btn-warning default  btn-xl mb-2">{{ trans('global.add_business_user') }}</a>
                                </div>
                            </div>						
                        </div>
                    </div>				
                    </div>
                    </div>
				    @include('partials.searchUserForm')		
									
					<div class="card">
						<div class="card-body">
						<div class="table-responsive"  id="tag_container">
							 @include('users.users.usersPagination')
						</div>
						</div>
					</div>

                </div>
            </div>
<div class="modal fade modal-right userEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
			 </div>
			 <div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@section('userJs')
<script src="{{ asset('js/module/user.js')}}"></script>	
@stop
@endsection