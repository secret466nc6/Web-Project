<?php
            session_start();
		
            
            date_default_timezone_set('Asia/Taipei');
            //local
            $db_host = "localhost";
			$db_username = "root";
			$db_password = "12345678";
            //$db_password = "lab505";//HPCserver
			$db_link = mysql_connect($db_host,$db_username,$db_password);
			if(!$db_link){
				die("Connection failed: " . mysqli_connect_error());
			}
            $DBname="fish";
			mysql_query("set character set 'utf8'");//讀庫 
			mysql_query("set names 'utf8'");//寫庫 
			$seldb = mysql_select_db($DBname);
			if(!$seldb){
				die("db連線失敗!");
			}
           
            //Control
            $ControlTable = "CREATE TABLE `".$DBname."`.`ControlTable` ( 
            `ControlID` INT(11) NOT NULL AUTO_INCREMENT , 
            `ControlWaterTime` TIME NOT NULL , 
            `ControlWaterDay` INT(11) NOT NULL , 
            `ControlFoodTime` TIME NOT NULL ,
            `ControlFoodHour` INT(11) NOT NULL , 
            `ControlLedOn` TIME NOT NULL ,
            `ControlLedOff` TIME NOT NULL ,
            `ControlTemp` INT(11) NOT NULL , 
            PRIMARY KEY (`ControlID`) ) ENGINE = MyISAM;";

            if (mysql_query($ControlTable) === TRUE) {
                //echo "Table  created successfully";
            } else {
                //echo "Error creating table ";
            }
            $Controlsql = "SELECT * FROM `ControlTable`";
            $Controlresult = mysql_query($Controlsql);
            $Controlnum=mysql_num_rows($Controlresult);
            if($Controlnum==0)
            {
                $ControlFirstDo = "INSERT INTO `".$DBname."`.`ControlTable` (`ControlID`, `ControlWaterTime`, `ControlWaterDay`, `ControlFoodTime`, `ControlFoodHour`, `ControlLedOn`, `ControlLedOff`, `ControlTemp`) VALUES ('1', '07:00:00', '3', '12:00:00', '6', '12:00:00', '22:00:00', '25')";
                     mysql_query($ControlFirstDo) or die("無法送出" . mysql_error( )); 
            }

//INSERT INTO `fish`.`controltable` (`ControlID`, `ControlWaterTime`, `ControlWaterDay`, `ControlFoodTime`, `ControlFoodHour`, `ControlLedOn`, `ControlLedOff`, `ControlTemp`) VALUES (NULL, '04:00:00', '5', '04:00:00', '3', '04:00:00', '04:00:00', '25');
          
?>