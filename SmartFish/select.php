<?php
include("connMysql.php");
 $Controlsql = "SELECT * FROM `ControlTable` WHERE `ControlID` = 1";
            $Controlresult = mysql_query($Controlsql);
$Controlrow = mysql_fetch_assoc($Controlresult);
echo $Controlrow['ControlWaterTime'].",".$Controlrow['ControlWaterDay'].",".$Controlrow['ControlFoodTime'].",".$Controlrow['ControlFoodHour'].",".$Controlrow['ControlLedOn'].",".$Controlrow['ControlLedOff'].",".$Controlrow['ControlTemp'];
?>