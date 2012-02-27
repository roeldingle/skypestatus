<?php
class frontPageSkypestatusdata extends Controller_Front
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
		
    	$this->importJS("frontPageSkypestatus");
    	
    	/*set the user setting*/
    	$aUserSetting = $this->oGet->getRow(2,"seq =".$this->getSequence());
    	
    	
    	/*set default values*/
    	if(empty($aUserSetting) || isset($aArgs['reset'])){
    		$aUserSetting = array(
    				'username' => "skype.user",
    				'image_type' => "balloon"
    				);
    	
    	}

		$sData = '';
		$sData .= '<div style="display:none;">';
		$sData .= '<input type="text" id="skypestatus_image_type" value="'.$aUserSetting['image_type'].'" />';
		$sData .= '<input type="text" id="SEQ" value="'.$this->getSequence().'" />';
		$sData .= '</div>';
		
    	$this->assign("Skypestatusdata",$sData);
    	
    	$Skypestatus_update = 'frontPageSkypestatus.display_front();';
    	$this->assign("Skypestatus_update",$Skypestatus_update);
    	
  
    }
  

}
