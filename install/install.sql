CREATE TABLE IF NOT EXISTS `skypestatus_settings`(
			 `idx` INT NOT NULL AUTO_INCREMENT, 
			 `seq` INT NOT NULL,
			 `username` TEXT NOT NULL,
			 `image_type` VARCHAR(20) NOT NULL,
	PRIMARY KEY (`idx`) ); 