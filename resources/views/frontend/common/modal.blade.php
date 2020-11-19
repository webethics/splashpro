<!-- Modal -->
<div id="forget_modal" class="modal fade" role="dialog">
  <div class="modal-dialog"> 
    
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Restore Access</h4>
      </div>
	  <form method="POST" action="{{ route('login') }}" class="frm_class">
		 {{ csrf_field() }}
      <div class="modal-body">
        <p>Please enter the email to Reset Your Password.</p>
        <input class="form-control" type="email" name="email" id="email" placeholder="E-mail" required="">
		<div class="error_margin"><span class="email_error error" ></span></div>
		
      </div>
	 
      <div class="modal-footer">
        <button type="button" class="btn btn-default clear" >Cancel</button>
        <button type="button" class="btn btn-default" id="sendForget"><i class="fa fa-spinner fa-spin request_loader" style="display:none"></i> Send </button>
      </div>
	   </form>
    </div>
  </div>
</div>