(function($){
	/*defining plugin*/
	$.fn.newForm = function(options){
		var id;
		var form;
		var form_data;
		var selector;
		var myDropzone = [];
		var allTypes = [];
		var dropzoneError;
		var _validationStatus=true;
		var loader;
		var settings = $.extend({
			color:"#EFEFEF",
			size:"20px",
			done:null,
			handler:'',
			requestURL:'',
			button:'',
			errorMessage:'',
			successMessage:'',
			successMessageClass:'',
			errorMessageClass:'',
			commonErrorSeclector:'',
			eventRequired:'',
			eventSelector:'',
			dropzoneSelector:'',
			dropzoneErrorClass:'',
			dropzoneRequired:false,
			dropzoneURL:'',
			dropzoneFileaccept:'.pdf,.jpeg,.jpg,.png,.gif',
			dropzoneExtMsg:'',
			dropzoneSizeMsg:'',
			dropzoneErrorMsg:'',
			//logo: '.logo'
			
		}, options)
		csrf_token = $('meta[name="csrf-token"]').attr('content');
		id = $(this).data('id');
	//	console.log(id);
		form = $(this);
		loader = $('<div class="spinner-border text-primary"></div>');
		/* ADDITIONAL REQUIRED EVENT SELECTOR */
		if(settings.eventSelector)	selector = document.getElementById(settings.eventSelector);
		return this.each(function(){
			if(settings.eventRequired=='checked'){
				var _status; var _value;
				selector.addEventListener('change', (event) => {
					if (event.target.checked) _status=1;
					else _status=0;
					selector.value=_status;
				})
			}
			/* DROPZONE FILE UPLOAD */
			Dropzone.autoDiscover = false;
			if(settings.dropzoneRequired == true){
				if (Dropzone.instances.length > 0) Dropzone.instances.forEach(dz => dz.destroy())	
					
					
					//var type = $(settings.dropzoneSelector).data('type');
					
					$(settings.dropzoneSelector).each(function(){
						type = $(this).data('type');
						allTypes.push(type);
					});	
					
					allTypes.forEach(value_type=> {
						
						if(value_type == 'aadhaar_front'){
							var newElement = '#drop_here_aadhaar_front';
						}
						if(value_type == 'aadhaar_back'){
							var newElement = '#drop_here_aadhar_back';
						}
						if(value_type == 'pan_card'){
							var newElement = '#drop_here_pan_card';
						}
						
						var myDropzone1  = new Dropzone(newElement, { 
							url: base_url+settings.dropzoneURL+id+'/'+value_type,
							autoProcessQueue: false,
							acceptedFiles: settings.dropzoneFileaccept,
							addRemoveLinks: false,
							parallelUploads:10,
							uploadMultiple:false,
							maxFiles: 1,
							headers: {
								'X-CSRF-Token': csrf_token
							},
							accept: function(file, done) {
								
								var _URL = window.URL || window.webkitURL;
								img = new Image();
								var imgwidth = 0;
								var imgheight = 0;
								/* var maxwidth = 2000;
								var maxheight = 320; */

								img.src = _URL.createObjectURL(file);
								/* img.onload = function() {
									imgwidth = this.width;
									imgheight = this.height;
									if(imgheight == 320 && imgwidth == 2000){
										done();  
										$(settings.dropzoneErrorClass).text('');
									}else{
										done(settings.dropzoneSizeMsg); 
										$(settings.dropzoneErrorClass).text(settings.dropzoneSizeMsg);
									}
								}; */
								
								var ext = (file.name).split('.')[1]; // get extension from file name						
								ext = ext.toUpperCase();
								if ( ext == "JPG" || ext == "JPEG" || ext == "PNG" ||  ext == "GIF" ){
									done();  
									$(settings.dropzoneErrorClass).text('');
								}else { 
									done(settings.dropzoneExtMsg); 
									$(settings.dropzoneErrorClass).text(settings.dropzoneExtMsg);
								}
								
							},
							init: function() { 
								var thisDropzone = this;
								/* Will fetch and add the server uploaded image inside the DropZone */
								
									function addLoadEvent(func) {
										var oldonload = window.onload;
										if (typeof window.onload != 'function') {
											window.onload = func;
										} else {
											window.onload = function() {
												if (oldonload) {
													oldonload();
												}
												func();
											}
										}
									}
									addLoadEvent(function_a);
								
									function function_a(){
										//console.log(base_url+'/fetch/custom_logo/'+id+'/'+value_type);
									
										$.post(base_url+'/fetch/custom_logo/'+id+'/'+value_type,{'_token': csrf_token}, function(data, textStatus) {
											if(data.msg !='Error'){
												var mockFile = { name: data.name, size: data.size};
												thisDropzone.options.addedfile.call(thisDropzone, mockFile);
												thisDropzone.options.thumbnail.call(thisDropzone, mockFile, base_url+settings.dropzoneURL+data.name);
												mockFile.previewElement.classList.add('dz-success');
												mockFile.previewElement.classList.add('dz-complete');
											}
										}, "json");
									};
														
								this.on('error', function(file, response) { 
									this.removeAllFiles();
									var errorMessage ;
									if(response.errorMessage == undefined) errorMessage = response;
									else  errorMessage = response.errorMessage;
									$(file.previewElement).find('.dz-error-message').text(errorMessage);
									$(settings.dropzoneErrorClass).text(errorMessage);
									
								});
								this.on("maxfilesexceeded",function(file){
									/* Hiding default message of DROPZONE i.e. Drop files here to upload */
									if($(this.previewsContainer.children[1]) != undefined){
										$(this.element.children[0]).hide();
									}
									$(settings.dropzoneErrorClass).text('Sorry, you cannot upload more than 1 file.');
										
								
								});
								this.on("success", function(file, responseText) {
									if($(this.previewsContainer.children[1]) != undefined) $(this.previewsContainer.children[1]).remove();
									notification('Success','Logo has been uploaded.','top-right','success',4000);
									this.removeFile(file);
									var mockFile = { name: responseText.name, size: file.size};
									this.options.addedfile.call(this, mockFile);
									this.options.thumbnail.call(this, mockFile, base_url+settings.dropzoneURL+responseText.name);
									mockFile.previewElement.classList.add('dz-success');
									mockFile.previewElement.classList.add('dz-complete');
									
									if(value_type == 'aadhaar_front'){
										
										$('#empty_aadhaar_front').html('<img src="'+base_url+settings.dropzoneURL+responseText.name+'">');
										$('#aadhaar_front_show').attr('src',base_url+settings.dropzoneURL+responseText.name);
									}
									if(value_type == 'aadhaar_back'){
										$('#empty_aadhaar_back').html('<img src="'+base_url+settings.dropzoneURL+responseText.name+'">');
										$('#aadhaar_back_show').attr('src',base_url+settings.dropzoneURL+responseText.name);
									}
									if(value_type == 'pan_card'){
										$('#empty_pan_card').html('<img src="'+base_url+settings.dropzoneURL+responseText.name+'">');
										$('#pan_card_show').attr('src',base_url+settings.dropzoneURL+responseText.name);
									}
									
									
									
									
									
									$(settings.logo).css('background-image', 'url(' + base_url+settings.dropzoneURL+responseText.name + ')');
									
								});
								this.on('removedfile', function (file) {
									$.post(base_url+'/delete/custom_logo/'+id+'/'+value_type,{'_token': csrf_token,file_name:file.name}, function(data, textStatus) {
										if(data.msg !='Error')notification('Success',data.msg,'top-right','success',4000);
									}, "json"); 
									$(settings.dropzoneErrorClass).text('');
								}); 
								
							},
							thumbnailWidth: 160,
							previewTemplate: '<div class="dz-preview dz-file-preview mb-3"><div class="d-flex flex-row"><div class="p-0 w-30 position-relative"><div class="dz-error-mark"><span><i></i></span></div><div class="dz-success-mark"><span><i></i></span></div><div class="preview-container"><img data-dz-thumbnail="" class="img-thumbnail border-0" /><i class="simple-icon-doc preview-icon" ></i>	</div></div><div class="pl-3 pt-2 pr-2 pb-1 w-70 dz-details position-relative"><div><span data-dz-name=""></span></div><div class="text-primary text-extra-small" data-dz-size=""></div><div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress=""></span></div><div class="dz-error-message"><span data-dz-errormessage=""></span></div></div><a href="#/" class="remove" data-dz-remove=""><i class="glyph-icon simple-icon-trash"></i></a></div></div>',
						});
						myDropzone.push(myDropzone1);
					});
					
					
				
			}
			
			var _showLoader = function(_this){
				_this.after(loader);
			}
			var _removeLoader = function(){
				loader.remove();
			}
			/* FORM REQUEST HANDLER */
			form.on('click',settings.button, function(e){
				form_data = form.serialize();
				
				_showLoader($(this));
				
				var _removeError = function(){
					$(settings.errorMessageClass).each(function(){						
						if($(this).hasClass('dropzoneError') != true)
						$(this).text('');
					});
				}
				var _showErrors = function(errors){
						var msg = '';
						_removeError();
						_removeLoader();
					   if(errors && errors.responseText) { //ajax error, errors = xhr object
							var r = $.parseJSON(errors.responseText);
							$.each(r.errors, function(k, v) {
								document.getElementsByClassName(k+settings.commonErrorSeclector)[0].innerHTML = v[0];
							});
							
					   } else { //validation error (client-side or server-side) 
							$.each(errors, function(k, v) {
								msg += k.errors; 
							});
						    $('.errors').removeClass('alert-success').addClass('alert-error').html(msg).show();
							
					   } 
				}
				var _successMessage = function(data, config){
					_removeError();
					_removeLoader();
					if(data.success == true) {
						
						/*DROPZONE PROCESS QUEUE*/
						myDropzone.forEach(value=> {
							if(settings.dropzoneRequired == true && value.files.length > 0 && value.files[0] != undefined && value.files[0].status != 'error' && value.files[0].accepted != 'false'){
								value.processQueue();
								
							}
						});
						/*UPDATING SITE TITLE AFTER SUCCESS*/
						if(settings.handler =='updateCustomSiteSettings'){
							form.parents('html').find('title').text(form.find('input#site_title').val());
							form.parents('html').find('title').text(form.find('textarea#welcome_text').val());
						}
						
					   $(this).removeClass('editable-unsaved');
					   //show messages
						$('#msg').addClass('alert-success').html(settings.successMessage).show('normal').removeClass('alert-error hide');
						setTimeout(function(){
						 $('#msg').hide('normal');
						},2000);
						if(settings.handler == 'reset' || settings.handler == 'create') form[0].reset();
						if(settings.handler == 'updateEmailSettings' || settings.handler =='updateCustomSiteSettings') 
						notification('Success','Settings updated successfully.','top-right','success',4000);
					} else if(data && data.errors){ 
						$.each(data.errors, function(k, v) {
							$('.'+k+settings.commonErrorSeclector).text(v);
						});
					}
				}
				var _mobileValidation = function(mobile_number){
					var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
					if (filter.test(mobile_number)) {
						_validationStatus =  true;
					}
					else {
						_validationStatus =  false;
					} 
				}
				/* Uncomment only if required {need to make code changes according to the requirement}*/
				//_mobileValidation(); 
				var _dropZoneERROR =  function(){
					if(settings.dropzoneRequired){
						
						myDropzone.forEach(value=> {
							
							var _hasClass = $(value.element.children[1]).hasClass('dz-complete');
							
							/* if( (form_data.indexOf('=&') > -1 || form_data.substr(form_data.length - 1) == '=' ) && settings.dropzoneRequired == true && value.files.length == 0 ){
								$(settings.dropzoneErrorClass).text(settings.dropzoneErrorMsg);
								_validationStatus =  true;
							}
							else */ 
							if (settings.dropzoneRequired == true && value.files.length == 0 && _hasClass == false){
								$(settings.dropzoneErrorClass).text(settings.dropzoneErrorMsg);
								_removeError();
								_validationStatus =  false;
								_removeLoader();
							}
							else if(settings.dropzoneRequired == true && value.files.length > 0 && value.files[0].status == 'error' && value.files[0].accepted == false){
								$(settings.dropzoneErrorClass).text(settings.dropzoneExtMsg);
								_validationStatus = false;
								_removeLoader();
							}else{
								_validationStatus =  true;
							}
						})
					}
				}
				/* FUNCTION CALLING */
				_dropZoneERROR();
				
				var _runAJAX = function(){
					if(_validationStatus){
						$.ajax({
							url: base_url+settings.requestURL+id, 
							type: "POST",
							dataType: 'json',  
							data: form_data,
							headers: {
								'X-CSRF-Token': csrf_token
							},
							success: function(data, config, settings) { 
								//console.log(config);console.log(settings);
								_successMessage(data, config);
									$('#site_customer_settings_info').show('slow');
									$('#site_customer_settings').hide('slow');	
									
							},
							error: function(errors) {
							  _showErrors(errors);
							}
						 
						});
					}
				}
				/* AJAX CALL */
				_runAJAX();
				
			});
		});
		
		
				
	}
}(jQuery));

$('form#site_customer_settings').newForm({
	//eventRequired:'checked',
//	eventSelector:'switch',/*ID or CLASS of CHECKBOX FIELD TYPE*/
	handler:'uploadDocuments',
	errorMessageClass:'.errors',
	commonErrorSeclector:'_error',
	button: 'button#uploadDocuments',
	requestURL: '/update/update_documents/',
	successMessage: 'The document has been uploaded successfully.',
	dropzoneRequired: true,
	dropzoneSelector: '.drop_here_logo',
	dropzoneErrorClass: '.dropzoneError',
	dropzoneURL: '/uploads/documents/',
	dropzoneFileaccept: ".jpeg,.jpg,.png,.gif",
	dropzoneExtMsg: "Please select only supported files.",
	dropzoneSizeMsg: "Image width must be 2000px and height must be 320px.",
	dropzoneErrorMsg: "Upload Document field is required.",
});