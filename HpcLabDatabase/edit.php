
<!DOCTYPE html>
<?php
session_start();  // 啟動Session
if (!isset($_SESSION['email']))
    header("Location:login.php");  //跳回你要登入的頁面
			include("connMysql.php");
            $textErr = "";
            $textSuc = "";
 $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);
if(!isset($_GET["id"]))
     header("Location:index.php");  
$sql_db ="select * from `article` where `id`=".$_GET["id"];
        $result=mysql_query($sql_db);
        $row_result=mysql_fetch_assoc($result);
if(isset($_POST["action"])&&($_POST["action"]=="edit")){
    if(empty($_POST["title"])||empty($_POST["content"])) {
        $textErr = "請確實填寫所有欄位！";
      }else {
        include("post_edit.php");//上傳檔案       
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
                    <legend>編輯文章</legend>
                    <span class="title">標題</span><br />
                    <?php
echo '<input class="post" type="text" name="title"  placeholder="title" id="title" maxlength="200" value="'.$row_result["title"].'">';
?>
                    
				    <br />
                    <span class="title">文章分類(optional)</span><br />
                    <?php
                $sql_query = "SELECT * FROM `setting`";
                $result = mysql_query($sql_query);
$strcheck = $row_result["classification"];
$outcheck = explode(",", $strcheck);
$outcount=0;
				while($row_result1=mysql_fetch_assoc($result)){		
                    if(strcmp($outcheck[$outcount],$row_result1["classification"])==0){
					echo '<div class="item"><input type="checkbox"  checked="checked" name="check[]"  value="'.$row_result1["classification"].'"><label class="marker_label">'.$row_result1["classification"].'</label></div>';
                        if($outcount+1<count($outcheck)){
                            $outcount++;}
                    }else {
                        echo '<div class="item"><input type="checkbox"  name="check[]"  value="'.$row_result1["classification"].'"><label class="marker_label">'.$row_result1["classification"].'</label></div>';
                    }
				}
			?><br />
                <span class="title">內容</span><br />
                    <?php
				    echo '<textarea type="content" name="content"  cols="20" rows="4" placeholder="content" id="content">'.$row_result["content"].'</textarea>';
                        ?>
                    <br /><hr />
                    <span class="title">※(optional)</span><br />
                <span class="title"> 選擇上傳Paper(word,pdf)</span><br />
                    <input id="file" name="file" type="file"><br />
                    <span class="title"> 選擇上傳PowerPoint(ppt,pdf)</span><br />
                    <input id="file1" name="file1" type="file"><br />
                    <span class="title">※需同時上傳Paper和PowerPoint檔案</span><br />
               
           </fieldset>
                            <?php 
if(!empty($textErr)){
   echo "<p class='error'>".$textErr."</p>";
}else if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=read.php?id='.$_GET["id"].'>';
}?>
                <input name="action" type="hidden" value="edit">
           
                <input type="submit" value="修改文章"/>
                <input type="reset" value="取消" onClick="javascript:history.back(1)"/>   
                </form>

             </div>
    </div><!-- .page -->
          <div id="footer">
              <p align=center>CCU CSIE | HPC LAB, POWER BY &copy<a href="mailto:secret466nc6@gmail.com">secret466nc6</a></span></p>
		    </div>
	</body>
</html>