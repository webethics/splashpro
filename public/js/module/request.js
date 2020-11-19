/*=========================================
	ADD REQUEST FORM START
============================================*/
// Create request Form Add more filds  
$(document).on('click', '.add-more' , function() {
	    //loadjscssfile("http://laravel.work6/css/vendor/select2.min.css", "css") 
	  //loadjscssfile("http://laravel.work6/js/vendor/select2.full.js", "js") 
	 
		// Add more Social Fiedls 
    	 if($(this).attr('data-social')=='yes'){
		
			if($(this).parents('.social_box_div').hasClass('social_box_div')){
				
				var number = $(this).parents('.social_box_div').attr('data-number'); 
				var nextfields = parseInt(number)+1;
				$(this).parents('.social_box_div').attr('data-number',nextfields);
				
				// Social Type and Error
				var socialType_Error = $(this).parents('.social_box_div').find('select').parent().attr('data-fieldnameForError'); 
				var social_type= $(this).parents('.social_box_div').find('select').attr('name');
				// Social Name and Error
				var socialName_Error = $(this).parent().attr('data-fieldnameForError'); 
				var social_name =$(this).prev().attr('name');
	
				var ht ='<div class="form-row control-group after-add-more social_box_div" data-number="'+nextfields+'">\
				<div class="col-md-6 mb-3">\
				<div class="form-group mb-0" data-fieldnameForError="social_type">\
					<select id="inputState" name="'+social_type+'" class="form-control select2-single" data-width="100%">\
						<option value="" selected>Choose...</option>\
						<option value="facebook">Facebook</option>\
						<option value="twitter">Twitter</option>\
						<option value="likndin">likndin</option>\
					</select>\
				</div>\
				<div class="'+socialType_Error+'_'+nextfields+'_error errors"></div>\
				</div>\
				<div class="col-md-6 mb-3">\
			<div class="form-group mb-0 d-flex" data-fieldnameForError="social_name">\
				<input type="text" class="form-control" name="'+social_name+'">\
				<button class="btn btn-light remove" type="button" 		data-social="yes">-</button></div>\
				<div class="'+socialName_Error+'_'+nextfields+'_error errors"></div></div></div>\
                ';
					    
				$(this).parents('.addmore_field').append(ht);	
			}	 
		 }else{
			 // Add more fiedls 
			var number = $(this).parent().attr('data-number'); 
			var nextfields = parseInt(number)+1;
			$(this).parent().attr('data-number',nextfields);
			var fieldnameForError = $(this).parent().attr('data-fieldnameForError'); 
			var placehlder =$(this).prev().attr('placeholder');
			var name =$(this).prev().attr('name');
			var ht = '<div class="control-group d-flex mt-3" data-number="'+nextfields+'"><input type="text" class="form-control" name="'+name+'" placeholder="'+placehlder+'"><button class="btn btn-light remove" type="button">-</button></div><div class="'+fieldnameForError+'_'+nextfields+'_error errors"></div>';

				$(this).parents('.addmore_field').append(ht);
		 }
		
});

// Remove Add more fiedls from form 
$(document).on('click', '.remove' , function() {
	var removefiedls, _hasClassError, _removeFields;
	if($(this).attr('data-social')=='yes'){
		/* Total number of cloned fields*/
		removefiedls =  parseInt($(this).parents('.social_box_div').attr('data-number'))-1; 
		_hasClassError = $(this).parent().next(); 
		_removeFields = $(this).parents('.social_box_div');
	}else{
		removefiedls =  parseInt($(this).parent().attr('data-number'))-1; 
		/* if single error class the below code line will work */
		if($(this).parent().next().hasClass('errors'))$(this).parent().next().remove();
		_removeFields = $(this).parent();
	}	 
	/* Updating total number of fields count into the HTML element */
	$(this).parents('.addmore_field').children(':first-child').attr('data-number',removefiedls);
	/* The below code line is being used for to remove the Error text and Field of Cloned items where 2 fields will cloned simulteniously */
	_removeFields.remove();
	
})


// Add Request form Ajax 
$('#addRequest').on('submit', function(e) {
    e.preventDefault(); 
	$('.spinner-border').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/requests/store',
        data: $(this).serialize(),
        success: function(data) {
			$('.errors').html('').hide();
			$('.spinner-border').css('display','none');
			// If data inserted into DB
			if(data.success){
				notification('Success','Request Submitted Successfully','top-right','success',4000);
				$("#addRequest")[0].reset();
				setTimeout(function(){ window.location.href=base_url+'/requests' }, 4000);
			}		
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.spinner-border').css('display','none');
			$('.errors').html('').hide();
			//$('.errors').('');
			notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
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
		}

    });
});

/*==============================================
	ADD REQUEST FORM END
============================================*/


/*==============================================
	SHOW EDIT REQUEST FORM 
============================================*/
$(document).on('click', '.editRequest' , function() {
	var request_id = $(this).data('request_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/requests/edit/'+request_id,
        data: {_token:csrf_token,request_id:request_id},
        success: function(data) {
			if(data.success){
				$('.requestEditModal').html(data.data);
				$('.requestEditModal').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
	
	
/*==============================================
	UPDATE REQUEST FORM 
============================================*/
$(document).on('submit','#updateRequest', function(e) {
    e.preventDefault(); 
	var request_id = $('#request_id').val();
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/requests/update/'+request_id,
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			 if(data.success){
				 
				notification('Success','Request Submitted Successfully','top-right','success',2000);
				//$("#addRequest")[0].reset();
				$('#row_'+request_id).text(data.priority);
				setTimeout(function(){ $('.requestEditModal').modal('hide'); }, 2000);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
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
		}

    });
});

/*==============================================
	SHOW REQUEST LISTING BY AJAX FOR ALL ROLES 
==================================================*/

function request_listing(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/requests',
        data: {_token:csrf_token},
        success: function(data) {
             //start date and end date error 
			 if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);
				
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
			
        },
		error :function( data ) {}

    });
}

/*==============================================
	SHOW COMPLETED REQUESTS IN REPORTS SECTION BY AJAX SOHW THAT IF REQUEST IS COMPLETED THEN 
SHOW ON USER END IN REPROTS WITHOUT REFRESH THE PAGE 	
==================================================*/

function complete_request_listing(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/reports',
        data: {_token:csrf_token},
        success: function(data) {
             //start date and end date error 
			 if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);
				
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
			
        },
		error :function( data ) {}

    });
}

/*==============================================
	REQUEST SEARCH FILTER FORM 
============================================*/

$(document).on('submit','#searchForm', function(e) {
    e.preventDefault(); 
	var request_id = $('#request_id').val();
	$('.search_spinloder').css('display','inline-block');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/requests',
        data: $(this).serialize(),
        success: function(data) {
			 $('.search_spinloder').css('display','none');
             //start date and end date error 
			 if(data=='date_error'){
			 
				notification('Error','Start date not greater than end date.','top-right','error',4000);
				
			}else{
             // Set search result
			 $("#tag_container").empty().html(data); 
			}	
			
        },
		error :function( data ) {}

    });
});


/*==============================================
	ASSIGN REQUEST TO ANALYST (POPUP) 
============================================*/
$(document).on('click', '.requestAssignModal' , function() {
	var request_id = $(this).data('request_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/assignModal',
        data: {_token:csrf_token,request_id:request_id},
        success: function(data) {
			if(data.success){
				$('.requestAssign').html(data.data);
				$('.requestAssign').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
	
/*======================================================
	ASSIGN REQUEST TO ANALYST MODAL (POST) UPDATE DATA  
=========================================================*/
$(document).on('submit','#assignRequest', function(e) {
    e.preventDefault(); 
	var request_id = $('#request_id').val();
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/assign',
        data: $(this).serialize(),
        success: function(data) {
			$('.request_loader').css('display','none');
			// If data inserted into DB
			 if(data.success){
				 
				notification('Success','Request Submitted Successfully','top-right','success',2000);
				$("#assigned_to_"+request_id).html(data.assigned_to);
				$("#status_"+request_id).removeClass(data.old_class).addClass(data.new_class).html(data.new_status);
				$("#assign_icon_"+request_id).remove();
				
				$("#assigned_by_"+request_id).html(data.assigned_by);

				setTimeout(function(){ $('.requestAssign').modal('hide'); }, 2000);
			}}
		

    });
});

/*======================================================
	ANALYST REPORT SUBMITED 
=========================================================*/
/* $('#submitAnalystReport').on('submit', function(e) {
    e.preventDefault(); 
	var request_id = $('#request_id').val();
	$('.spinner-border').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/analyst/report',
        data: $(this).serialize(),
        success: function(data) {
			$('.errors').html('');
			$('.spinner-border').css('display','none');
			// If data inserted into DB
			if(data.success){
				notification('Success','Request Submitted Successfully','top-right','success',4000);
				$("#addRequest")[0].reset();
				setTimeout(function(){ window.location.href=base_url+'/requests' }, 4000);
			}		
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.spinner-border').css('display','none');
			$('.errors').html('');
			notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
            $.each(errors, function (key, value) {
                if($.isPlainObject(value)) {
                    $.each(value, function (key, value) {                       
					  var key = key.replace('.','_');
					  $('.'+key+'_error').show().append(value);
                    });
                }else{
                // $('#response').show().append(value+"<br/>"); //this is my div with messages
                }
            }); 
          }
		}

    });
}); */
  
/*======================================================
	REPORT SUBMIT BY DROPZONE AND BY COMMENT 
=========================================================*/
//if ($().dropzone && !$(".dropzone").hasClass("disabled")) {
var accept = ".png,.jpg,.jpeg,.gif,application/pdf,.doc,.docx,.xls,.xlsx,.csv,.ppt,.pptx,.odt";
$(".dropzone").dropzone({
	uploadMultiple: true,
	autoProcessQueue:false,
	parallelUploads: 5,
	addRemoveLinks: false,
	acceptedFiles: accept,
	url: base_url+"/analyst/report",
	maxFiles: 5,
    /* maxfilesexceeded: function(file) {
    this.removeAllFiles();
    this.addFile(file);
   }, */
	init: function() {

    var totalFiles = 0,
	completeFiles = 0;
	this.on("addedfile", function (file) {
		totalFiles += 1;
	});
	this.on("removed file", function (file) {
		totalFiles -= 1;
	});
    // Check file type error 
	this.on('error', function(file, response) {
		//console.log(file)
		//console.log(response);
		var errorMessage ;
		if(response.errorMessage == undefined) errorMessage = response;
		else  errorMessage = response.errorMessage;
		//console.log('errorMessage:'+errorMessage);
		$('.file_error').html(errorMessage);
		$(file.previewElement).find('.dz-error-message').text(errorMessage);
		this.removeFile(file);
	});
	// Check if file uploaded exceded.
	this.on("maxfilesexceeded",function(file)
    {
		$('.file_error').html('You cannot upload more than 5 file at a time.'); 
		this.removeFile(file);
    });
	
	
    var submitButton = document.querySelector("#submitAnalystReport")
    myDropzone = this;
	
    submitButton.addEventListener("click", function() {
		// Send extra data with form 
		myDropzone.on("sending", function(file, xhr, formData) {
		var request_id = $('#request_id').val();			
		var comment = $('#comment').val();			
		var request_status = $('.request_status').val();			
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		formData.append("comment",comment); 
		formData.append("request_id",request_id); 
		formData.append("request_status",request_status); 
		formData.append("_token", csrf_token); 
    });
	
     /* Validation for file and comment */
	 var comment = $('#comment').val();
     if(comment=='')
	 {      
        $('.comment_error').html('Comment are required.')
		$('.file_error').html('');	   
        return false;
     }else if(myDropzone.getUploadingFiles().length === 0 && myDropzone.getQueuedFiles().length === 0 ) 
	 {
		  $('.comment_error').html('')	  
		  $('.file_error').html('No file selected for upload.')	   
        return false;
	  }
      else{
        /* Remove event listener and start processing */ 
		$('.file_error').html('')	
        $('.comment_error').html('');	   		
        myDropzone.removeEventListeners();
        myDropzone.processQueue(); 
        
      }
    });
    
    /* On Success, do whatever you want */
    this.on("success", function(file, responseText) {
        this.removeAllFiles();
	    completeFiles += 1;
       if (completeFiles === totalFiles) {
		// ADD ROWS IN LIST OF FILES 
	   $('.errors').remove();
	   $('#comment').val('');
	   
	   $('.complete_button').show('slow');	  //SHOW COMPLETE BUTTON 
	   $('#request_detail').removeClass().addClass('col-sm-9');	  //SHOW COMPLETE BUTTON 
	   $('#attachment_file_liding tbody:first').prepend(responseText.attachment_files)
	   window.location.reload();
	   if(responseText.success){
		notification('Success','Report Uploaded Successfully','top-right','success',4000);
	   }
	   //IF ADMIN/SUPER ADMIN 
	  
	   if(responseText.admin){
		
		$("#status_change").html(responseText.status);
		$(".request_status").removeClass(responseText.remove_cls);
		$(".request_status").addClass(responseText.status_cls);
		$(".complete_button").show();
	   } 
      // alert('Success');
	    }
    });
   }  ,
   thumbnailWidth: 160,
        previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row"><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail="" class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i>	</div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name=""></span></div><div class="text-primary text-extra-small" data-dz-size=""></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div><div class="dz-error-message"><span data-dz-errormessage=""></span></div></div><a href="#/" class="remove" data-dz-remove=""><i class="glyph-icon simple-icon-trash"></i></a></div></div>'
      
 });
 //}
 

/*======================================================
	COMPLETE THE REPORT WHEN CONFIRM 
=========================================================*/
 $(document).on('click','#complete_report', function(e) {
	 
    e.preventDefault(); 
	var request_id = $('#open_confirmBox').data('id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$('.search_spinloder').css('display','inline-block');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/report/complete',
        data: {request_id:request_id,_token:csrf_token},
        success: function(data) {
			// If data inserted into DB
			if(data.success){
				notification('Success','Request Completed Successfully','top-right','success',4000);
				$('.search_spinloder').css('display','none');
				//IF ADMIN/SUPER ADMIN 
				$("#status_change").html(data.status);
				$(".request_status").removeClass(data.remove_cls);
				$(".request_status").addClass(data.status_cls);
				$("#completed_at").html(data.completed_at); 
				$(".complete_button").hide();
				
				// IF ANALYST 
				if(!data.admin){		
					 $("#report_form").hide();
					 $(".remove_column").remove();
					 $("#actions").remove();
				}

			}else{
				notification('Error','No Report Found. Please Upload Reprot first.','top-right','Error',4000);
			}		
        },
		error :function( data ) {
         if( data.status === 422 ) { }
		}

    });
}); 

/*======================================================
	DELETE REPORT FILE BY ATTACHMENT ID 
======================================================*/
 $(document).on('click','#delete_file', function(e) {
    e.preventDefault(); 
	var attachment_id = $(this).data('id');
	//alert(attachment_id)
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/delete/reportFile',
        data:{attachment_id:attachment_id,_token:csrf_token},
        success: function(data) {
			$('#attachment_id_'+attachment_id).hide('slow');
			if(data.success){				
				notification('Sucess','File Deleted Successfully','top-right','success',4000);
				// CHANGE STATUS AND SHOW COMPLETE AS MARK BUTTON IF ADMIN DELETE FILES
				if(data.admin){
				$("#status_change").html(data.status);
				$(".request_status").removeClass(data.remove_cls);
				$(".request_status").addClass(data.status_cls);
				$(".complete_button").show();
			   }
			}
        }
    }); 
});
 
 
/*======================================================
	REOPEN AND ASSIGN TO ANALYST EXISTING 
======================================================*/
 $(document).on('click','.status_reopen ', function(e) {
    e.preventDefault(); 
	var request_id = $(this).data('id');
	//alert(request_id)
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/status/change',
        data:{request_id:request_id,_token:csrf_token},
        success: function(data) {
	
			if(data.success){				
				notification('Sucess','Request is Reopened and Assigned to analyst.','top-right','success',5000);
				// CHANGE STATUS AND SHOW COMPLETE AS MARK BUTTON IF ADMIN DELETE FILES
				$('#change_status_icon_'+request_id).hide();
				if(data.admin){
		        $("#status_"+request_id).html(data.status);
		        $("#status_"+request_id).removeClass(data.remove_cls);
		        $("#status_"+request_id).addClass(data.status_cls);
				
			   }
			}
        }
    }); 
}); 


/*==============================================
	OPEN CLARIFICATION MODAL (POPUP) 
============================================*/
$(document).on('click', '.clarificationModalOpen' , function() {
	var request_id = $(this).data('request_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/clarificationModal',
        data: {_token:csrf_token,request_id:request_id},
        success: function(data) {
			if(data.success){
				$('.clarificationModal').html(data.data);
				$('.clarificationModal').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})

/*==============================================
	UPDATE REQUEST FORM 
============================================*/
$(document).on('submit','#clarificationRequest', function(e) {
    e.preventDefault(); 
	var request_id = $('#request_id').val();
	//$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/clarification',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			//$('.request_loader').css('display','none');
			// If data inserted into DB
			 if(data.success){
				 
				notification('Success','Request Submitted for Clarification Successfully','top-right','success',2000);
				
				$("#status_change").html(data.status);
				$("#clarificationBox").hide();
				$(".request_status").removeClass(data.remove_cls);
				$(".request_status").addClass(data.status_cls);
				$("#completed_at").html(data.completed_at); 
				setTimeout(function(){ $('.clarificationModal').modal('hide'); }, 2000);
				
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
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
		}

    });
});



/*==============================================
	OPEN CLARIFICATION MODAL (POPUP) 
============================================*/
$(document).on('click', '.openCommentModal' , function() {
	var comment_id = $(this).data('comment_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/showComment',
        data: {_token:csrf_token,comment_id:comment_id},
        success: function(data) {
			if(data.success){
				$('.EditComment').html(data.data);
				$('.EditComment').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})

/*==============================================
	UPDATE Comment  
============================================*/
$(document).on('submit','#updateComment', function(e) {
    e.preventDefault(); 
	var comment_id = $('#comment_id').val();
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/request/updateComment',
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			 if(data.success){
				 
				notification('Success','Comment Updated Successfully','top-right','success',2000);
				$("#comment_"+comment_id).html(data.comment);
				
				setTimeout(function(){ $('.EditComment').modal('hide'); }, 2000);
				
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			notification('Error','Please fill all the fields.','top-right','error',4000);
            var errors = $.parseJSON(data.responseText);
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
		}
    });
});


/*==============================================
	SHOW ASSIGNED REQUESTS IN REPORTS SECTION BY AJAX
	SOHW THAT IF REQUEST IS ASSIGNED THEN
	SHOW ON USER END IN REPROTS WITHOUT REFRESH THE PAGE 	
==================================================*/
function analyst_request_listing(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/analysts',
        data: {_token:csrf_token},
        success: function(data) {
             //start date and end date error
			 if(data=='date_error'){
				notification('Error','Start date not greater than end date.','top-right','error',4000);
			}else{
             // Set search result
			 $("#tag_container").empty().html(data);
			}	
        },
		error :function( data ) {}
    });
}

const ps = new PerfectScrollbar('#custom-comment-scrollbar');
 /*======================================================
	IF COMPLETE THE  REPORT BY SWITCH BUTTON CHNAGE THE VALUE ON CHECKBOX  
=========================================================*/
/*  $(document).on('click','input[name="request_status"]', function(e) {
	
	if($(this).is(":checked")){
		var request_status = 3;
	}
	else if($(this).is(":not(:checked)")){
		var request_status = 2;
	}
	// Change the request status value 
    $(this).val(request_status);
   
 }); */

/* $('#reprot-Dropzone').on('submit', function(e) {
    e.preventDefault(); 
	
	$('.spinner-border').css('display','inline-block');
	
      myDropzone.processQueue();
}); */



/* var total_photos_counter = 0;
	Dropzone.options.myDropzone = {
		uploadMultiple: true,
		parallelUploads: 2,
		maxFilesize: 16,
		previewTemplate: document.querySelector('#preview').innerHTML,
		addRemoveLinks: true,
		dictRemoveFile: 'Remove file',
		dictFileTooBig: 'Image is larger than 16MB',
		timeout: 10000,
	    url: "http://laravel.work6/analyst/report",
		init: function () { alert()

			
			this.on("removedfile", function (file) {
				alert();
				$.post({
					url: '',
					data: {id: file.name, _token: $('[name="_token"]').val()},
					dataType: 'json',
					success: function (data) {
						total_photos_counter--;
						$("#counter").text("# " + total_photos_counter);
					}
				});
			});
		},
		success: function (file, done) {
			alert('1212');
			total_photos_counter++;
			$("#counter").text("# " + total_photos_counter);
		}
	};  */ 



