<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
include("connMysql.php");
 //搜尋資料庫資料
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);
                    //判斷帳號與密碼是否為空白
                    //以及MySQL資料庫裡是否有這個會員
if(isset($_POST["action"])&&($_POST["action"]=="search")){
                if($_POST["type"]=='title'){
				$sql_query = "SELECT * FROM `article` WHERE `title` LIKE '%".$_POST["word"]."%' ORDER BY `article`.`last_update` DESC";
                $search_result=mysql_query($sql_query);
                }else if($_POST["type"]=='author'){
                    //取出作者名
                    $sql1 = "SELECT * FROM `user` WHERE `Name` LIKE '%".$_POST["word"]."%'";
                    $result1 = mysql_query($sql1);
                    $row1 = mysql_fetch_assoc($result1);
				$sql_query = "SELECT * FROM `article` WHERE `author_id` = '".$row1["id"]."' ORDER BY `article`.`last_update` DESC";
                $search_result=mysql_query($sql_query);
                }else if($_POST["type"]=='check'){
				$sql_query = "SELECT * FROM `article` WHERE `classification` LIKE '%".$_POST["word"]."%' ORDER BY `article`.`last_update` DESC";
                $search_result=mysql_query($sql_query);
                }}else if(isset($_GET["id"])){
        $sql_query = "SELECT * FROM `article` WHERE `author_id` = '".$_GET["id"]."' ORDER BY `article`.`last_update` DESC";
                $search_result=mysql_query($sql_query);
    
}
?>
<!DOCTYPE html>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        
		<title>HW5</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
        <link href="css/table-style.css" type="text/css" rel="stylesheet" />
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
            <div class="left">
	<?php
        echo "<p class='hi'>Welcome, ".$row['Name']."！</p>";
     ?>
            </div> 
             <div class="right">
                 <p class='post'><a href='post.php'>發文<img src='img/ic_action_edit.png' height='20'></a></p>
            </div>
	
     <div id="Search" >
                <form action="search.php" enctype="multipart/form-data" method="post">
                 <select name="type">
                     <?php
                if(isset($_POST["action"])&&($_POST["action"]=="search")){
                if($_POST["type"]=='title'){
                     echo '<option value="title" selected>搜尋標題</option>';
                        echo '<option value="author">搜尋作者</option>';
				        echo '<option value="check">搜尋分類</option>';
                }else if($_POST["type"]=='author'){
                    echo '<option value="title">搜尋標題</option>';
                        echo '<option value="author" selected>搜尋作者</option>';
				        echo '<option value="check">搜尋分類</option>';
                }else if($_POST["type"]=='check'){
                    echo '<option value="title">搜尋標題</option>';
                        echo '<option value="author">搜尋作者</option>';
				        echo '<option value="check" selected>搜尋分類</option>';
                }}else{
                        echo '<option value="title" selected>搜尋標題</option>';
                        echo '<option value="author">搜尋作者</option>';
				        echo '<option value="check">搜尋分類</option>';
                }
                            ?>
			    </select><?php
if(isset($_POST["word"])){
                    echo '<input type="text" name="word" id="word" align="right" value="'.$_POST["word"].'">';
}else
    echo '<input type="text" name="word" id="word" align="right">';
                        ?>
                    <input name="action" type="hidden" value="search">
                    <input class="small" type="submit" value="搜尋" />
                </form>
            </div> 
            <div id="content">

                
              <div class="table-title">
                  <?php
if(isset($_POST["word"])){
                    echo '<h3>搜尋文章列表</h3>';
}else
    echo '<h3>個人文章列表</h3>';     
?>

</div>
            <table class="table-fill" width="750" cellpadding="10" cellspacing="0" >
                <thead>
            <tr class="title">
                <th class="text-left" width="95">發表日期</th>
                <th class="text-left" width="50">作者</th>
                <th class="text-left">標題</th>
                <th class="text-left" width="50">回覆</th>
                <th class="text-left" width="160">最後更新/回覆</th>
                    </tr></thead>
              <?php
 
				while($row_result=mysql_fetch_assoc($search_result)){
					echo "<tr>";
					echo "<td class='text-left'>".$row_result["create_time"]."</td>";
                    $sql1 = "SELECT * FROM `user` WHERE `id` = ".$row_result["author_id"];
                    $result1 = mysql_query($sql1);
                    $row1 = mysql_fetch_assoc($result1);
                    echo "<td class='text-left'>".$row1['Name']."</td>";
					echo "<td class='text-left'><a href='read.php?id=".$row_result["id"]."'>".$row_result["title"]."</a></td>";
				     $sql2 = "SELECT * FROM `response` WHERE `article_id` = ".$row_result['id'];
                    $result2 = mysql_query($sql2);
                    $num_rows = mysql_num_rows($result2);
				    echo "<td class='text-left'>".$num_rows."</td>";
                    echo "<td class='text-left'>".$row_result["last_update"]."</td>";
					echo "</tr>";
				}
			?>
                
                    </table>
            </div>
		</div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>