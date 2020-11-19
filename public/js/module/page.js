	

$(document).on('click', '.delete_page' , function() {

	var page_id = $(this).data('id');
	
	var csrf_token = $('meta[name="csrf-token"]').attr('content');
	 $.ajax({
        type: "POST",
		dataType: 'json',
        url: base_url+'/cms-pages/delete_page/'+page_id,
        data: {_token:csrf_token,page_id:page_id},
        success: function(data) {
			if(data.success){
				notification('Success','Page deleted Successfully','top-right','success',2000);
				$('.user_row_'+page_id).hide();
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