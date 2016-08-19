<?php
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
			mysql_query("set character set 'utf8'");//讀庫 
			mysql_query("set names 'utf8'");//寫庫 
			$seldb = mysql_select_db("s604410071");
			if(!$seldb){
				die("db連線失敗!");
			}
            // sql to create table
            $user = "CREATE TABLE `s604410071`.`user` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `Name` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `Email` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            `Password` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`id`) ) ENGINE = MyISAM;";

            if (mysql_query($user) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }

            $article = "CREATE TABLE `s604410071`.`article` ( 
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
            $response = "CREATE TABLE `s604410071`.`response` ( 
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
            $setting ="CREATE TABLE `s604410071`.`setting` ( 
            `id` INT(11) NOT NULL AUTO_INCREMENT , 
            `classification` VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , 
            PRIMARY KEY (`id`) ) ENGINE = MyISAM;";
            if (mysql_query($setting) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
?>