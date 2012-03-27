var adminPageSettings = {
		
		/*set global variables*/
		APP_NAME: $("#APP_NAME").val(),
		
		/*initialize*/
		initialize: function(){
			//alert(1);
		},
		
		
		
		/*save settings*/
		setting_submit: function(form){
			
			/*gather variables*/
			var iSeq = $("#SEQ").val();
			var bValid = oValidator.formName.getMessage(adminPageSettings.APP_NAME+'_form');
			
			var username = $("#"+adminPageSettings.APP_NAME+"_username").val();
			var image_type = $("#"+adminPageSettings.APP_NAME+"_type_image").val();
			
			if(bValid === true){
					/*ajax submit*/
					$.ajax({  
						url: usbuilder.getUrl("apiExec"),
						type: 'post',
						dataType: 'json',
						data: {
						action: 'setting_submit',
						get_seq: iSeq,
						get_username: username,
						get_image_type: image_type
					
						
					},
						success: function(data){
						
						if(data.Data === true){
							oValidator.generalPurpose.getMessage(true, "Saved successfully");
							scroll(0,0);
							
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
			
			$("#"+adminPageSettings.APP_NAME+"_form_reset").submit();
			
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
	

});
