<script type="text/javascript">
function GoajaxSignin()
{
                //Regular expression Testing
emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                if(signin.inputEmail.value == "") 
                {
                        alert("請輸入email帳號");
                }else if(signin.inputEmail.value.search(emailRule)== -1) 
                {
                        alert("email格式有誤");
                }else if(signin.inputPassword.value == "") 
                {
                        alert("請輸入密碼");
                }else{
                    var email = signin.inputEmail.value;
                    var password = signin.inputPassword.value;
                 
                  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "signin_cgi.php",
                    data:{email:email,password:password},
                    success: function(data) {
                        if(data["status"]&&data["status1"]){
                        
                        location.reload() ;
                        }else if(!data["status"]){
                            alert("查無此帳號");
                        }else if(!data["status1"]){
                            alert("密碼錯誤");
                        }
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

      <form class="form-signin" name="signin" id="signin">
        <h2 class="form-signin-heading">Please sign in</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
        <div class="checkbox">
       
        </div>
        <button type="button" class="btn btn-lg btn-primary btn-block" onclick="GoajaxSignin();">Sign in</button>
        <button type="button" class="btn btn-lg btn-info btn-block" onClick="javascript:location.href='index.php'">Retrun</button>
      </form>

    </div> <!-- /container -->
