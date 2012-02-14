var frontPageSkypestatus= {
		
		/*display of front*/
		display_front: function(){
			
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
								
								$(".skypestatus_img_"+key).attr('src','img/skype_status/'+data['Data']['image_type']+'/'+aUserdata[1]+'.gif');
								
							});
						}
				
					}
				});
			
			

	}
}

$(document).ready(function(){

	var timer = ($("#skypestatus_custom").val() == 0) ? parseInt($("#skypestatus_timer").val()) : parseInt($("#skypestatus_custom").val())*60000;

	setInterval(function(){
		
		frontPageSkypestatus.display_front();
		
	}, timer);
	
	
});