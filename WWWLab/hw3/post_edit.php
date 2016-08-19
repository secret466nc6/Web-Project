<?php
if(!isset($_GET["id"]))
     header("Location:index.php");  
//設定地點為台北時區
date_default_timezone_set('Asia/Taipei');
//取得年份/月/日 時:分:秒
$datetime= date("Y/m/d H:i:s");
$check="";
//分類項目擷取
if(!empty($_POST ["check"]))
$check = $_POST ["check"];
$img="";
$img1="";
 $sql_db ="select * from `article` where `id`=".$_GET["id"];
        $result=mysql_query($sql_db);
        $row_result=mysql_fetch_assoc($result);
if(!empty($row_result['file_name']))
    $img=$row_result['file_name'];
if(!empty($row_result['file_name1']))
    $img1=$row_result['file_name1'];
//若轉移伺服器，第一次使用則須修改PHP內的PHP.ini檔上傳檔案大小，並重新啟動伺服器
if(is_uploaded_file($_FILES["file"]["tmp_name"])&&is_uploaded_file($_FILES["file1"]["tmp_name"])){//判斷是否從http上傳檔案
        //刪除原本檔案並重新上傳
       
        if(!empty($row_result["file_name"]))
        unlink("uploads/".$row_result["file_name"]);
        if(!empty($row_result["file_name1"]))
        unlink("uploads/".$row_result["file_name1"]);
    $limitedext = array(".doc",".DOC",".pdf",".PDF",".docx",".DOCX");//限定上傳的DOC,PDF副檔名
    $limitedext1 = array(".pdf",".PDF",".ppt",".PPT",".pptx",".PPTX");//限定上傳的PPT,PDF副檔名
    $errorIndex = $_FILES["file"]["error"];
    $errorIndex1 = $_FILES["file1"]["error"];
    $ext = strrchr($_FILES["file"]["name"],'.');//取出副檔名
    $ext1 = strrchr($_FILES["file1"]["name"],'.');//取出副檔名
    if (!in_array(strtolower($ext),$limitedext)||!in_array(strtolower($ext1),$limitedext1)) { // 不符合預期，顯示錯誤訊息。
        $textErr="檔案副檔名有誤";
    }else{
        if ($errorIndex > 0) {//如果錯誤的話就輸出錯誤訊息
       $textErr=$_FILES["file"]["error"];
        }else{
            $uid=uniqid();
            $img=$row['id'].$uid.$ext;//作者id+亂數檔名+副檔名
            $img1=$row['id'].$uid."-1".$ext1;//作者id+亂數檔名-1+副檔名
            //$img= $_POST["author_id"]
            if(move_uploaded_file($_FILES["file"]["tmp_name"],iconv("UTF-8", "big5","uploads/".$img))&&move_uploaded_file($_FILES["file1"]["tmp_name"],iconv("UTF-8", "big5","uploads/".$img1)))
            {
            $textSuc="重新上傳並修改文章！";
            } else{
            $textErr="檔案上傳失敗，請再試一次!";
            }      
            }

        }
}else {
         $textSuc="修改成功！";  
}
    if(empty($textErr)){
        $mychecks="";
        if(!empty($check))
  $mychecks = implode(",", $check);   
    $sql_query ="UPDATE `s604410071`.`article` SET `title` = '".$_POST['title']."', `classification` = '".$mychecks."', `content` = '".$_POST['content']."', `last_update` = '".$datetime."', `file_name` = '".$img."', `file_name1` = '".$img1."' WHERE `article`.`id` = ".$_GET["id"]; 
	
	mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
        
    }
   

?>