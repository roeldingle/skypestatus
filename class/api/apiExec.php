<?php
class apiExec extends Controller_Api
{
	
	
    protected function post($aArgs)
    {

        require_once('builder/builderInterface.php');
		usbuilder()->init($this, $aArgs);
        
		/*sequence*/
		$iSeq = $aArgs['get_seq'];
		
		$oExec = new modelExec;
		$oGet = new modelGet;
		  
	#data to insert
	$aData = array(
		'idx' => '',
		'seq' => $iSeq,
		'username' => $aArgs['get_username'],
    	'image_type' => $aArgs['get_image_type']
		);
	
     $bSeqExist = $oGet->getRow(2,"seq =".$iSeq);
     
     if(empty($bSeqExist)){
     	$aResult = $oExec->insertData(2,$aData);
     }else{
        $dDeleted = $oExec->deleteData(2,"seq =".$iSeq);
        if($dDeleted === true){
        	$aData['idx'] = $bSeqExist['idx'];
        	$aResult = $oExec->insertData(2,$aData);
        }else{
        	$aResult = "false";
        }
     } 
	
	return $aResult;
        
    }
    
  
}
