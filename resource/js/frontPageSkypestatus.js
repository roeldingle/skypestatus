var frontPageSkypestatus= {
		
		/*display of front*/
		display_front: function(){
			
			var iSeq = $("#SEQ").val();
			var image_type = $("#skypestatus_image_type").val();

			$(".skypestatus_user").attr('src','/_sdk/img/skypestatus/loader_small.gif');
			
			
			$.ajax({  
					url: usbuilder.getUrl("apiGet"),
					type: 'post',
					dataType: 'json',
					data: {
					action: 'setting_submit',
					get_seq: iSeq
					
				},
					success: function(data){
						
						if(data['Data']){
							
							$.each(data['Data']['list'], function(key,val){
								aUserdata = val.split("=>");
								
								$(".skypestatus_img_"+key).attr('src','/_sdk/img/skypestatus/skype_status/'+data['Data']['image_type']+'/'+aUserdata[1]+'.gif');
								
							});
						}
				
					}
				});
			
			

	}
}

$(document).ready(function(){
	
	
	
});