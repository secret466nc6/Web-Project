<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
        include("connMysql.php");
        //刪除資料
        $sql_query = "DELETE FROM `s604410071`.`setting` WHERE `setting`.`id` =".$_GET["id"];
        mysql_query($sql_query);
        header("Location:setting.php");
			
?>