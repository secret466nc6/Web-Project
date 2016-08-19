<?php
include("connMysql.php");
if (isset($_POST["name"]) && !empty($_POST["name"])) { //Checks if action value exists
	//宣告回傳值為傳入值
	$return = $_POST;
	//宣告一個新的json欄位status，值為true
	$return["status"] = true;
	//宣告一個json的欄位，放入Json編碼的回傳值	
	$return["json"] = json_encode($return);	
	//使用echo回傳
	$datetime= date("Y/m/d H:i:s");
    $name = $return['name'];
    $place= $return['place'];
    $menu= $return['menu'];
    $time = $return['time'];
    $memberid = $return['memberid'];

     $sql_query = "INSERT INTO `".$DBname."`.`OrderTable` (`OrderID`, `MemberID`, `OrderName`, `MenuName`, `OrderPlace`, `dtmCreate`, `dtmEnd`) VALUES 
     (NULL, '".$memberid."', '".$name."', '".$menu."', '".$place."', '".$datetime ."', '".$time."')";
           mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
            $return["status"] = true;//$textSuc = "註冊成功，等待自動跳轉後重新登入！";
     
}
   echo json_encode($return);
  function is_ajax() {
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>