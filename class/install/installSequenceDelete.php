<?php
class installSequenceDelete
{
    function run($aArgs)
    {
    	
    	$dDeleted = common()->modelExec()->deleteData(2,"seq =".$aArgs['seq']);
    	
    	if ($dDeleted !== false) {
    		return true;
    	} else {
    		return false;
    	}
    	
    }
}