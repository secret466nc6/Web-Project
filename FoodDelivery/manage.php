<?php
include("connMysql.php");
if(isset($_SESSION['email'])){
$sql = "SELECT * FROM `MemberTable` WHERE `MemberEmail` = '".$_SESSION['email']."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
}
$datetime= date("Y/m/d H:i:s");

?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="img/fav.png">
		<title>美食快遞 Delivery</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
        <link href="css/signin.css" rel="stylesheet">
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
        <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
       
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
            function pop1(div) {
                   <?php
if(!isset($_SESSION['email']))
    echo "alert('請先登入!');";
else
    echo "document.getElementById(div).style.display = 'block';";
?>
				
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
        <button type="button" class="btn btn-lg btn-success" onClick="pop1('popDiv2')">我要號召訂購！</button>
            </div>
            <div class="col-md-4">
        <button type="button"  class="btn btn-sm btn-warning" onClick="pop('popDiv1')">Register</button>
            </div>
             </div>
      </p>
              </div>
        </div>
         
		<div id="wrapper">
            
            <?php

             if(isset($_SESSION['email'])){
echo '<a href="menu.php" class="btn btn-lg btn-link">按此新增/管理Menu</a>';
           echo '<a href="manage.php" class="btn btn-lg btn-link">按此管理訂單</a>';
             }

$sqlOrder = "SELECT * FROM `OrderTable` WHERE `OrderTable`.`MemberID`= '".$row['MemberID']."'";
$resultOrder = mysql_query($sqlOrder);
$numOrder=mysql_num_rows($resultOrder);
             echo '<div class="alert alert-success" role="alert">
        <strong> Hi! '.$row['MemberName'].'</strong> 管理你的訂單~
      </div>    ';
  

?>         
       
          
            
     
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
            
		
            <div class="row">
       
            
 <?php
while($rowOrder = mysql_fetch_assoc($resultOrder)){
          echo '<div class="col-sm-4">
          <div class="list-group">
            <p class="list-group-item active">
             '.$rowOrder['OrderName'].'
            </p>';
    $sqlMember = "SELECT * FROM `MemberTable` WHERE `MemberID` = '".$rowOrder['MemberID']."'";
$resultMember = mysql_query($sqlMember);
$rowMember = mysql_fetch_assoc($resultMember);
            echo '<p class="list-group-item">發起人：'.$rowMember['MemberName'].'</p>
            <p class="list-group-item">訂餐地點：'.$rowOrder['MenuName'].'</p>
            <p class="list-group-item">取餐地點：'.$rowOrder['OrderPlace'].'</p>
            <p class="list-group-item">開始時間：'.$rowOrder['dtmCreate'].'</p>
            <p class="list-group-item">結束時間：'.$rowOrder['dtmEnd'].'</p>
            <p class="list-group-item">';
    //Count
    if(isset($_SESSION['email'])){
$sqlCount= "SELECT * FROM `CountTable` WHERE `MemberID` = '".$row['MemberID']."' AND `OrderID` = '".$rowOrder['OrderID']."'";
$resultCount = mysql_query($sqlCount);
        //$numCount =mysql_num_rows($resultCount);//數量}
        $MemberID=$row['MemberID'];
    }else{
        $numCount=0;
        $MemberID=0;
        }
if($rowOrder['MenuArrive']==0){
          echo  '<a class="btn btn-default" href="manage_detail.php?OrderID='.$rowOrder['OrderID'].'&MemberID='.$MemberID.'" role="button">View Detail &raquo;</a></p></div></div>';
}else {
     echo  '<a class="btn btn-success" href="manage_detail.php?OrderID='.$rowOrder['OrderID'].'&MemberID='.$MemberID.'" role="button">Success &raquo;</a></p></div></div>';
}
  
          
    }
              ?>
      
      </div>
		</div><!-- wrapper page -->
      
	</body>
</html>