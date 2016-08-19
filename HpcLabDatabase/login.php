
<!DOCTYPE html>
<?php
session_start();  // 啟動Session
if (isset($_SESSION['email']))
    header("Location:index.php");  //防止跳回登入畫面

        include("connMysql.php");
        if(isset($_POST["action"])&&($_POST["action"]=="login")){
             if(empty($_POST["email"])||empty($_POST["password"])) {
                    $textErr = "Email和密碼請勿空白！";
             }else{
                    $textErr = "";
                    $textSuc = "";
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    //搜尋資料庫資料
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$email."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);
                      //判斷帳號與密碼是否為空白
                    //以及MySQL資料庫裡是否有這個會員
                    if($row['Email'] != $email)
                    {

                           $textErr = "此帳號不存在！";
                    }else if($row['Password'] != $password)
                    {

                           $textErr = "密碼錯誤！";
                    }else
                    {
                            //將帳號寫入session，方便驗證使用者身份
                            $_SESSION['email'] = $email;
                            $textSuc = "登入成功，等待自動跳轉！";
                    }
                //echo $email.",".$password."<br />";
                //echo $row['Email'].",".$row['Password'];
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
               <li><a href="create.php">註冊</a></li>
               <li><a href="login.php">登入</a></li>
               </ul>
            </div>
    <div id="wrapper">
        <div align=center>
	   <form action="" enctype="multipart/form-data" method="post">
                <fieldset>
                    <legend>HPC會員登入</legend>
                <span>帳號</span><br />
				    <input type="email" name="email"  placeholder="Email" id="email"><br />
                <span>密碼</span><br />
				    <input type="password" name="password"  placeholder="Password" id="password"><br />
               
           </fieldset>
             <?php 
if(!empty($textErr)){
   echo "<p class='error'>".$textErr."</p>";
}else if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}?>
            <input name="action" type="hidden" value="login">
                <input type="submit" value="登入"/>
                <input type="reset" value="取消" onClick="javascript:history.back(1)"/>   
                </form>
   
             </div>
    </div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>