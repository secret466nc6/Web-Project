<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
include("connMysql.php");
 $textErr = "";
$textSuc = "";
 //搜尋資料庫資料
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);

                if(isset($_POST["action"])&&($_POST["action"]=="upload")){
                    if(empty($_POST["classification"])) {
        $textErr = "請確實填寫所有欄位！";
                    }else {
                   //寫入DB
            include("connMysql.php");
	$sql_query ="INSERT INTO `s604410071`.`setting` (`id`, `classification`)
	VALUES
	(NULL, '".$_POST["classification"]."')";
	mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
                        $textSuc = "現有分類會成為您的文章內的分類項目！";
                    }
            }
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
                    
                    <form action="setting.php" enctype="multipart/form-data" method="post">
           
           
                         <fieldset>
                    <legend>新增分類項目</legend>
				    <input type="text" name="classification" id="classification"><br />
                         <?php 
if(!empty($textErr)){
   echo "<p class='error'>".$textErr."</p>";
}?>
                              </fieldset>   
                        <input name="action" type="hidden" value="upload">
                <input type="submit" value="新增"/> 
                             <input type="reset" value="取消" onClick="javascript:history.back(1)"/>   
                        
                        </form><br /><hr/><p class='post'><a href='post.php'>發文<img src='img/ic_action_edit.png' height='20'></a></p>
               <table class="setting" cellpadding="10" cellspacing="0" >
                    
            <tr class="title">
                <th>現有分類</th>
                <th>功能</th>
            </tr>   
           <?php
                include("connMysql.php");
                $sql_query = "SELECT * FROM `setting`";
                $result = mysql_query($sql_query);
$num_rows = mysql_num_rows($result);
                if($num_rows==0)
                        echo "<tr colspan='2'><td>目前尚無分類</td></tr>";
				while($row_result=mysql_fetch_assoc($result)){
                    
					echo "<tr>";
                  
					echo "<td>".$row_result["classification"]."</td>";
					echo "<td><a href='setting-update.php?id=".$row_result["id"]."'>修改</a>";
                    echo " ";
					echo "<a href='setting-delete.php?id=".$row_result["id"]."' onClick=\"return confirm('『確定要刪除嗎？』');\">刪除</a></td>";
					echo "</tr>";
				}
			?>
                 
            </table>
                          <?php 
if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
}?>
                       
            </div>
            
		</div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>