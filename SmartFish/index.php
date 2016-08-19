<?php
include("connMysql.php");
$Controlrow = mysql_fetch_assoc($Controlresult);

if(isset($_POST["action"])&&($_POST["action"]=="post")){
   
include("update.php");//上傳檔案

}
?>
<html>
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link rel="icon" href="img/fav.png">
		<title>HPC 智慧水族控制系統</title>
		<link href="css/styles.css" type="text/css" rel="stylesheet" />
        <link href="css/signin.css" rel="stylesheet">
        <link href="css/bootstrap.css" type="text/css" rel="stylesheet" />
   

	</head>
	<body>
        <div id="header" >
          
               <h1><a href="index.php"><img src="img/fav.png" /></a>HPC 智慧水族控制系統</h1>
     
        </div>
         
		<div id="wrapper">
            
       <div class="col-sm-12">
            <div class="container">

      <form action="" enctype="multipart/form-data" method="post" class="form-signin" name="fishform" id="fishform">
        <h2 class="form-signin-heading">設定智慧控制參數</h2>
        換水時間:
        <input type="time" name="inputWaterTime" class="form-control" placeholder="select a time" value="<?php echo $Controlrow['ControlWaterTime'];?>" required>
          換水週期(天):
          <select  class="form-control" name="inputWaterDay">
             <option value="1" <?php if($Controlrow['ControlWaterDay']==1) echo "selected"?>>1d</option>
                  <option value="2"<?php if($Controlrow['ControlWaterDay']==2) echo "selected"?>>2d</option>
                  <option value="3"<?php if($Controlrow['ControlWaterDay']==3) echo "selected"?>>3d</option>
                  <option value="4"<?php if($Controlrow['ControlWaterDay']==4) echo "selected"?>>4d</option>
              <option value="5"<?php if($Controlrow['ControlWaterDay']==5) echo "selected"?>>5d</option>
              <option value="6"<?php if($Controlrow['ControlWaterDay']==6) echo "selected"?>>6d</option>
              <option value="7"<?php if($Controlrow['ControlWaterDay']==7) echo "selected"?>>7d</option>
                   
                </select>
           餵食時間:
        <input type="time" name="inputFoodTime" class="form-control" value="<?php echo $Controlrow['ControlFoodTime'];?>" placeholder="select a time" required>
          餵食間距(小時):
          <select  class="form-control" name="inputFoodHour">
               <option value="3" <?php if($Controlrow['ControlFoodHour']==3) echo "selected"?>>3h</option>
                  <option value="6"<?php if($Controlrow['ControlFoodHour']==6) echo "selected"?>>6h</option>
                  <option value="9"<?php if($Controlrow['ControlFoodHour']==9) echo "selected"?>>9h</option>
                  <option value="12"<?php if($Controlrow['ControlFoodHour']==12) echo "selected"?>>12h</option>
              <option value="18"<?php if($Controlrow['ControlFoodHour']==18) echo "selected"?>>18h</option>
                    <option value="24"<?php if($Controlrow['ControlFoodHour']==24) echo "selected"?>>24h</option>
            </select>
          燈光開啟時間:
        <input type="time" name="inputLedOn" class="form-control" value="<?php echo $Controlrow['ControlLedOn'];?>" placeholder="select a time" required>
          燈光關閉時間:
        <input type="time" name="inputLedOff" class="form-control" value="<?php echo $Controlrow['ControlLedOff'];?>" placeholder="select a time" required>
          設定溫度(°C):
            <select  class="form-control" name="inputTemp">
                    <option value="21"<?php if($Controlrow['ControlTemp']==21) echo "selected"?>>21°C</option>
                    <option value="22"<?php if($Controlrow['ControlTemp']==22) echo "selected"?>>22°C</option>
                    <option value="23"<?php if($Controlrow['ControlTemp']==23) echo "selected"?>>23°C</option>
                    <option value="24"<?php if($Controlrow['ControlTemp']==24) echo "selected"?>>24°C</option>
                    <option value="25"<?php if($Controlrow['ControlTemp']==25) echo "selected"?>>25°C</option>
                    <option value="26"<?php if($Controlrow['ControlTemp']==26) echo "selected"?>>26°C</option>
                    <option value="27"<?php if($Controlrow['ControlTemp']==27) echo "selected"?>>27°C</option>
                    <option value="28"<?php if($Controlrow['ControlTemp']==28) echo "selected"?>>28°C</option>
                    <option value="29"<?php if($Controlrow['ControlTemp']==29) echo "selected"?>>29°C</option>
                    <option value="30"<?php if($Controlrow['ControlTemp']==30) echo "selected"?>>30°C</option>
            </select>
    
        <input name="action" type="hidden" value="post">
        <input type="submit"  class="btn btn-lg btn-primary btn-block">
           <input type="reset" class="btn btn-lg btn-default btn-block">
      </form>

                    </div> <!-- /container -->
               
      
      </div>
		</div><!-- wrapper page -->
      
	</body>
</html>