<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:index.php"); 
//將session清空
unset($_SESSION['email']);
header("Location:index.php"); 
?>