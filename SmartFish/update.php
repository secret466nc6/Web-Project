<?php


// array for JSON response
$response = array();
// check for required fields
if (isset($_POST['inputWaterTime']) && isset($_POST['inputWaterDay']) && isset($_POST['inputFoodTime']) && isset($_POST['inputFoodHour'])
    && isset($_POST['inputLedOn']) && isset($_POST['inputLedOff']) && isset($_POST['inputTemp'])) {
    header("Location:index.php");
    $watertime = $_POST['inputWaterTime'];
    $waterday = $_POST['inputWaterDay'];
    $foodtime = $_POST['inputFoodTime'];
    $foodhour = $_POST['inputFoodHour'];
    $ledon = $_POST['inputLedOn'];
    $ledoff = $_POST['inputLedOff'];
    $temp = $_POST['inputTemp'];
    
//UPDATE `fish`.`controltable` SET `ControlWaterTime` = '08:00:00', `ControlWaterDay` = '4', `ControlFoodTime` = '13:00:00', `ControlFoodHour` = '7', `ControlLedOn` = '13:00:00', `ControlLedOff` = '19:00:00', `ControlTemp` = '24' WHERE `controltable`.`ControlID` = 1
    // mysql update row with matched pid
    $sql_query = "UPDATE `".$DBname."`.`ControlTable` SET `ControlWaterTime` = '".$watertime."', `ControlWaterDay` = '".$waterday."', `ControlFoodTime` = '".$foodtime."', `ControlFoodHour` = '".$foodhour."', `ControlLedOn` = '".$ledon."', `ControlLedOff` = '".$ledoff."', `ControlTemp` = '".$temp."' WHERE `ControlTable`.`ControlID` = 1";
           mysql_query($sql_query) or die("無法送出" . mysql_error( )); 
    
  
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}
?>
