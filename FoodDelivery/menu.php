<?php
include("connMysql.php");
if(isset($_SESSION['email'])){
$sql = "SELECT * FROM `MemberTable` WHERE `MemberEmail` = '".$_SESSION['email']."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
}else{
     header("Location:index.php");  
}

if(isset($_POST["action"])&&($_POST["action"]=="post")){
   
include("menu_cgi.php");//上傳檔案

}

?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="img/fav.png">
		<title>美食快遞 Delivery</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
    <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <link href="css/signin.css" rel="stylesheet">
      <style>
			.ontop {
				z-index: 999;
				width: 100%;
				height: 100%;
				top: 0;
				left: 0;
				display: none;
				position: absolute;				
				background-color: #000;
                opacity: .9;
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
                    hide('popDiv2');
				}
			};
		</script>

	</head>
	<body>
        <div id="header">
          
               <h1><a href="index.php"><img src="img/fav.png" /></a>美食快遞 Delivery</h1>
         <div class="col-md-12">
           <p>
        <div class="row">
        <div class="col-md-4">
            <?php
if(isset($_SESSION['email'])){
     echo '<a href="logout.php" class="btn btn-sm btn-primary" onClick="return confirm(\'確定要登出嗎?\');">Logout</a>';
   
}else {
    echo '<button type="button" class="btn btn-sm btn-primary" onClick="pop(\'popDiv\')">Login</button>';
    
    
}
    
?>
        
            </div>
            <div class="col-md-4">
        <button type="button" class="btn btn-lg btn-success" onClick="pop('popDiv2')">我要號召訂購！</button>
            </div>
            <div class="col-md-4">
        <button type="button"  class="btn btn-sm btn-warning" onClick="pop('popDiv1')">Register</button>
            </div>
             </div>
      </p>
              </div>
        </div>
         
		<div id="wrapper">
  
      
        <div id="popDiv" class="ontop">
			<?php
include("signin.php");
?>
            
		</div>   
  <div id="popDiv1" class="ontop">
			<?php
include("register.php");
?>
            
		</div>   
             <div id="popDiv2" class="ontop">
			<?php
include("order.php");
?>
            
		</div>  
            
           <div class="col-md-4" align=center>
                <h2 class="form-signin-heading">Your Menu</h2>
               <?php
//Menu
$sqlMenu= "SELECT * FROM `MenuTable`  WHERE `MemberID` = '".$row['MemberID']."'";
$resultMenu = mysql_query($sqlMenu);
$numMenu =mysql_num_rows($resultMenu);//數量

if($numMenu>0){
    echo '<table cellpadding="10" cellspacing="0">
              <tr class="title">
                <th><span>現有分類</span></th>
                <th><span>功能</span></th>
            </tr>  ';
    while($rowMenu = mysql_fetch_assoc($resultMenu)){
        echo '<tr>
                  <td><p>'.$rowMenu["MenuName"].'</p></td>
                  <td><p><a  href="menu_delete.php?MenuID='.$rowMenu["MenuID"].'&MemberID='.$row['MemberID'].'" onClick="return confirm(\'確定要取消嗎？\');">刪除</a></p></td>
                </tr>';
       
    }
    echo '</table>';
}else{
    echo "目前尚未新增Menu.";
}
?>
            </div>
             <div>

      <form action="" enctype="multipart/form-data" method="post" class="form-signin" name="menu" id="menu">
        <h2 class="form-signin-heading">New Menu</h2>
           <label for="inputName" class="sr-only">Menu名稱</label>
        <input type="text" name="inputName" id="inputName" class="form-control" placeholder="Menu名稱" required autofocus>
         <label for="inputPhone" class="sr-only">Phone</label>
        <input type="number" name="inputPhone" id="inputPhone" class="form-control" placeholder="Menu電話" required>
         <h5 class="form-signin-heading">Menu選項</h2>
          <div class="col-md-8">  
        <input type="text" name="Item[]" class="form-control" placeholder="名稱" required></div>
          <div class="col-md-4">  
        <input type="number" name="Price[]" class="form-control" placeholder="價位" required></div>
            <div class="col-md-8">  
        <input type="text" name="Item[]" class="form-control" placeholder="名稱" required></div>
          <div class="col-md-4">  
        <input type="number" name="Price[]" class="form-control" placeholder="價位" required></div>
            <div class="col-md-8">  
        <input type="text" name="Item[]" class="form-control" placeholder="名稱" required></div>
          <div class="col-md-4">  
        <input type="number" name="Price[]" class="form-control" placeholder="價位" required></div>
          <span id="fieldSpace"></span>  
	<a href="javascript:" onclick="addField()">新增選項</a> 
	<a href="javascript:" onclick="delField()">刪除選項</a> 
        <div class="checkbox">
       
        </div>
          <input name="action" type="hidden" value="post">
          <?php

          echo '<input name="MemberID" type="hidden" value="'.$row['MemberID'].'">';
              ?>
        <input type="submit"  class="btn btn-lg btn-primary btn-block">
           <input type="reset" class="btn btn-lg btn-default btn-block">
      </form>
	<script>  
 	var countMin = 1;  
  	var countMax = 100; 
  	var count = countMin  
  	function addField() {  
  	    if(count == countMax)  
	        alert("最多"+countMax+"個欄位");  
	    else
        {
            count+=2;
	       var div1= document.createElement('div');
    div1.innerHTML = '<input type="text" name="Item[]" class="form-control" placeholder="名稱" required>';
    div1.className = 'col-md-8';
var div2= document.createElement('div');
    div2.innerHTML = '<input type="number" name="Price[]" class="form-control" placeholder="價位" required>';
    div2.className = 'col-md-4';
document.getElementById("fieldSpace").appendChild(div1);
document.getElementById("fieldSpace").appendChild(div2);  
            
        }
	} 
	function delField() { 
	    if (count >= countMin) {  
	        document.getElementById("fieldSpace").removeChild(document.getElementById("fieldSpace").lastChild); 
            document.getElementById("fieldSpace").removeChild(document.getElementById("fieldSpace").lastChild); 
	        count-=2; 
	    }    
	} 
	</script> 
               
    </div> <!-- /container -->
            
		</div><!-- wrapper page -->
      
	</body>
</html>