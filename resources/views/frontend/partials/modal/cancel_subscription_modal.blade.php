<div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header confirm">
		 <div class="header-cont1">
						 Cancel Subscription 
						  </div>
		
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
         </div>
         <div class="modal-body">
			<h4 class="modal-title" id="myModalLabel">If you do cancel today, you will still be able to see content until your subscription ends on the {{ Carbon\Carbon::parse($subscription_data->subscription_end)->format('l jS \\of F Y') }} </h4>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
            <button type="button" class="btn btn-primary cancel_subscription" data-subscription_id="{{$subscription_data->id}}" id=""><i class="fa fa-spinner fa-spin loader_cancel_subscription" style="display:none"></i> Yes</button>
			<input type="hidden" name="_token" value="{{ csrf_token() }}">
         </div>
      </div>
</div>