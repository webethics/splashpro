/*===================================
   SHOW ROLE DROPDOWN ON CREATE USER FORM BY AJAX 
==================================*/
//
$('#select_group').change(function(){
	var group_id = $(this).val(); 
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/user/roleDropdown',
		data: {_token:csrf_token,group_id:group_id},
        success: function(data) {
			 $("#role_box").empty().html(data); 
	
        },
		error :function( data ) {}
	});
	
})

/*==============================================
	SHOW USERS LISTING BY AJAX FOR CUSTOMER ADMIN AND DATA ADMIN WHEN USER ADD DATA ADMIN WILL SEE USER WITHOUT
	PAGE REFRESH VISE-VERSA
============================================*/
 function user_listing(){
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/users',
        data: {_token:csrf_token},
        success: function(data) {

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
	SEARCH FILTER FORM 
============================================*/
$(document).on('submit','#searchForm', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/users',
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

$(document).on('submit','#searchBusinessUsersForm', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/business-users',
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

$(document).on('click','#export_users', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/export_customers',
        data: {name:$('#name').val(),start_date:$('#start_date').val(),end_date:$('#end_date').val(),email:$('#email').val(),_token:csrf_token},
        success: function(data) {
			
			$('.search_spinloder').css('display','none');
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
				downloadLink.download = "Customers.csv";

				/*
					* Actually download CSV
				*/
				document.body.appendChild(downloadLink);
				downloadLink.click();
				document.body.removeChild(downloadLink);
			}
			
        },
		error :function( data ) {}
    });
});

$(document).on('click','#export_users_customers', function(e) {
    e.preventDefault(); 
	var user_id = $(this).data('id');
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/export_users_customers/'+user_id,
        data: {name:$('#name').val(),start_date:$('#start_date').val(),end_date:$('#end_date').val(),email:$('#email').val(),_token:csrf_token},
        success: function(data) {
			
			$('.search_spinloder').css('display','none');
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
				downloadLink.download = "Customers.csv";

				/*
					* Actually download CSV
				*/
				document.body.appendChild(downloadLink);
				downloadLink.click();
				document.body.removeChild(downloadLink);
			}
			  
			
        },
		error :function( data ) {}
    });
});


$(document).on('click','#export_main_users', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/export_users',
        data: {name:$('#name').val(),business_name:$('#business_name').val(),email:$('#email').val(),_token:csrf_token},
        success: function(data) {
			$('.search_spinloder').css('display','none');
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
				downloadLink.download = "Users.csv";

				/*
					* Actually download CSV
				*/
				document.body.appendChild(downloadLink);
				downloadLink.click();
				document.body.removeChild(downloadLink);
			}
			
		},
		error :function( data ) {}
    });
});

$(document).on('submit','#searchCustomerForm', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var user_id = $(this).attr('data-user_id');
	if(user_id){
		var sending_url = base_url+'/customers-listing/'+user_id;
	}else{
		var sending_url = base_url+'/customers';
	}
	
	$.ajax({
        type: "POST",
		//dataType: 'json',
        url: sending_url,
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
	ENABLE/DISABLE USER ACCOUNT 
============================================*/
$(document).on('click','input[type="checkbox"]', function(e) {
	
	if($(this).is(":checked")){
		var user_status = 1;
	}
	else if($(this).is(":not(:checked)")){
		var user_status = 0;
	}
	var user_id = $(this).attr('data-user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	$.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/user/enable-disable',
        data: {status:user_status,user_id:user_id,_token:csrf_token},
        success: function(data) {
             // IF TRUE THEN SHOW SUCCESS MESSAGE  
			 if(data.success){
				notification('Success','Account has been enabled.','top-right','success',4000);
				
			}else{
             notification('Error','Account has been disabled.','top-right','error',4000);
			}	
			
        },
		error :function( data ) {}
    });
	
})


/*==============================================
	SHOW EDIT REQUEST FORM 
============================================*/
$(document).on('click', '.editUser' , function() {
	

	var user_id = $(this).data('user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/user/edit/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){

				$('.userEditModal').html(data.data);
				$('.userEditModal').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
	
$(document).on('click', '.delete_user' , function() {
	var user_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/user/delete_user/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
				notification('Success','User deleted Successfully','top-right','success',2000);
				$('.user_row_'+user_id).hide();
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})
	
/*==============================================
	SHOW EDIT REQUEST FORM 
============================================*/
$(document).on('click', '.editCustomer' , function() {
	
	
	
				
	var user_id = $(this).data('user_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/customer/edit/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
			
				$('.customerEditModal').html(data.data);
				$('.customerEditModal').modal('show');
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
})
	
$(document).on('click', '.delete_customer' , function() {
	var user_id = $(this).data('id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/user/delete_customer/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
				notification('Success','Customer deleted Successfully','top-right','success',2000);
				$('.user_row_'+user_id).hide();
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})

/*==============================================
	UPDATE REQUEST FORM 
============================================*/
$(document).on('submit','#updateUser', function(e) {
    e.preventDefault(); 
	var user_id = $('#user_id').val();
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/update-profile/'+user_id,
        data: $(this).serialize(),
        success: function(data) {
			//alert(data)
			$('.errors').html('');
			$('.request_loader').css('display','none');
			// If data inserted into DB
			 if(data.success){
				 
				notification('Success','User Updated Successfully','top-right','success',2000);
				$('#business_name_'+user_id).text(data.business_name);
				$('#name_'+user_id).text(data.name);
				$('#mobile_number_'+user_id).text(data.mobile_number);
				$('#business_url_'+user_id).text(data.business_url);
				setTimeout(function(){ $('.userEditModal').modal('hide'); }, 2000);
			}	 
        },
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			//notification('Error','Please fill all the fields.','top-right','error',4000);
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
	UPDATE CUSTOMER REQUEST FORM 
============================================*/
$(document).on('submit','#updateCustomer', function(e) {
    e.preventDefault(); 
	var user_id = $('#user_id').val();
	$('.request_loader').css('display','inline-block');
    $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/update-customer/'+user_id,
        data: $(this).serialize(),
        success: function(data) {
			
			$('#name_'+user_id).text(data.name);
			$('#email_'+user_id).text(data.email);
			var my_number = data.code+'-'+data.mobile_number;
			$('#mobile_number_'+user_id).text(my_number);
			notification('Success','Customer Updated Successfully','top-right','success',2000);
			setTimeout(function(){ $('.customerEditModal').modal('hide'); }, 2000);
		},
		error :function( data ) {
         if( data.status === 422 ) {
			$('.request_loader').css('display','none');
			$('.errors').html('');
			//notification('Error','Please fill all the fields.','top-right','error',4000);
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
	