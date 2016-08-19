<?php
include("connMysql.php");
$sql_query = "DELETE FROM `".$DBname."`.`CountTable` WHERE `CountTable`.`OrderID` = '".$_GET['OrderID']."' AND `CountTable`.`MemberID` = '".$_GET['MemberID']."' AND `CountTable`.`MenuID` = '".$_GET['MenuID']."'" ;
    
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
header("Location:index.php");
?>
