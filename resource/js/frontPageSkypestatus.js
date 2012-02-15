var frontPageSkypestatus= {
		
		/*display of front*/
		display_front: function(){
			
			/*
			
			$.each($("img [name='skypestatus_user[]']"), function(key,val){
				
				var image_type = $("#skypestatus_image_type").val();
				alert($(this).attr("src"))
				$(this).attr('src','img/skype_status/'+image_type+'/loading_gray.gif');
				
				
			});
			*/
			var image_type = $("#skypestatus_image_type").val();
			//$(".skypestatus_user").removeAttr('src');
			
			
			$(".skypestatus_user").attr('src','/_sdk/img/skypestatus/loader_small.gif');
			//return;
			
			
			$.ajax({  
					url: usbuilder.getUrl("apiGet"),
					type: 'post',
					dataType: 'json',
					data: {
					action: 'setting_submit'
					
				},
					success: function(data){
						
						if(data['Data']){
							
							$.each(data['Data']['list'], function(key,val){
								aUserdata = val.split("=>");
								
								$("#skypestatus_img_"+key).attr('src','/_sdk/img/skypestatus/skype_status/'+data['Data']['image_type']+'/'+aUserdata[1]+'.gif');
								
							});
						}
				
					}
				});
			
			

	}
}

$(document).ready(function(){
	
	
	
});