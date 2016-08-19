
<!DOCTYPE html>
<?php
session_start();  // 啟動Session
//不需要管有沒有登入
    //header("Location:.php");  //跳回你要登入的頁面
			include("connMysql.php");
            $textErr = "";
            $textSuc = "";
if(isset($_POST["action"])&&($_POST["action"]=="login")){
    if(empty($_POST["name"])||empty($_POST["email"])||empty($_POST["labpassword"])||empty($_POST["password"])||empty($_POST["password1"])) {
        $textErr = "請確實填寫所有欄位！";
      }else if($_POST["password"]!=$_POST["password1"]){
        $textErr = "確認密碼與密碼不同！";
    }else if($_POST["labpassword"]!="lab505"){
         $textErr = "LAB密碼錯誤！";
    }else {
        $email_query="SELECT * FROM `user` WHERE `Email` = '".$_POST["email"]."'";
        $isemail=mysql_query($email_query);
        $row=mysql_fetch_assoc($isemail);
        if(empty($row['Email'])){
     $sql_query = "INSERT INTO `s604410071`.`user` (`id`, `Name`, `Email`, `Password`) VALUES 
     (NULL, '".$_POST["name"]."', '".$_POST["email"]."', '".$_POST["password"]."')";
           mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
            $textSuc = "註冊成功，等待自動跳轉後重新登入！";
        }else{
             $textErr = "此帳號已經被註冊！";
        }

}
}
            
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
               <ul>
                   <?php
                   if (!isset($_SESSION['email']))
                echo '<li><a href="login.php">登入</a></li>';
                       ?>
               </ul>
            </div>
    <div id="wrapper">
        <div align=center>
	   <form action="" enctype="multipart/form-data" method="post">
                <fieldset>
                    <legend>註冊HPC帳戶</legend>
                    <span class="title">暱稱</span><br />
				    <input type="text" name="name"  placeholder="User name" id="name"><br />
                <span class="title">Email</span><br />
				    <input type="email" name="email"  placeholder="Use this as login account" id="email"><br />
                    <span class="title">LAB密碼</span><br />
				    <input type="password" name="labpassword"  placeholder="LAB Password" id="labpassword"><br />
                    <span class="title">密碼</span><br />
				    <input type="password" name="password"  placeholder="Password" id="password"><br />
                <span class="title">確認密碼</span><br />
				    <input type="password" name="password1" placeholder="Enter password again" id="password1"><br />
               
           </fieldset>
                            <?php 
if(!empty($textErr)){
   echo "<p class='error'>".$textErr."</p>";
}else if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php>';
}?>
            <input name="action" type="hidden" value="login">
                <input type="submit" value="註冊"/>
                <input type="reset" value="取消" onClick="javascript:history.back(1)"/>   
                </form>

             </div>
    </div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>