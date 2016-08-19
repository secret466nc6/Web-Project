<?php

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
//擷取Mysql資料並轉換成JSON資料
$sqldata = mysql_query("select * from `article` where `id`=".$_GET["id"]);
$rows = array();
while($r = mysql_fetch_assoc($sqldata)) {
  $rows[] = $r;
}
//轉換成JSON資料
$data = json_encode($rows);
//解析JSON資料
$data1 = json_decode($data,true);
$classification= $data1[0]['classification'];
$title= $data1[0]['title'];
$content= $data1[0]['content'];

/*
if(isset($_POST["action"])&&($_POST["action"]=="edit")){
    if(empty($_POST["title"])||empty($_POST["content"])) {
        $textErr = "請確實填寫所有欄位！";
      }else {
        include("post_edit.php");//上傳檔案       
}
}      */         
?>

<script type="text/javascript">
function GoajaxEdit(id)
{
                if(edit.title.value == "") 
                {
                        alert("未輸入標題");
                }
                else if(CKEDITOR.instances.content1.getData() == "" )
                {
                        alert("未輸入內容");
                }else{
          
                    var title=edit.title.value;
                   //alert(title);
                    var content = CKEDITOR.instances.content1.getData();
                   //alert(content);
                     var strChoices = [];
  var objCBarray = document.getElementById('edit')['check[]'];
    
  for (i = 0; i < objCBarray.length; i++) {
    if (objCBarray[i].checked) {
      strChoices[i]= objCBarray[i].value;
        //alert(strChoices[i]);   
    }
  }
	$.ajax({
	type: "POST",
	dataType: "json",
	url: "post_edit.php",
	data:{title:title,content:content,check:strChoices,id:id},
	success: function(data) {
		var MSg = "title："+ data["title"] + "，content："+data["content"]+ "，check："+data["check"]+ "，id："+data["id"];
		MSg += "<br/>JSON格式資料："+data['json'];
		MSg += "<br/>新增的自訂變數status="+data['status'];
		$(".the-return").html(MSg);
        document.getElementById('popDiv1').style.display = 'none';
        document.getElementById('popDiv').style.display = 'none';
        location.reload();
	},
	error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
	});	
                }
}
</script>
        <div align=center >
	   <form name="edit" id="edit" action="" enctype="multipart/form-data" method="post"  id="popup">
                <fieldset>
                    <legend>編輯文章</legend>
                    <span class="title">標題</span><br />
                    <?php
echo '<input class="post" type="text" name="title"  placeholder="title" id="title" maxlength="45" value="'.$title.'">';

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
				    echo '<textarea type="content" name="content1" id="content1" cols="20" rows="4" placeholder="content" >'.$content.'</textarea>';
                        ?>

                    <br />
                    <script>
CKEDITOR.replace( 'content1', {});
</script>
                    <?

                   /* <hr />
                    <span class="title">※(optional)</span><br />
                <span class="title"> 選擇上傳Paper(word,pdf)</span><br />
                    <input id="file" name="file" type="file"><br />
                    <span class="title"> 選擇上傳PowerPoint(ppt,pdf)</span><br />
                    <input id="file1" name="file1" type="file"><br />
                    <span class="title">※需同時上傳Paper和PowerPoint檔案</span><br />*/
               ?>
           </fieldset>
                            <?php 
if(!empty($textErr)){
   echo "<p class='error'>".$textErr."</p>";
}else if(!empty($textSuc)){
   echo "<p class='success'>".$textSuc."</p>";
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php?page=2&id='.$_GET["id"].'>';
}?>
                
                <input name="action" type="hidden" value="edit">
                <input type="hidden" name="submit" value="true">
           <?php
                echo '<input type="button" class="submit" value="修改文章" onclick="GoajaxEdit('.$_GET["id"].');"/>';
           
                echo '<input type="reset" value="取消" onClick="javascript:location.href=\'index.php?page=2&id='.$_GET["id"].'\'"/>'; 
                    ?>
           <div class="the-return">
                [HTML is replaced when successful.]
                </div>
                </form>

             </div>
   