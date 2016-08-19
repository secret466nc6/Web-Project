<?php

          $sql_query ="UPDATE `".$DBname."`.`OrderTable` SET `MenuArrive` = '1' WHERE `OrderTable`.`OrderID` = '".$_GET['OrderID']."' AND `OrderTable`.`MemberID` = '".$_GET["MemberID"]."'";
            
         
    
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
 header("Location:manage_detail.php?OrderID=".$_GET['OrderID']."&MemberID=".$_GET['MemberID']);

?>
