<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
include("connMysql.php");
 $textErr = "";
if(!isset($_GET["id"]))
     header("Location:index.php");  
 //搜尋資料庫資料
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);

                if(isset($_POST["action"])&&($_POST["action"]=="update")){//update
                    if(empty($_POST["classification"])) {
        $textErr = "欄位請勿空白！";
                    }else {
                   //更改DB
                        $sql_query = "UPDATE `s604410071`.`setting` SET `classification` = '".$_POST["classification"]."' WHERE `setting`.`id` = ".$_POST["id"]; 
                        mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
                        header("Location: setting.php");
                    }
            }
            $sql_db ="select * from `setting` where `id`=".$_GET["id"];
			$result=mysql_query($sql_db);
            $row_result=mysql_fetch_assoc($result);
                ?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
		<title>HW3</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
	</head>
	<body>
            <div id="header">
               <dfn><a href="index.php"> <img src="img/Hpc-logo-2_web.png" ></a></dfn>
               <ul>
                  <li><a href="setting.php"><img src="img/ic_action_overflow.png"  height='20'></a></li>
               <li><a href="logout.php">登出</a></li>
                   <li>	<?php 
echo '<a href="search.php?id='.$row["id"].'">';
echo $row['Name']; ?></a></li>  
               </ul>
            </div>
           
		<div id="wrapper">
         
	   <div align=center>
                   
                    <form action="" enctype="multipart/form-data" method="post">
           
           
                         <fieldset>
                    <legend>新增分類項目</legend>
                            <?php 
                                echo "<input type=\"text\" name=\"classification\" id=\"classification\" value=\"".$row_result["classification"]."\">";
                                echo "<input name=\"id\" type=\"hidden\" value=\"".$row_result["id"]."\">";
                                if(!empty($textErr)){
                                   echo "<p class='error'>".$textErr."</p>";
                                }
                             ?>
                <input name="action" type="hidden" value="update">
                <input type="submit" value="修改"/> 
                        </form><br />
      
                 
            </table>
                        </fieldset>   
            </div>
		</div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>