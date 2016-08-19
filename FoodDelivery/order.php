<script type="text/javascript">
function GoajaxOrder()
{
                //Regular expression Testing
emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
phoneRule =  /^09\d{8}$/;
                if(order.inputName.value == "") 
                {
                        alert("請輸入訂單名稱");
                }else if(order.inputPlace.value == "") 
                {
                        alert("請輸入取餐付款地點");
                }else{
          
                    var name = order.inputName.value;
                    //alert(name);
                    var place = order.inputPlace.value;
                    //alert(email);
                    var menu = order.inputMenu.value;
                    var time = order.inputDate.value;
                    var memberid = <?php if(isset($_SESSION['email'])){echo $row['MemberID'];}else echo "0" ?>;
                  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "order_cgi.php",
                    data:{name:name,place:place,menu:menu,time:time,memberid:memberid},
                    success: function(data) {
                        //if(data["status"]){
                        
                       location.href = 'index.php';
                        //}else
                         //    alert("此帳號已經被註冊!");
                        //document.getElementById('popDiv1').style.display = 'none';
                        //document.getElementById('popDiv').style.display = 'none';
                        //location.reload() ;
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                      }
                    });	

                }
}
</script>
        <div class="container">

      <form class="form-signin" name="order" id="order">
        <h2 class="form-signin-heading">發起訂單</h2>
        <label for="inputName" class="sr-only">訂單名稱</label>
        <input type="text" id="inputName" class="form-control" placeholder="訂單名稱" required autofocus>
        
           <label for="inputPlace" class="sr-only">取餐付款地點</label>
        <input type="text" id="inputPlace" class="form-control" placeholder="取餐付款地點" required>
         選擇欲訂購的Menu
        <div class="checkbox">
            
        <select  class="form-control" name="inputMenu">
            
            <?php
$menusql = "SELECT * FROM `MenuTable` WHERE `MemberID` = '".$row['MemberID']."'";

$menuresult = mysql_query($menusql);
while($menurow = mysql_fetch_assoc($menuresult)){
echo '<option value="'.$menurow['MenuName'].'">'.$menurow['MenuName'].'</option>';
}

?>

</select>
        </div>
           
       截止時間
    
          <label for="inputDate" class="sr-only">截止時間</label>
        
          <input id="inputDate" name="inputDate" class="form-control" type="datetime-local">
        <button type="button" class="btn btn-lg btn-primary btn-block"  onclick="GoajaxOrder();">Submit</button>
        <button type="button" class="btn btn-lg btn-info btn-block" onClick="javascript:location.href='index.php'">Retrun</button>
      </form>

    </div> <!-- /container -->
