@extends('admin.layouts.admin')
@section('content')
	<div class="row">
		<div class="col-12">
			<h1>Roles </h1>
			@if(check_role_access('roles_create'))
			<span class="fl_right balance"><a id="create_role" class="btn btn-primary" href="javascript:void(0)">Create New Role</a></span>
			@endif
			<div class="separator mb-5"></div>
		</div>
	</div>
	<div class="row mb-4">
		<div class="col-12 mb-4">
		
			<?php /* @include('partials.searchCustomerForm') */ ?>
							
			<div class="card">
				<div class="card-body">
				<div class="table-responsive"  id="tag_container">
					 @include('admin.roles.rolesPagination')
				</div>
				</div>
			</div>

		</div>
	</div>
	<div class="modal fade modal-right roleEditModal"  tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
	</div>
	<div class="modal fade modal-top confirmBoxCompleteModal"  tabindex="-1" role="dialog"  aria-hidden="true"></div>
@section('userJs')
<script src="{{ asset('js/module/roles.js')}}"></script>	
@stop
@endsection