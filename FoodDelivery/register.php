<script type="text/javascript">
function GoajaxCreate()
{
                //Regular expression Testing
emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
phoneRule =  /^09\d{8}$/;
    
                if(reg.inputEmail.value == "")
                {
                        alert("請輸入email帳號");
                }else if(reg.inputEmail.value.search(emailRule)== -1) 
                {
                        alert("email格式有誤");
                }else if(reg.inputPassword.value == "") 
                {
                        alert("請輸入密碼");
                }else if(reg.inputPassword1.value == "") 
                {
                        alert("請再次輸入密碼");
                }else if(reg.inputPassword.value != reg.inputPassword1.value) 
                {
                        alert("確認密碼與密碼不同");
                }else if(reg.inputName.value == "") 
                {
                        alert("請輸入姓名");
                }else if(reg.inputPhone.value == "") 
                {
                        alert("請輸入手機號碼");
                }else if(reg.inputPhone.value.search(phoneRule)== -1) 
                {
                        alert("手機號碼格式有誤");
                }else{
          
                    var name = reg.inputName.value;
                    //alert(name);
                    var email = reg.inputEmail.value;
                    //alert(email);
                    var password = reg.inputPassword.value;
                    var phone = reg.inputPhone.value;
                    
                    //alert(password);
                    //alert(name);
                  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "register_cgi.php",
                    data:{name:name,email:email,password:password,phone:phone},
                    success: function(data) {
                        if(data["status"]){
                        
                        location.reload() ;
                        }else
                             alert("此帳號已經被註冊!");
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

      <form class="form-signin" name="reg" id="reg">
        <h2 class="form-signin-heading">Register Delivery</h2>
          
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
           <label for="inputPassword1" class="sr-only">Password</label>
        <input type="password" id="inputPassword1" class="form-control" placeholder="Password again" required>
          <label for="inputName" class="sr-only">Name</label>
        <input type="text" id="inputName" class="form-control" placeholder="Name" required>
          <label for="inputPhone" class="sr-only">Phone</label>
        <input type="number" id="inputPhone" class="form-control" placeholder="Phone" required>
        <div class="checkbox">
       
        </div>
        <button type="button" class="btn btn-lg btn-primary btn-block"  onclick="GoajaxCreate();">Submit</button>
        <button type="button" class="btn btn-lg btn-info btn-block" onClick="javascript:location.href='index.php'">Retrun</button>
      </form>

    </div> <!-- /container -->
