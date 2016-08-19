<?php
include("connMysql.php");
if (isset($_POST["email"]) && !empty($_POST["email"])) { //Checks if action value exists
	//宣告回傳值為傳入值
	$return = $_POST;
	//宣告一個新的json欄位status，值為true
	$return["status"] = true;//帳號
    $return["status1"] = true;//密碼
	//宣告一個json的欄位，放入Json編碼的回傳值	
	$return["json"] = json_encode($return);	
	//使用echo回傳
	
    $email= $return['email'];
    $password= $return['password'];


$email_query="SELECT * FROM `MemberTable` WHERE `MemberEmail` = '".$email."'";
        $isemail=mysql_query($email_query);
        $row=mysql_fetch_assoc($isemail);
        if(empty($row['MemberEmail'])){
            $return["status"] = false;//查無此帳號
        }else if($row['MemberPassword'] != $password){
            $return["status1"] =false;//密碼錯誤
        }else{
        $_SESSION['email'] = $email;//登入成功
        }
}
   echo json_encode($return);
  function is_ajax() {
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>