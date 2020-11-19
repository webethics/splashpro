/*Remove temp request from user*/
$(document).on('click','.remove_temp_request',function(e){
	var user_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		url: base_url+'/remove-temp-request/'+user_id,
        data:{_token:csrf_token},
        success: function(data) {
			$('.user_response_update_db_1').hide('slow');
        }
    }); 
});

/*Remove temp request from user*/
$(document).on('click','.remove_cancel_request',function(e){
	var user_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		url: base_url+'/remove-cancel-request/'+user_id,
        data:{_token:csrf_token},
        success: function(data) {
        	if(data.success == true){
				$('.user_response_update_canceldb_1').hide('slow');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}
        },
        error :function( data ){
			$('.search_upgrade_spinloder').hide();
			notification('Error','Something went wrong.','top-right','error',3000);
		}
    }); 
});
	
	
	
	/*update basic info request*/
$(document).on('click','#update-basic-request',function(e){
	e.preventDefault();
	var $this = $(this);
	var user_id = $(this).data('id');
	var accountForm = $('#accountinfo');
	var ajax_url = accountForm.attr('action');
	var method = accountForm.attr('method');
	/*show loader*/
	accountForm.find('.request_loader').show();

	$.ajax({
       type:method,
       url:ajax_url,
       data:accountForm.serialize(),
        success:function(response){
       		accountForm.find('.request_loader').hide();
       		//disable button
       		$this.prop('disabled', true);
			if(response.success){
				if(typeof (response.message) != 'undefined' && response.message != null && response.message != ""){
					
					//notification('Success',response.message,'top-right','success',2000);
					
					$('#show_first_name').html($('#first_name').val());
					$('#show_last_name').html($('#last_name').val());
					$('#show_email').html($('#email').val());
					
					// $('#show_mobile_number').html($('#mobile_number').val());
					$('#show_address').html($('#address').val());
					$('#user_response_update_db').hide();$('#user_response_update_db_1').hide();
					$('#user_response_update').html(response.message).show();
					$('#user_response_update_1').html(response.message).show();
					$('#accountinfo').hide();
					$('#first_account_info').show();
				}else{
					
					$('#user_response_update').html(response.message);
					$('#user_response_update_1').html(response.message);
					notification('Success','Please wait your edit request has','top-right','success',2000);
				}	
			}else{
				if(typeof (response.message) != 'undefined' && response.message != null && response.message != "")
					notification('Error',response.message,'top-right','error',3000);
				else
				notification('Error','Something went wrong.','top-right','error',3000);
			}
        },
        error:function(response){
        	$this.prop('disabled', true);
			if( response.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			//notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(response.responseText);
            $.each(errors, function (key, value) {
                // console.log(key+ " " +value);
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) {                       
                        //console.log(key+ " " +value);	
					  var key = key.replace('.','_');
					  $('.'+key+'_error').show().append(value);
                    });
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
	      // 	accountForm.find('.request_loader').hide();
	       	//notification('Error','Something went wrong.','top-right','error',3000);
       }

    });

});


function showDiv(prefix,chooser) 
	{
		
		for(var i=1;i<=chooser;i++) 
		{
			var div = document.getElementById(prefix+i);
			div.style.display = 'none';
		}

		var selectedOption = chooser;

		if(selectedOption == "1")
		{
			displayDiv(prefix,"1");
			hideDiv(prefix,"2");
			hideDiv(prefix,"3");
			hideDiv(prefix,"4");
			
		}
		if(selectedOption == "2")
		{
			displayDiv(prefix,"1");
			displayDiv(prefix,"2");
			hideDiv(prefix,"3");
			hideDiv(prefix,"4");
			
		}
		if(selectedOption == "3")
		{
			displayDiv(prefix,"1");
			displayDiv(prefix,"2");
			displayDiv(prefix,"3");
			hideDiv(prefix,"4");
		}
		if(selectedOption == "4")
		{
			displayDiv(prefix,"1");
			displayDiv(prefix,"2");
			displayDiv(prefix,"3");
			displayDiv(prefix,"4");
		}
    }

    function displayDiv(prefix,suffix) 
    {
		var div = document.getElementById(prefix+suffix);
		div.style.display = 'block';
    }
	 function hideDiv(prefix,suffix) 
    {
		var div = document.getElementById(prefix+suffix);
		div.style.display = 'none';
    }