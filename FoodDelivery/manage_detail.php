<?php
include("connMysql.php");
if(isset($_SESSION['email'])){
$sql = "SELECT * FROM `MemberTable` WHERE `MemberEmail` = '".$_SESSION['email']."'";
$result = mysql_query($sql);
$row = mysql_fetch_assoc($result);
}else{
    echo "<script>alert('請先登入!');
            window.location.href = 'index.php';</script>";

    
}
//Order
$sqlOrder = "SELECT * FROM `OrderTable` WHERE `OrderID` = '".$_GET['OrderID']."'";
$resultOrder = mysql_query($sqlOrder);
$rowOrder = mysql_fetch_assoc($resultOrder);
//Menu
$sqlMenu= "SELECT * FROM `MenuTable` WHERE `MenuName` = '".$rowOrder['MenuName']."'";
$resultMenu = mysql_query($sqlMenu);
$rowMenu = mysql_fetch_assoc($resultMenu);
//Count
$sqlCount= "SELECT * FROM `CountTable` WHERE `MemberID` = '".$_GET['MemberID']."' AND `OrderID` = '".$_GET['OrderID']."'";
$resultCount = mysql_query($sqlCount);
$rowCount = mysql_fetch_assoc($resultCount);
$numCount =mysql_num_rows($resultCount);//數量
//CountPrice
$sqlCountOrder= "SELECT * FROM `CountTable` WHERE `OrderID` = '".$_GET['OrderID']."'";
$resultCountOrder = mysql_query($sqlCountOrder);
$numCountOrder =mysql_num_rows($resultCountOrder);//數量

if(isset($_POST["action"])&&($_POST["action"]=="post")){
   
include("manage_detail_cgi.php");
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
           
             <div>

      <form action="" enctype="multipart/form-data" method="post" class="form-signin" name="menu" id="menu">
           <h2 class="sub-header"><?php echo $rowOrder['OrderName']; ?></h2>
          <p>訂餐地點：<?php echo $rowOrder['MenuName']; ?></p>
          <p>取餐地點：<?php echo $rowOrder['OrderPlace']; ?></p>
          <p>開始時間：<?php echo $rowOrder['dtmCreate']; ?></p>
          <p>結束時間：<?php echo $rowOrder['dtmEnd']; ?></p>
          <p  style="color:blue;">訂購電話：<?php echo $rowMenu['MenuPhone']; ?></p>
     <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>項目</th>
                  <th>價格</th>
                  <th>總數</th>
            
                </tr>
              </thead>
              <tbody>
                  <?php
$strItem = $rowMenu["MenuItem"];
$MenuItem = explode(",", $strItem);

$strPrice = $rowMenu["MenuPrice"];
$MenuPrice = explode(",", $strPrice);
$strCount = $rowCount["MenuCount"];
$MenuCount = explode(",", $strCount);


            $flag=0;
            while($rowCountOrder = mysql_fetch_assoc($resultCountOrder)){
                $strCountOrder = $rowCountOrder["MenuCount"];
                $MenuCountOrder = explode(",", $strCountOrder);
                if($flag==0){//第一次執行 讓TotalNum陣列裡面全=0
                     for($i=0;$i<count($MenuCountOrder);$i++){
                        $TotalNum[$i]=0;//規0          
                     }
                    $flag=1;
                }
        
            for($i=0;$i<count($MenuCountOrder);$i++){
                $TotalNum[$i]+=$MenuCountOrder[$i];
            }
            }
$TotalPrice=0;
for($i=0;$i<count($MenuItem);$i++){

    echo ' <tr>
                  <td>'.$MenuItem[$i].'</td>
                  <td>'.$MenuPrice[$i].'</td>';
        if($numCountOrder>0){
            

        echo "<td>".$TotalNum[$i]."</td>";
             $TotalPrice+=$TotalNum[$i]*$MenuPrice[$i];
        }else
        echo "<td>0</td>";
                  
       
                  
                echo '</tr>';
}
echo "<tr><td></td><td>總計</td><td>".$TotalPrice."</td></tr>";
                  ?>
               
               
              </tbody>
            </table>
          </div>

           <input name="action" type="hidden" value="post">
          <?php
           if($rowOrder['MenuArrive']==0){
           echo  '<input type="submit"  value="完成訂單" class="btn btn-warning btn-block" onClick="return confirm(\'確定要送出嗎？\');">';
          
          }else{
           echo  '<input type="submit"  value="訂單成功" class="btn btn-success btn-block" onClick="return confirm(\'確定要送出嗎？\');">';
          }
 echo  '<a  href="manage_detail_delete.php?OrderID='.$_GET['OrderID'].'&MemberID='.$_GET['MemberID'].'" class="btn btn-default btn-block" onClick="return confirm(\'確定要刪除嗎？\');">刪除訂單</a>';
      ?>
           
      </form>
	
               
    </div> <!-- /container -->
            
		</div><!-- wrapper page -->
      
	</body>
</html>