<?php
if(!isset($_GET["id"]))
     header("Location:index.php");  
 //搜尋資料庫資料
                    $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);
                    //判斷帳號與密碼是否為空白
                    //以及MySQL資料庫裡是否有這個會員
                    $sql_query1 = "SELECT * FROM `article` WHERE `id` = ".$_GET['id'];
                    $result1=mysql_query($sql_query1);
                    $row1 = mysql_fetch_assoc($result1);
                    $sql_query2 = "SELECT * FROM `user` WHERE `id` = ".$row1['author_id'];
                    $result2=mysql_query($sql_query2);
                    $row2 = mysql_fetch_assoc($result2);

//張貼留言
if(isset($_POST["action"])&&($_POST["action"]=="response")){
    if(empty($_POST["message"])) {
       //do nothing
    }else {
        
     $datetime= date("Y/m/d H:i:s");
     $sql_query = "INSERT INTO `s604410071`.`response` (`id`, `article_id`, `user_id`, `message`, `time`) 
     VALUES (NULL, '".$_GET['id']."', '".$row['id']."', '".$_POST['message']."', '".$datetime."')";
     mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
        
      $sql_query =  "UPDATE `s604410071`.`article` SET `last_update` = '".$datetime."' WHERE `article`.`id` = ".$_GET['id'].";";
       mysql_query($sql_query) or die("無法送出" . mysql_error( )); 

}
}            

?>
           
            
            <div id="article" align=left>
                 
                 <div class="table-title">
                  
                     <?php


echo "<h3>".$row1['title']."</h3>";
echo "<p><b>".$row2['Name']."</b> <i>Last Updated On</i><b> ".$row1['last_update']."</b></p>";
if(!empty($row1['classification']))
    echo "<p><b>分類 :</b> ".$row1['classification']."</p>";
else
    echo "<p><b>未分類</b> "; 
echo "</div><hr />";
    
echo "<p>".nl2br($row1['content'])."</p><hr />";
?>
                     
                <?php
/*
                     <h3><img src='img/ic_action_important.png' height='20'>下載檔案</h3>
                     
if(!empty($row1['file_name'])&&!empty($row1['file_name1'])){
echo "<a href='downloadfile.php?file=".$row1['file_name']."'>Paper</a>";
echo " , <a href='downloadfile.php?file=".$row1['file_name1']."'>PowerPoint</a>";
}else
    echo "無檔案";*/
?>
                     
          <h3><img src='img/ic_action_chat.png' height='20'>張貼留言</h3>
                   
<form action="" enctype="multipart/form-data" method="post">
      <?php
        echo $row['Name']." : ";
     ?>
    
                    <input type="text"  style=width:300px name="message" id="message" maxlength="50"> 
                    <input name="action" type="hidden" value="response">
                    <input class="small" type="submit" value="發布" />
                </form>
                
            </div>
                <table class="table-fill" cellpadding="10" cellspacing="0" >
                <div class="line">

                </div>
               <?php
                $sql_query = "SELECT * FROM `response` WHERE `article_id` = ".$_GET['id']." ORDER BY `response`.`time` DESC";
                $result=mysql_query($sql_query);
				while($row_result=mysql_fetch_assoc($result)){
                    //author name
                    $sql_query3 = "SELECT * FROM `user` WHERE `id` = ".$row_result['user_id'];
                    $result3=mysql_query($sql_query3);
                    $row3 = mysql_fetch_assoc($result3);
					echo "<tr>";
					echo "<td class='text-left' width='100'>".$row3["Name"]." : </td>";
                    echo "<td class='text-left'>".$row_result['message']."</td>";
                    echo "<td class='text-left' width='200'>".$row_result['time']."</td>";
					echo "</tr>";
				}
			?>
                     </table> 
                </div>
		