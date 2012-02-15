<?php
class apiExec extends Controller_Api
{
	
	
    protected function post($aArgs)
    {

        require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
        
        
        $oExec = new modelExec;
     
	#data to insert
	$aData = array(
		'username' => $aArgs['get_username'],
    	'image_type' => $aArgs['get_image_type']
    	//'timer' => $aArgs['get_timer'],
    	//'custom' => $aArgs['get_custom']
		);
	
    $dDeleted = $oExec->deleteData(2);
    if($dDeleted === true){
		$aResult = $oExec->insertData(2,$aData);
    }else{
    	$aResult = "false";
    }
	
	return $aResult;
        
    }
    
  
}
