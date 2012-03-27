<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>

<!-- hidden values -->
<input type="hidden"  id="APP_NAME" value="<?php echo $APP_NAME;?>" />
<input type="hidden"  id="<?php echo $APP_NAME;?>_custom_value" value="<?php echo $aUserSetting['custom'];?>" />
<input type="hidden" id="SEQ" value="<?php echo $iSeq;?>" /><!--pluginurl-->
	
<form name="<?php echo $APP_NAME;?>_form"   method="POST">
<table border="1" cellspacing="0" class="table_input_vr">
			<colgroup>
				<col width="115px" />
				<col width="*" />
			</colgroup>
			
				<tr>
				<th>Skype username</th>
				<td >
					<span class="neccesary" style="float:left;margin-right:3px"  >*</span>
					<p class="skype_username"><input type="text"   value="<?php echo $aUserSetting['username'];?>" name="<?php echo $APP_NAME;?>_username" id="<?php echo $APP_NAME;?>_username"  fw-filter="isFill" /></p>
				</td>
			
			</tr>
			<tr>
				<th>Status image</th>
		 
				<td>
					<select style="margin-left:10px;width:120px;" name="<?php echo $APP_NAME;?>_type_image" id="<?php echo $APP_NAME;?>_type_image" >
					
					<?php foreach($aImgOption as $val){?>
						<option value="<?php echo $val;?>" <?php echo ($val == $aUserSetting['image_type'])? "selected" : "";?> ><?php echo $val;?></option>
					<?php }?>
				
					</select>
				
				</td>
			
			</tr>
			<!--  
			<tr>
				<th>Update timer</th>
		 
				<td>
					<select  style="margin-left:10px;width:120px;" name="<?php echo $APP_NAME;?>_timer" id="<?php echo $APP_NAME;?>_timer" onchange="adminPageSettings.display_custom();" >
					
						<option value="5000" <?php echo ($aUserSetting['timer'] == 5000)?"selected":"";?> >5 sec.</option>
						<option value="10000" <?php echo ($aUserSetting['timer'] == 10000)?"selected":"";?>>10 sec.</option>
						<option value="30000" <?php echo ($aUserSetting['timer'] == 30000)?"selected":"";?>>30 sec.</option>
						<option value="60000" <?php echo ($aUserSetting['timer'] == 60000)?"selected":"";?>>1 min.</option>
						<option value="300000" <?php echo ($aUserSetting['timer'] == 300000)?"selected":"";?> >5 min.</option>
						<option value="0" <?php echo ($aUserSetting['timer'] == "0")?"selected":"";?> >custom</option>
					
					</select>
					<div id="<?php echo $APP_NAME;?>_custom" ></div>
				</td>
			
			</tr>
			-->
			
		
			</table>
<div class="tbl_lb_wide_btn">
		<input type="button" value="Save" class="btn_apply" onclick="adminPageSettings.setting_submit()" />
		<a href="#" class="add_link" title="Reset to default" onclick="adminPageSettings.reset_default()" >Reset to Default</a>
		<?php 
			 if ($bExtensionView === 1){
			            echo '<a href="/admin/sub/?module=ExtensionPageManage&code=' . ucfirst(APP_ID) . '&etype=MODULE" class="add_link" title="Return to Manage ' . ucfirst(APP_ID) . '">Return to Manage ' . ucfirst(APP_ID) . '</a>
			            <a href="/admin/sub/?module=ExtensionPageMyextensions" class="add_link" title="Return to My Extensions">Return to My Extensions</a>';
			  }
		?>
</div>



</form>
<!--form for reset-->
<form method="POST" action="" name="<?php echo $APP_NAME;?>_form_reset" id="<?php echo $APP_NAME;?>_form_reset" ><input type="hidden" name="<?php echo $APP_NAME;?>_reset" value="true" /></form>


</body>
</html>
