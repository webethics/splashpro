<div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header confirm">
		 <div class="header-cont1">
						 Delete Post 
						  </div>
		
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
			<h4 class="modal-title" id="myModalLabel">Are you sure you wish to delete your post?</h4>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary delete_post" data-post_id="{{$post_id}}" id=""><i class="fa fa-spinner fa-spin loader_delete_post" style="display:none"></i> Yes</button>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
         </div>
      </div>
</div>