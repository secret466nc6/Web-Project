<?php
include("connMysql.php");
$sql_query = "DELETE FROM `".$DBname."`.`MenuTable` WHERE `MenuTable`.`MenuID` = '".$_GET['MenuID']."' AND `MenuTable`.`MemberID` = '".$_GET['MemberID']."'" ;
    
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
header("Location:menu.php");
?>
