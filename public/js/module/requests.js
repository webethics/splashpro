/*==============================================
	SHOW EDIT REQUEST FORM 
============================================*/
$(document).on('click', '.viewDetail' , function() {
	
	
	var user_id = $(this).data('user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/view/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
			
				$('.viewDetailModal').html(data.data);
				$('.viewDetailModal').modal('show');
				var selectedVal = $('#selectedVal').val();
				if(selectedVal){
					$("#selected_code option[value="+selectedVal+"]").attr("selected","selected");
				}
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
});

/*view document request*/
$(document).on('click','.download_doc',function(e){
	var user_id = $(this).data('user_id');
	if(user_id != ''){
		$.ajax({
	        type: "GET",
			dataType: 'json',
	        url: base_url+'/check-exit-document/'+user_id,
	        success: function(response) {
				if(response.success){
					window.location =  base_url+'/download-user-document/'+user_id;
				}else{
					if(typeof (response.message) != 'undefined' && response.message != null && response.message != "")
						notification('Error',response.message,'top-right','error',3000);
					else
					notification('Error','Something went wrong.','top-right','error',3000);
				}	
	        },
	    });
	}else{
		notification('Error','Something went wrong.','top-right','error',3000);
	}
});

/*Approve request*/
$(document).on('click','#updateRequestUser .request_approve',function(e){
	event.preventDefault();
	$this = $(this);
	if(!$('#updateRequestUser .reason-area').hasClass("d-none")){
		$('#updateRequestUser .reason-area').addClass("d-none");
		$('#updateRequestUser .reason-area .reason_description').val("");
	}
	var ajax_url = $this.parents('#updateRequestUser').attr('action');
	var method = $this.parents('#updateRequestUser').attr('method');
	var status = 'approve';
	edit_request_update(ajax_url,method,status);
});

/*Disapprove request*/
$(document).on('click','#updateRequestUser .request_disapprove',function(e){
	event.preventDefault();
	$this = $(this);
	/*check reason textarea visible or not, if no then first visible it, So that admin add reason for disapprove*/
	if($('#updateRequestUser .reason-area').hasClass("d-none")){
		$('#updateRequestUser .reason-area').removeClass("d-none")
	}else{
		var ajax_url = $this.parents('#updateRequestUser').attr('action');
		var method = $this.parents('#updateRequestUser').attr('method');
		var status = 'disapprove';
		//check reason available or not
		var reason = $.trim($("#updateRequestUser .reason_description").val());
		if(reason != ""){
			edit_request_update(ajax_url,method,status);
		}else{
			$("#updateRequestUser .description_error").html('Please mention reason for'+status);
		}
	}
});

/*==============================================
	SEARCH FILTER FORM 
============================================*/
$(document).on('submit','#searchRequestForm', function(e) {
    e.preventDefault(); 
    $this = $(this);
	var ajax_url = $this.attr('action');
	var method = $this.attr('method');
	$('.search_spinloder').show();
    $.ajax({
        type: method,
        url: ajax_url,
        data: $(this).serialize(),
        success: function(data) {
			$('.search_spinloder').hide();
            //start date and end date error 
			if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);	
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
        },
		error :function( data ){
			$('.search_spinloder').hide();
			notification('Error','Something went wrong.','top-right','error',3000);
		}
    });
});

/*Export certificate request*/
$(document).on('click','#export_request', function(e) {
	 e.preventDefault(); 
	$('.search_spinloder').show();
	//var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/export_request_customers',
        data: $('#searchRequestForm').serialize(),
        success: function(data) {
			$('.search_spinloder').hide();
			if(data.success == false){
				notification('Error','No data found.','top-right','error',4000);	
			}else{
				var downloadLink = document.createElement("a");
				var fileData = ['\ufeff'+data];

				var blobObject = new Blob(fileData,{
					type: "text/csv;charset=utf-8;"
				});

				var url = URL.createObjectURL(blobObject);
				downloadLink.href = url;
				downloadLink.download = "Edit_requests_customer.csv";

				/*
					* Actually download CSV
				*/
				document.body.appendChild(downloadLink);
				downloadLink.click();
				document.body.removeChild(downloadLink);
			}
			
        },
		error :function( data ) {
			$('.search_spinloder').hide();
			notification('Error','Something went wrong.','top-right','error',3000);
		}
    });
});

/*Modify city dropdown on change of state*/
$(document).on('change','#state_id', function(e) {
	var state_id = $(this).val();
	getCityDropDown(state_id);
});

function getCityDropDown(state_id){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
		type: "POST",
		url: base_url+'/user/cityDropdown',
		data: {_token:csrf_token,state_id:state_id},
		success: function(data) {
			 $("#district_id").empty().html(data); 
		},
		error :function( data ) {}
	});
}

/*Send Edit request to user*/
function edit_request_update(ajax_action,method,status){
	$("#updateRequestUser .description_error").html();
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	/*show loader*/
	$('#updateRequestUser').find('.request_loader').show();
	var formData = $('#updateRequestUser').serializeArray();

	formData.push({ name: "status", value: status });
	formData.push({ name: "_token", value: csrf_token });

	$.ajax({
        type: method,
        url: ajax_action,
        data:formData,
        success: function(data) {
        	$('#updateRequestUser').find('.request_loader').hide();
        	if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);	
			}else if(data=='error'){
				notification('Error','Something went wrong, please try later.','top-right','error',4000);
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			 notification('Success','Successfully Update Edit Request.','top-right','success',4000);
			 setTimeout(function(){ $('.viewDetailModal').modal('hide'); }, 500);
			}
			/*if(response.success){
				$("#tag_container").empty().html(data); 
				setTimeout(function(){ $('.viewDetailModal').modal('hide'); }, 500);
			}else{
				if(typeof (response.message) != 'undefined' && response.message != null && response.message != "")
					notification('Error',response.message,'top-right','error',3000);
				else
				notification('Error','Something went wrong.','top-right','error',3000);
			}*/	
        },
        error:function(response){
	       	$('#updateRequestUser').find('.request_loader').hide();
	       	console.log('error');
	    }
    });
	

}