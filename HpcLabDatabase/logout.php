
<!DOCTYPE html>
<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
//將session清空
unset($_SESSION['email']);
$textSuc="";
$textSuc="登出中，請稍後自動跳轉！";
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
		<title>HPC Lab Meeting Recoder</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
            <div id="header">
               <dfn><a href="index.php"> <img src="img/Hpc-logo-2_web.png" ></a></dfn>
            </div>
    <div id="wrapper">
        <div align=center>
	  
             <?php 
if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}?>
            
   
             </div>
    </div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>