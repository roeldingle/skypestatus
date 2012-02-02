var adminPageSettings = {
		
		/*set global variables*/
		APP_NAME: $("#APP_NAME").val(),
		
		/*initialize*/
		initialize: function(){
			//alert(1);
		},
		
		/*display custom*/
		display_custom: function(){
			
			/*timer*/
			var timer = $("#"+adminPageSettings.APP_NAME+"_timer").val();
			if(timer == "0"){
				var custom = $("#"+adminPageSettings.APP_NAME+"_custom_value").val();
			}else{
				var custom = "0";
			}
			
			
			/*empty the custom div container*/
			$("#"+adminPageSettings.APP_NAME+"_custom").empty();
			
			/*if timer selected is custom*/
			if(timer == "0"){		
				$("#"+adminPageSettings.APP_NAME+"_custom").append("<span class='neccesary'>*</span> <input fw-filter='isFill&isNumber' type='text' style='width:30px;' maxlength='2' name='"+adminPageSettings.APP_NAME+"_custom_timer' id='"+adminPageSettings.APP_NAME+"_custom_timer' value='"+custom+"'  validate='' />");
				$("#"+adminPageSettings.APP_NAME+"_custom").append('<span class="input_msg_b">Enter minutes</span>');
			}
			
		},
		
		/*save settings*/
		setting_submit: function(form){
			
			
			if(oValidator.formName.getMessage(adminPageSettings.APP_NAME+'_form')){
				
				/*gather variables*/
				var username = $("#"+adminPageSettings.APP_NAME+"_username").val();
				var image_type = $("#"+adminPageSettings.APP_NAME+"_type_image").val();
				var timer = $("#"+adminPageSettings.APP_NAME+"_timer").val();
				
				if(timer == "0"){
					var custom = $("#"+adminPageSettings.APP_NAME+"_custom_timer").val();
				}else{
					var custom = "0";
				}
				
				
					/*ajax submit*/
					$.ajax({  
						url: usbuilder.getUrl("apiExec"),
						type: 'post',
						dataType: 'json',
						data: {
						action: 'setting_submit',
						get_username: username,
						get_image_type: image_type,
						get_timer: timer,
						get_custom: custom
						
					},
						success: function(data){
						
						if(data.Data === true){
							oValidator.generalPurpose.getMessage(true, "Saved successfully");
							scroll(0,0);
							
							/*delay reload*/
							setTimeout(function(){
								window.location= usbuilder.getUrl("adminPageSettings");
							}, 500); 
							
							}else{
								oValidator.generalPurpose.getMessage(false, "Failed");
								scroll(0,0);
							}
					
						}
					});
			}
			
		},
		
		/*reset to default*/
		reset_default: function(){
			window.location= usbuilder.getUrl("adminPageSettings")+"&reset=true";
			
		},
		/*
		 * display a dialog box
		 * @param aDecs = define the description for the dialog box
		 */
		open_popup: function(sContainer,iWidth,sTitle){
			
			//empty the result list
			$("#googlemapmarker_result").empty();
			
			/*create popup*/
			popup.load(sContainer).skin("admin").layer({
				width: iWidth,
				title: sTitle,
				resize: false,
				draggable: true	
			});
			
		},
		
		/*
		 * close dialog box 
		 *  @param sConId = dialog box container id
		 */
		close_popup: function(sConId){
			popup.close(sConId);
		},
		
		validURL: function(str) {
			var regexp = /(ftp|http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/
			return regexp.test(str);
		}
	
};


$(document).ready(function(){
	
	adminPageSettings.initialize();
	adminPageSettings.display_custom();

});
