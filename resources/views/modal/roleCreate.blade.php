<div class="modal-dialog" role="document">
	<div class="modal-content">
		<div class="modal-header py-1">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<form action="{{ url('create-role-permissions/') }}" method="POST" id="createUserRolePermission" >
			 @csrf
				
				<div class="form-group form-row-parent">
					<label class="col-form-label">Name<em>*</em></label>
					<div class="d-flex control-group">
						<input type="text" name="title" id="title" value="" class="form-control" placeholder="Role Name">									
					</div>	
					<div class="title_error errors"></div>	
				</div>
				
				<div class="form-group form-row-parent">
					<label class="col-form-label">Manage Permissions<em>*</em></label>
					<input type="button" id="checkAll" class="btn btn-primary btn-sm" value="Check All" name="select_all">
					<div class="clearfix"></div>
					@foreach($listPermission as $permission)
						<label class="col-form-label"><strong>{{$permission->name}}</strong></label>
						@foreach($permission->permissionList as $perm)
							
							<div class="form-check">
							  <input class="form-check-input" type="checkbox" name="permissions" id="permissions" value="{{$perm->id}}">
							  <label class="form-check-label" for="gridRadios1">
								{{$perm->name}}
							  </label>
							</div>
						@endforeach
						
					@endforeach
					<div class="permissions_error errors"></div>	
				</div>
				
				<div class="form-row mt-4">
					<div class="col-md-12">
						<button type="submit" class="btn btn-primary default btn-lg mb-2 mb-sm-0 mr-2 col-12 col-sm-auto">{{ trans('global.submit') }}</button>
						<div class="spinner-border text-primary request_loader" style="display:none"></div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>