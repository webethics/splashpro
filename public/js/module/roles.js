	
/*==============================================
	SHOW EDIT Role FORM 
============================================*/
$(document).on('click', '.editRole' , function() {
	var role_id = $(this).data('role_id');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/roles/edit/'+role_id,
        data: {_token:csrf_token,role_id:role_id},
        success: function(data) {
			if(data.success){
			
				$('.roleEditModal').html(data.data);
				$('.roleEditModal').modal('show');
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
	
/*==============================================
	SHOW Create Role FORM 
============================================*/
$(document).on('click', '#create_role' , function() {
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "GET",
		dataType: 'json',
        url: base_url+'/role/create/',
        data: {},
        success: function(data) {
			if(data.success){
			
				$('.roleEditModal').html(data.data);
				$('.roleEditModal').modal('show');
				$('.errors').html('');
			}else{
				notification('Error','Something went wrong.','top-right','error',3000);
			}	
        },
    });
})

$(document).on('submit','#createUserRolePermission', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var permissions = [];
	$.each($("input[name='permissions']:checked"), function(){
		permissions.push($(this).val());
	});
	console.log(permissions);
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/create-role-permissions',
        data: {_token:csrf_token,permissions:permissions,title:$('#title').val()},
        success: function(data) {
			 $('.search_spinloder').css('display','none');
            notification('Success','User Updated Successfully','top-right','success',2000);
			setTimeout(function(){ $('.roleEditModal').modal('hide'); }, 2000);
			setTimeout(function(){window.location.href = base_url+'/roles'; }, 2500);
			
        },
		error :function( data ) {
			 if( data.status === 422 ) {
				$('.request_loader').css('display','none');
				$('.errors').html('');
				//notification('Error','Please fill all the fields.','top-right','error',4000);
				var errors = $.parseJSON(data.responseText);
				$.each(errors, function (key, value) {
					if($.isPlainObject(value)) {
						$.each(value, function (key, value) {                       
							var key = key.replace('.','_');
							$('.'+key+'_error').show().append(value);
						});
					}else{
					
					}
				}); 
			  }
		}
    });
});

$(document).on('submit','#editUserRolePermission', function(e) {
    e.preventDefault(); 
	$('.search_spinloder').css('display','inline-block');
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	var permissions = [];
	$.each($("input[name='permissions']:checked"), function(){
		permissions.push($(this).val());
	});
	var role_id = $('#role_id').val();
    $.ajax({
        type: "POST",
		//dataType: 'json',
        url: base_url+'/update-role-permissions',
        data: {_token:csrf_token,permissions:permissions,title:$('#title').val(),role_id:role_id},
        success: function(data) {
			 $('.search_spinloder').css('display','none');
            notification('Success','User Updated Successfully','top-right','success',2000);
			setTimeout(function(){ $('.roleEditModal').modal('hide'); }, 2000);
			setTimeout(function(){window.location.href = base_url+'/roles'; }, 2500);
        },
		error :function( data ) {
			 if( data.status === 422 ) {
				$('.request_loader').css('display','none');
				$('.errors').html('');
				//notification('Error','Please fill all the fields.','top-right','error',4000);
				var errors = $.parseJSON(data.responseText);
				$.each(errors, function (key, value) {
					if($.isPlainObject(value)) {
						$.each(value, function (key, value) {                       
							var key = key.replace('.','_');
							$('.'+key+'_error').show().append(value);
						});
					}else{
					
					}
				}); 
			  }
		}
    });
});
var clicked = false;
$(document).on('click', '#checkAll' , function() {
$(".form-check-input").prop("checked", !clicked);
  clicked = !clicked;
  this.innerHTML = clicked ? 'Deselect' : 'Select';
})


$(document).on('click', '.delete_role' , function() {
	var user_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/role/delete_role/'+user_id,
        data: {_token:csrf_token,user_id:user_id},
        success: function(data) {
			if(data.success){
				notification('Success','User deleted Successfully','top-right','success',2000);
				$('.user_row_'+user_id).hide();
			}else{
				if(data.message){
					notification('Error',data.message,'top-right','error',3000);
				}else{
					notification('Error','Something went wrong.','top-right','error',3000);
				}
				
			}	
        },
    });
})