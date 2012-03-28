<?php
class frontPageNoRecord extends Controller_Front
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
    	
    	if($aUserSetting){
    		
    		$this->fetchClear();
    		
    	}
    }
}