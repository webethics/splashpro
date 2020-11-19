/* =================================
     COMMON PAGINATION START
======================================*/
 $(window).on('hashchange', function() {
	
	if (window.location.hash) {
		var page = window.location.hash.replace('#', '');
		if (page == Number.NaN || page <= 0) {
			return false;
		}else{
			getData(page);
		}
	}
});
$(document).ready(function(){
	  $(document).on('click', '.pagination a',function(event){
		event.preventDefault();
		$('li.page-item').removeClass('active');
		$(this).parent('li.page-item').addClass('active');
		var myurl = $(this).attr('href');
		var page=$(this).attr('href').split('page=')[1];
		getData(page);
	}); 
	
});
	function getData(page){
		
		
	  var filter_str ='';
	 
	  // SEARCH FILTER FOR Customer
	if($('#first_name').val()!='' && $('#first_name').val()!=undefined)
		filter_str +=  '&first_name=' +$('#first_name').val();
	if($('#last_name').val()!='' && $('#last_name').val()!=undefined)
		filter_str +=  '&last_name=' +$('#last_name').val();
	if($('#email').val()!='' && $('#email').val()!=undefined)
		filter_str +=  '&email=' +$('#email').val();
	if($('#role_id').val()!=null && $('#role_id').val()!=undefined)
		filter_str +=  '&role_id=' +$('#role_id').val(); 
	if($('#end_date').val()!='' && $('#end_date').val()!=undefined)
		filter_str +=  '&end_date=' +$('#end_date').val();
    if($('#gender').val()!='' && $('#gender').val()!=undefined)
		filter_str +=  '&gender=' +$('#gender').val();
    if($('#start_date').val()!='' && $('#start_date').val()!=undefined)
		filter_str +=  '&start_date=' +$('#start_date').val();
    if($('#age_from').val()!='' && $('#age_from').val()!=undefined)
		filter_str +=  '&age_from=' +$('#age_from').val();
	if($('#age_to').val()!='' && $('#age_to').val()!=undefined)
		filter_str +=  '&age_to=' +$('#age_to').val();
  //   if($('#mobile_number').val()!='' && $('#mobile_number').val()!=undefined)
		// filter_str +=  '&mobile_number=' +$('#mobile_number').val();
    if($('#status').val()!='' && $('#status').val()!=undefined)
		filter_str +=  '&status=' +$('#status').val();
    
	//alert($('#role_id').val());
	  
		$.ajax({
			url: '?page=' + page+filter_str,
			type: "get",
			datatype: "html"
		})
		.done(function(data){
			$("#tag_container").empty().html(data);
			location.hash = page;
		})
		.fail(function(jqXHR, ajaxOptions, thrownError)
		{
			  alert('No response from server');
		});
	 }

/* =================================
     COMMON PAGINATION START
======================================*/
/* =======Notification Message =========
position - top-right,top-left,bottom-left,bottom-right
theme - success,info,warning,error,none
showDuration - 4000 
==================================*/
function notification(title,message,positionClass,theme,showDuration){
	window.createNotification({
			closeOnClick: true,
			displayCloseButton: 1,
			positionClass: 'nfc-'+positionClass,
			showDuration: showDuration,
			theme: theme
		})({
			title: title,
			message: message
		});
}

$('.clear').click(function(){
	
	$(this).parents().find('form')[0].reset();
})

/*======================================================
	OPEN CONFIRM BOX TO COMPLETE THE REPORT 
=========================================================*/
 $(document).on('click','#open_confirmBox,.open_confirmBox', function(e) {
    e.preventDefault(); 
	
	var id = $(this).data('id');
	var confirm_message = $(this).data('confirm_message');
	var confirm_message_1 = $(this).data('confirm_message_1');
	var leftButtonId = $(this).data('left_button_id');
	var leftButtonName = $(this).data('left_button_name');
	var leftButtonCls = $(this).data('left_button_cls');

	var csrf_token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        type: "POST",
        url: base_url+'/confirmModal',
        data:{id:id,confirm_message:confirm_message,confirm_message_1:confirm_message_1,leftButtonId:leftButtonId,leftButtonName:leftButtonName,leftButtonCls:leftButtonCls,_token:csrf_token},
        success: function(data) {
			 $('.confirmBoxCompleteModal').html(data)
			 $('.confirmBoxCompleteModal').modal('show')
        }
    }); 
});

 
/*--------------------------------------------------------------------
Notifiaction
-----------------------------------------------------------*/
/* 	setInterval(function(){
		countnotification();
		var pageURL= $(location).attr("href").split('/').pop();			  
		if(pageURL=='requests')			  
			request_listing();
		if(pageURL=='users')			
			user_listing();
	    if(pageURL=='reports')			
			complete_request_listing();
		if(pageURL=='analysts')			
			analyst_request_listing();
	},5000); */
	
	
	
	
	function countnotification(){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: base_url+'/getUnreadNotificationsCount',
			data:{_token:csrf_token},
			dataType:"json",
			success: function(data) {

			if(data.total_notification>0){
				$('#count').removeClass('count');	
				$('#count').addClass('count1');
               //If request/user created then show request in list without page refresh		
               
			}

			$('#count').html(data.total_notification);
				
		}
		});
	} 
 $("#notificationButton").on("click", function() {	 
	var $attrib = $("#notificationDropdown");
	if($attrib.is(":hidden")){
		var csrf_token = $('meta[name="csrf-token"]').attr('content');
		$.ajax({
			type: "POST",
			url: base_url+'/getUnreadNotifications',
			data:{_token:csrf_token},
			dataType:"json",
			success: function(data) {
				if(data.success){
					$('#scroll').html(data.notifications);
					$('#viewAll').show();
				}else{
					$('#scroll').html('<span style="color:red;display:block;text-align:center">No Record Found. </span>');
					$('#viewAll').hide();
				}
			}
		});
	}	
});
/*--------------------------------------------------------------------
Notifiaction
-----------------------------------------------------------*/
