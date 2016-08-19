<?php

            $textErr = "";
            $textSuc = "";
 $sql = "SELECT * FROM `user` WHERE `Email` = '".$_SESSION['email']."'";
                    $result = mysql_query($sql);
                    $row = mysql_fetch_assoc($result);

/*
if(isset($_POST["action"])&&($_POST["action"]=="post")){
    if(empty($_POST["title"])||empty($_POST["content"])) {
        $textErr = "請確實填寫所有欄位！";
      }else {
include("post_upload.php");//上傳檔案
}
}   */            
?>

	
<script type="text/javascript">
function GoajaxPost(id)
{
    //console.log("123");
    //var editor = CKEDITOR.editor.replace('content');
    //var value = editor.getData();
    //alert(CKEDITOR.instances.content.getData());
                if(posta.title.value == "") 
                {
                    
                    alert("未輸入標題");
                }
                else if(CKEDITOR.instances.content.getData() == "" )
                {
                    alert("未輸入內容");
                }else{
          
                    var title=posta.title.value;
                   //alert(title);
                    var content = CKEDITOR.instances.content.getData();
                   //alert(content);
                     var strChoices = [];
  var objCBarray = document.getElementById('posta')['check[]'];
    
  for (i = 0; i < objCBarray.length; i++) {
    if (objCBarray[i].checked) {
      strChoices[i]= objCBarray[i].value;
        //alert(strChoices[i]);   
    }
  }
	$.ajax({
	type: "POST",
	dataType: "json",
	url: "post_upload.php",
	data:{title:title,content:content,check:strChoices,id:id},
	success: function(data) {
		var MSg = "title："+ data["title"] + "，content："+data["content"]+ "，check："+data["check"]+ "，id："+data["id"];
		MSg += "<br/>JSON格式資料："+data['json'];
		MSg += "<br/>新增的自訂變數status="+data['status'];
		$(".the-return").html(MSg);
        document.getElementById('popDiv1').style.display = 'none';
         document.getElementById('popDiv').style.display = 'none';
        location.reload() ;
	},
	error: function (xhr, ajaxOptions, thrownError) {
        alert(xhr.status);
        alert(thrownError);
      }
	});	
                }
}
</script>
        <div align=center>
	   <form action="" name="posta" id="posta" enctype="multipart/form-data" method="post" id="popup">
                <fieldset>
                    <legend>發表新文章</legend>
                    <span class="title">標題</span><br />
				    <input class="post" type="text" name="title" id="title"  placeholder="title" id="title" maxlength="45"><br />
                    <span class="title">文章分類(optional)</span><br />
                    <?php
                $sql_query = "SELECT * FROM `setting`";
                $result = mysql_query($sql_query);
				while($row_result=mysql_fetch_assoc($result)){			
					echo '<div class="item"><input type="checkbox"  name="check[]"  value="'.$row_result["classification"].'"><label class="marker_label">'.$row_result["classification"].'</label></div>';
				}
			?><br />
                <span class="title">內容</span><br />
				    <textarea type="content" name="content"  id="content" cols="20" rows="4" placeholder="content" id="content"></textarea>
                  <script>
CKEDITOR.replace( 'content', {});
</script>
                    <br />
                    <?

                    /*<hr />
                    
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
    echo '<meta http-equiv=REFRESH CONTENT=1;url=index.php>';
}?>
                <input name="action" type="hidden" value="post">
           <?
                echo '<input type="button" class="submit" value="發表文章" onclick="GoajaxPost('.$row["id"].');" />';
                    ?>
                <input type="reset" value="取消" onClick="javascript:location.href='index.php'"/> 
           <div class="the-return">
                [HTML is replaced when successful.]
                </div>
                </form>

             </div>