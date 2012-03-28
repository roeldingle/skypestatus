<?php
class adminPageSettings extends Controller_Admin
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

    	/*define page*/
    	$APP_NAME = "skypestatus";
    	$this->assign("APP_NAME",$APP_NAME);
    	
    	$this->importJS(__CLASS__);
    	$this->importCSS(__CLASS__);
    	
    	
    	
    	/*save form validator*/
    	usbuilder()->validator(array('form' => $APP_NAME.'_form'));
    	
    	/*sequence*/
    	$iSeq = $aArgs['seq'];
    	$this->assign('iSeq', $iSeq);
    	
    	/*set the user setting*/
    	$aUserSetting = $this->oGet->getRow(2,"seq =".$iSeq);
    	
    	
    	/*assign url*/
    	$sUrl = usbuilder()->getUrl('adminPageSettings');
    	$this->assign("sUrl",$sUrl);
    	
 
    	
    	/*assign settings*/
    	$this->assign("aUserSetting",$aUserSetting);
    	
    	
    	/*image type options*/
    	$aImgOption = array('balloon','smallclassic','smallicon','mediumicon','dropdown-white','dropdown-trans');
    	$this->assign("aImgOption",$aImgOption);
    	
    	/*for the additional links in the settins page*/
    	$this->assign("bExtensionView", ($aArgs['etype'] ? 1 : 0));

    	/*set the template*/
    	$this->view(__CLASS__);

    }
}
