<?php

if (isset($_POST["title"]) && !empty($_POST["title"])) { //Checks if action value exists
	//宣告回傳值為傳入值
	$return = $_POST;
	//宣告一個新的json欄位status，值為true
	$return["status"] = true;
	//宣告一個json的欄位，放入Json編碼的回傳值	
	$return["json"] = json_encode($return);	
	//使用echo回傳
	echo json_encode($return);
    $title= $return['title'];
    $content= $return['content'];
    if(!empty($return['check']))
    $check= $return['check'];
    $id= $return['id'];
}

include("connMysql.php");
//設定地點為台北時區
date_default_timezone_set('Asia/Taipei');
//取得年份/月/日 時:分:秒
$datetime= date("Y/m/d H:i:s");
//分類項目擷取
$img="";
$img1="";
 if(empty($textErr)){
        $mychecks="";
        if(!empty($check))
  $mychecks = implode(",", $check);   
    $sql_query ="INSERT INTO `s604410071`.`article` (`id`, `author_id`, `title`, `classification`, `file_name`, `file_name1`,`content`, `create_time`, `last_update`) VALUES (
    NULL, '".$id."', '".$title."', '".$mychecks."', '".$img."', '".$img1."', '".$content."', '".$datetime."', '".$datetime."')"; 
	
	mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
        
    }

   
  function is_ajax() {
return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
}
?>