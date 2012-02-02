<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head></head>
<body>

<!-- hidden values -->
<input type="hidden"  id="APP_NAME" value="<?php echo $APP_NAME;?>" />
<input type="hidden"  id="<?php echo $APP_NAME;?>_custom_value" value="<?php echo $aUserSetting['custom']?>" />


		
<form name="<?php echo $APP_NAME;?>_form"   method="POST">
<table border="1" cellspacing="0" class="table_input_vr">
			<colgroup>
				<col width="115px" />
				<col width="*" />
			</colgroup>
			<tr>
				<th>App ID :</th>
				<td>
					<p class="plugin_title"><?php echo $APP_NAME;?></p><br />
					<span class="input_msg_b" >Skype setting : Tools > Options > Privacy [x] Allow my status to be shown on the web (must be set)</span>
				</td>
			
			</tr>
				<tr>
				<th>Skype username</th>
				<td>
					<span class="neccesary">*</span>
					<span><input type="text"   value="<?php echo $aUserSetting['username']?>" name="<?php echo $APP_NAME;?>_username" id="<?php echo $APP_NAME;?>_username" class="fix" fw-filter="isFill" /></span>
				
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
			<tr>
				<th>Update timer <?php echo $aUserSetting['custom'];?></th>
		 
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
			
			
		
			</table>
<div class="tbl_lb_wide_btn">
		<input type="button" value="Save" class="btn_apply" onclick="adminPageSettings.setting_submit()" />
		<a href="#" class="add_link" title="Reset to default" onclick="adminPageSettings.reset_default()" >Reset to Default</a>
</div>



</form>


</body>
</html>
