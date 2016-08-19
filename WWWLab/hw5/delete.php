<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
include("connMysql.php");
        
        //刪除檔案
        $sql_db ="select * from `article` where `id`=".$_GET["id"];
        $result=mysql_query($sql_db);
        $row_result=mysql_fetch_assoc($result);
        if(!empty($row_result["file_name"]))
        unlink("uploads/".$row_result["file_name"]);
        if(!empty($row_result["file_name1"]))
        unlink("uploads/".$row_result["file_name1"]);
        //刪除資料
        $sql_query = "DELETE FROM `s604410071`.`article` WHERE `article`.`id` =".$_GET["id"];
        mysql_query($sql_query);
        header("Location:index.php");	
?>