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
?>
<!DOCTYPE html>

<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
       <style>
			.ontop{
				
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
				position: absolute;				
				background-color: #ffffff;
				color: #000000;
				opacity: .9;
				filter: alpha(opacity = 50);
			}
			#popup {
				position: absolute;
				color: #000000;
				background-color: #ffffff;
				/* To align popup window at the center of screen*/
				top: 10%;
				left: 30%;
                opacity: 1;
                text-align: center;
                width: 570px;
			}
		</style>
		<script type="text/javascript">
			function pop(div) {
				document.getElementById(div).style.display = 'block';
			}
			function hide(div) {
				document.getElementById(div).style.display = 'none';
			}
			//To detect escape button
			document.onkeydown = function(evt) {
				evt = evt || window.event;
				if (evt.keyCode == 27) {
					hide('popDiv');
                    hide('popDiv1');
				}
			};
		</script>
		<title>HW5</title>
         <script src="ckeditor/ckeditor.js"></script>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
        <link href="css/table-style.css" type="text/css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
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
                 <p class='post'><a href="#" onClick="pop('popDiv')">發文<img src='img/ic_action_edit.png' height='20'></a></p>
               <?php
//自己的文章才能編輯或刪除
if(isset($_GET['page'])){
     $sql_query1 = "SELECT * FROM `article` WHERE `id` = ".$_GET['id'];
     $result1=mysql_query($sql_query1);
     $row1 = mysql_fetch_assoc($result1);
if($row1['author_id']==$row['id']&&$_GET['page']==2){
echo "   <div class='right'>
                 <p><a class='edit' href='#' onClick='pop(\"popDiv1\")'>編輯<img src='img/ic_action_edit.png' height='20'></a>
                <a class='delete' href='delete.php?id=".$_GET['id']."' onClick=\"return confirm('『確定要刪除嗎？』');\">刪除<img src='img/ic_action_remove.png' height='20'></a></p>
            </div>";
}}
?>            
            </div>

     <div id="Search" >
                <form action="search.php" enctype="multipart/form-data" method="post">
                 <select name="type">
                        <option value="title">搜尋標題</option>
                        <option value="author">搜尋作者</option>
				        <option value="check">搜尋分類</option>
			    </select>
                    <input type="text" name="word" id="word"align="right">
                    <input name="action" type="hidden" value="search">
                    <input class="small" type="submit" value="搜尋" />
                </form>
         
            </div> 
   
            <div id="popDiv" class="ontop">
			<?php
include("post.php");
?>
         
		</div>
             <div id="popDiv1" class="ontop">
			<?php
include("edit.php");
?>
            
		</div>  
            <?php
if(isset($_GET['page'])){
if($_GET['page']==1){
    //include("post.php");
}else if($_GET['page']==2){
    include("read.php");
}else if($_GET['page']==3){
    //include("edit.php");
}
}else
{
    include("page.php");
}
?>
		</div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>