<?php
class frontPageSkypestatus extends Controller_Front
{

	protected $oGet;

    protected function run($aArgs)
    {

    require_once('builder/builderInterface.php');
	usbuilder()->init($this, $aArgs);
    
 	/*assign objects*/
    $this->oGet = new modelGet;
 
	$this->display($aArgs);

    }

    protected function display($aArgs){

    	/*set the user setting*/
    	$aUserSetting = $this->oGet->getRow(2,"seq =".$this->getSequence());

    	$sData = '';
    	$sDataUsername = '';
    	$sData .= '<div style="display:none;"  >';
    	$sData .= '<input type="text" class="skypestatus_image_type" value="'.$aUserSetting['image_type'].'" />';
    	$sData .= '<input type="text" class="SEQ" value="'.$this->getSequence().'" />';
    	$sData .= '</div>';
    	
    	/*icon and data*/
    	$sData .= '<span class="skypestatus_wrap_data" >';
    		$Status = $this->getDisplay($aUserSetting['username'],false,false );
    		$sData .= '<img  class="skypestatus_icon"  src="/_sdk/img/skypestatus/skype_status/'.$aUserSetting['image_type'].'/'.$Status.'.gif" />';
    	$sData.= '</span>';
    	
    	/*username*/
    	$sDataUsername .= '<span class="skypestatus_wrap_user" >';
    	$sDataUsername .= $aUserSetting['username'];
    	$sDataUsername.= '</span>';
    	
    	if($aUserSetting){
    	$this->assign("icon",$sData);
    	$this->assign("username",$sDataUsername);
    	
    	$Skypestatus_update = 'update';
    	$this->assign("update",$Skypestatus_update);
    	
    	$this->init_js($aArgs);	 	
    	}
    	else{
    		
    		$this->fetchClear();
    	}
    }
    
    protected function init_js($aArgs){
    
    	$sJs = '
    	sdk_Module("'.usbuilder()->getModuleSelector().'").ready(function($M){
    
	    	var frontPageSkypestatus= {
		    	/*display of front*/
		    	display_front: function(){
			    	
			    	var iSeq = $M(".SEQ").val();
			    	var image_type = $M(".skypestatus_image_type").val();
			    	
			    	$M(".skypestatus_wrap_data").html("<img src=\' /_sdk/img/skypestatus/loader_small.gif\' />");
			    	$M(".skypestatus_wrap_user").html("<img src=\' /_sdk/img/skypestatus/loader_small.gif\' />");
			    
				    	$.ajax({
					    	url: usbuilder.getUrl("apiGet"),
					    	type: "post",
					    	dataType: "json",
					    	data: {
					    	get_seq: iSeq
						    },
						    success: function(data){
						    	
							    if(data.Data){
								  	 sData = "<img src=\'/_sdk/img/skypestatus/skype_status/"+data.Data.image_type+"/"+data.Data.status+".gif\' />";
								  	 sDataUsername = data.Data.username;
							    }
						    	$M(".skypestatus_wrap_data").html(sData);
						    	$M(".skypestatus_wrap_user").html(sDataUsername);
						    }
				   		});
		   		 }
		    }
    
	   	 	$M(".update").click(function(){
	   		 	frontPageSkypestatus.display_front();
	    	});
  
   		});';
    	
    	$this->writeJs($sJs);
    
    }
    
	public function getDisplay($username, $image = false, $icon = false ){
	
		if($image && $icon)
		{
			return "http://mystatus.skype.com/".$icon."/".$username;
		}
		else if($image)
		{
			return "http://mystatus.skype.com/".$username;
		}

		else
		{
			$url = "http://mystatus.skype.com/".$username.".xml";
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
			$data = curl_exec($curl);
			curl_close($curl);
			
			$pattern = '/xml:lang="en">(.*)</';
			preg_match($pattern,$data, $match); 
			
			return $match[1];   
		}
	
	}
	
    public function downloadXmlFile($path)
    {
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_URL,$path);
    	curl_setopt($ch, CURLOPT_FAILONERROR,1);
    	//curl_setopt($ch, CURLOPT_FOLLOWLOCATION,1);
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    	curl_setopt($ch, CURLOPT_TIMEOUT, 15);
    	$retValue = curl_exec($ch);
    	curl_close($ch);
    
    	return $retValue;
    }
    
   
}
