<?php
class frontPageSkypestatus extends Controller_Front
{

	protected $oGet;

    protected function run($aArgs)
    {

    require_once 'builder/builderInterface.php';
		
	$sInitScript = usbuilder()->init($this->Request->getAppID(), $aArgs);
	$this->writeJs($sInitScript);
    
 	/*assign objects*/
    $this->oGet = new modelGet;
 
	$this->display($aArgs);

    }

    protected function display($aArgs){

    	$this->importJS(__CLASS__);


    	/*set the user setting*/
    	$aUserSetting = $this->oGet->getRow(2,null);
    	
    	
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
    	
    	foreach($aUsers as $key=>$val){
    		$Status = $this->getDisplay($val,false,false );
    		$aList[]['username']= $val;
    		$aList[]['image']= '<img  class="skypestatus_img_'.$key.'" src="img/skype_status/'.$aUserSetting['image_type'].'/'.$Status.'.gif" />';
    	}
    	
    	$this->loopFetch($aList);
    	
    	/*
		$this->assign("Skypestatus_user",$aUserSetting['username']);
		$this->assign("Skypestatus_image_type",$aUserSetting['image_type']);
		$this->assign("Skypestatus_timer",$aUserSetting['timer']);
		$this->assign("Skypestatus_custom",$aUserSetting['custom']);
*/
		
		//$this->assign("aUsers",$aUsers);
		
		$sData = '';
		$sData .= '<div style="display:none;" >';
		$sData .= '<input type="text" id="'.$APP_NAME.'_username" value="'.$aUserSetting['username'].'" />';
		$sData .= '<input type="text" id="'.$APP_NAME.'_image_type" value="'.$aUserSetting['image_type'].'" />';
		$sData .= '<input type="text" id="'.$APP_NAME.'_timer" value="'.$aUserSetting['timer'].'" />';
		$sData .= '<input type="text" id="'.$APP_NAME.'_custom" value="'.$aUserSetting['custom'].'" />';
		$sData .= '</div>';
		
		
    	//$this->assign("Skypestatus",$aList[0]['username']);
    	
  
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
