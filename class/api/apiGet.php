<?php
class apiGet extends Controller_Api
{
	
	
    protected function post($aArgs)
    {

        require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
        
         $oGet = new modelGet;
         
    	/*set the user setting*/
    	$aUserSetting = $oGet->getRow(2,null);
    	
    	
    	/*set default values*/
    	if(empty($aUserSetting) || isset($aArgs['reset'])){
    		$aUserSetting = array(
    				'username' => "skype.user",
    				'image_type' => "balloon",
    				'timer' => 5000,
    				"custom"=> "0"
    				);
    	
    	}
    	
    	/*set the users*/
    	$aUsers = explode("+",$aUserSetting['username']);
    	
    	$aData['image_type']= $aUserSetting['image_type'];
    	$aData['timer']= $aUserSetting['timer'];
    	$aData['custom']= $aUserSetting['custom'];
    	
    	foreach($aUsers as $val){
    		$Status = $this->getDisplay($val,false,false );
    		$aList[]= $val."=>".$Status;
    	}
    	
    	$aData['list'] = $aList;
    	
    	return $aData;
        
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
