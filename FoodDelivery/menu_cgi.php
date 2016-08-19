<?php
$Items="";
if(!empty($_POST ["Item"])){
    $Item = $_POST ["Item"];
}
if(!empty($Item))
  $Items = implode(",", $Item); 

$Prices="";
if(!empty($_POST ["Price"])){
    $Price = $_POST ["Price"];
}

if(!empty($Price))
  $Prices = implode(",", $Price); 
    $sql_query ="INSERT INTO `".$DBname."`.`MenuTable` (`MenuID`, `MemberID`, `MenuName`, `MenuItem`, `MenuPrice`, `MenuPhone`) VALUES (
    NULL, '".$_POST['MemberID']."', '".$_POST['inputName']."', '".$Items."', '".$Prices."', '".$_POST['inputPhone']."')"; 
mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
?>