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
	
    $name = $return['name'];
    $email= $return['email'];
    $password= $return['password'];
    $phone = $return['phone'];


$email_query="SELECT * FROM `MemberTable` WHERE `MemberEmail` = '".$email."'";
        $isemail=mysql_query($email_query);
        $row=mysql_fetch_assoc($isemail);
        if(empty($row['MemberEmail'])){
     $sql_query = "INSERT INTO `".$DBname."`.`MemberTable` (`MemberID`, `MemberEmail`, `MemberPassword`, `PhoneNum`, `MemberName`) VALUES 
     (NULL, '".$email."', '".$password."', '".$phone."', '".$name."')";
           mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
            $return["status"] = true;//$textSuc = "註冊成功，等待自動跳轉後重新登入！";
        }else{
            $return["status"] =false;//$textErr = "此帳號已經被註冊！";
        }
}
   echo json_encode($return);
  function is_ajax() {
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>