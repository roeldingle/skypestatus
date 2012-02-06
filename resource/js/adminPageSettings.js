var adminPageSettings = {
		
		/*set global variables*/
		APP_NAME: $("#APP_NAME").val(),
		
		/*initialize*/
		initialize: function(){
			//alert(1);
		},
		
		add_user: function(selector){
			
			var iContainerSize = $("."+adminPageSettings.APP_NAME+"_li_wrap").size();
			
			var sData = '';
			sData +='<li class="'+adminPageSettings.APP_NAME+'_li_wrap" id="'+adminPageSettings.APP_NAME+'_li_wrap_'+(iContainerSize+1)+'" style="margin-left:1px;display:inline-block">';
			sData +='<div class="skype_user_container">';
			sData +='<span class="neccesary" style="float:left;margin-right:3px"  name="'+adminPageSettings.APP_NAME+'_username[]" >*</span>';
			sData +='<p class="skype_username"><input type="text"  name="'+adminPageSettings.APP_NAME+'_username[]" id="'+adminPageSettings.APP_NAME+'_username_'+(iContainerSize+1)+'"  fw-filter="isFill" /></p>';
			sData +='<p class="skype_btn"><a href="#" class="btn_plus" onclick="adminPageSettings.add_user(this);" ><span class="hidden">Add</span></a><a href="#" class="btn_minus" onclick="adminPageSettings.delete_user(this);"><span class="hidden">Remove</span></a></p>';
			sData +='</div>';
			sData +='</li>';
			
			$iLimit = 5;

			if(iContainerSize >= $iLimit){
				$(".skype_username_content ul").append("<span style='color:red;font-style:italic;' class='err_div_loc' >Max lmit is 5.</span>");
				$(".err_div_loc").delay(1500).fadeOut(400).slideUp();
				
				
				
			}else{
				$(".skype_username_content ul").append(sData);
			}
		},
		
		delete_user: function(selector){
			
			var iContainerSize = $("."+adminPageSettings.APP_NAME+"_li_wrap").size();
			 
			if (iContainerSize <= 1){
				$(".skype_username_content ul").append("<span style='color:red;font-style:italic;' class='err_div_loc' >Max lmit is 5.</span>");
				$(".err_div_loc").delay(1500).fadeOut(400).slideUp();
			}
			else{
				$(selector).parents('li').remove();
			}
			
		},
		
		/*
		 * get the locations from the div
		 */
		get_users: function(){
			
			var sData = "";
			var bValid = true;
			var iContainerSize = $("."+adminPageSettings.APP_NAME+"_li_wrap").size();
			
			$.each($("input[name='"+adminPageSettings.APP_NAME+"_username[]']"), function(){
				idx = $(this).val();
				if(idx == ""){
					bValid = false;
				}
				
				sData += "+"+idx;
			});
				sResult = sData.substr(1);
			if(bValid === true){
				return sResult;
			}else{
				return false;
			}
			

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
			
			/*gather variables*/
			var bValid = oValidator.formName.getMessage(adminPageSettings.APP_NAME+'_form');
			
			var username = $("#"+adminPageSettings.APP_NAME+"_username").val();
			var image_type = $("#"+adminPageSettings.APP_NAME+"_type_image").val();
			var timer = $("#"+adminPageSettings.APP_NAME+"_timer").val();
			
			if(timer == "0"){
				var custom = $("#"+adminPageSettings.APP_NAME+"_custom_timer").val();
			}else{
				var custom = "0";
			}
			
			var users = adminPageSettings.get_users();
			if(users === false){
				bValid = false;
			}
			
			if(bValid === true){
					/*ajax submit*/
					$.ajax({  
						url: usbuilder.getUrl("apiExec"),
						type: 'post',
						dataType: 'json',
						data: {
						action: 'setting_submit',
						get_username: adminPageSettings.get_users(),
						get_image_type: image_type,
						get_timer: timer,
						get_custom: custom
						
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
			}else{
				$.each($("input[name='"+adminPageSettings.APP_NAME+"_username[]']"), function(){
					idx = $(this).val();
					if(idx == ""){
						$(this).css("border","2px solid red");
					}
				});
				
			}
			
		},
		
		validate_user: function(selector){
			/*
			if($(selector).val == ""){
				alert($(selector).id);
			}
			*/
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
