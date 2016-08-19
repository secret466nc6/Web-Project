<?php
include("connMysql.php");
$sql_query = "DELETE FROM `".$DBname."`.`OrderTable` WHERE `OrderTable`.`OrderID` = '".$_GET['OrderID']."' AND `OrderTable`.`MemberID` = '".$_GET['MemberID']."'";
    
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
header("Location:manage.php");
?>
