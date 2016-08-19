<?php
            session_start();
			//header("Content-Type: text/html;charset=utf-8"); 
            //hw server

            //$db_host = "localhost:49308";
			//$db_username = "s604410071";
			//$db_password = "s604410071";
            
            date_default_timezone_set('Asia/Taipei');
            //local
            $db_host = "localhost";
			$db_username = "root";
			$db_password = "12345678";
			$db_link = mysql_connect($db_host,$db_username,$db_password);
			if(!$db_link){
				die("Connection failed: " . mysqli_connect_error());
			}
            $DBname="s604410071";
			mysql_query("set character set 'utf8'");//讀庫 
			mysql_query("set names 'utf8'");//寫庫 
			$seldb = mysql_select_db($DBname);
			if(!$seldb){
				die("db連線失敗!");
			}
           
            //會員
            $MemberTable = "CREATE TABLE `".$DBname."`.`MemberTable` ( 
            `MemberID` INT(11) NOT NULL AUTO_INCREMENT , 
            `MemberName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MemberEmail` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `PhoneNum` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MemberPassword` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`MemberID`) ) ENGINE = MyISAM;";

            if (mysql_query($MemberTable) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
            //Menu菜單
            $MenuTable = "CREATE TABLE `".$DBname."`.`MenuTable` ( 
            `MenuID` INT(11) NOT NULL AUTO_INCREMENT , 
            `MemberID` INT(11) NOT NULL , 
            `MenuName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MenuItem` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MenuPrice` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MenuPhone` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`MenuID`,`MemberID`) ) ENGINE = MyISAM;";

            if (mysql_query($MenuTable) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
             //Order表單
            $OrderTable = "CREATE TABLE `".$DBname."`.`OrderTable` ( 
            `OrderID` INT(11) NOT NULL AUTO_INCREMENT , 
            `MemberID` INT(11) NOT NULL , 
            `OrderName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MenuName` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `OrderPlace` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `MenuArrive` BOOLEAN NOT NULL DEFAULT FALSE ,
            `dtmCreate` DATETIME NOT NULL , 
            `dtmEnd` DATETIME NOT NULL , 
            PRIMARY KEY (`OrderID`,`MemberID`) ) ENGINE = MyISAM;";

            if (mysql_query($OrderTable) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
            //會員點餐情況
            $CountTable = "CREATE TABLE `".$DBname."`.`CountTable` ( 
            `MemberID` INT(11) NOT NULL , 
            `OrderID` INT(11) NOT NULL , 
            `MenuID` INT(11) NOT NULL , 
            `MenuCount` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`MemberID`,`OrderID`,`MenuID`) ) ENGINE = MyISAM;";

            if (mysql_query($CountTable) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
/*
            $article = "CREATE TABLE `".$DBname."`.`article` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `author_id` INT(11) NOT NULL , 
            `title` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
            `classification` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `file_name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
            `file_name1` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL ,
            `content` TEXT CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `create_time` DATETIME NOT NULL , 
            `last_update` DATETIME NOT NULL , 
            PRIMARY KEY (`id`) ) ENGINE = MyISAM;";

            if (mysql_query($article) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
            $response = "CREATE TABLE `".$DBname."`.`response` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `article_id` INT(11) NOT NULL , 
            `user_id` INT(11) NOT NULL , 
            `message` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `time` DATETIME NOT NULL , 
            PRIMARY KEY (`id`) ) ENGINE = MyISAM;";

            if (mysql_query($response) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
            $setting ="CREATE TABLE `".$DBname."`.`setting` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `classification` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`id`) ) ENGINE = MyISAM;";
            if (mysql_query($setting) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }*/
?>