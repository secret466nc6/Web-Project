<?php
$Counts="";

if(!empty($_POST ["Count"])){
    $Count = $_POST ["Count"];
}

if(!empty($Count))
  $Counts = implode(",", $Count); 


 
           if($numCount>0){
          $sql_query ="UPDATE `".$DBname."`.`CountTable` SET `MenuCount` = '".$Counts."' WHERE `CountTable`.`MemberID` = '".$row['MemberID']."' AND `CountTable`.`OrderID` = '".$_GET['OrderID']."' AND `CountTable`.`MenuID` = '".$rowMenu["MenuID"]."'";
            
          }else{
          $sql_query ="INSERT INTO `".$DBname."`.`CountTable` (`MemberID`, `OrderID`, `MenuID`, `MenuCount`) VALUES (
    '".$row['MemberID']."', '".$_GET['OrderID']."', '".$rowMenu["MenuID"]."', '".$Counts."')"; 
          }
    
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
  header("Location:detail.php?OrderID=".$_GET['OrderID']."&MemberID=".$_GET['MemberID']);
?>
