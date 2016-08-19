<script type="text/javascript">
function GoajaxCreate()
{
                //Regular expression Testing
emailRule = /^\w+((-\w+)|(\.\w+))*\@[A-Za-z0-9]+((\.|-)[A-Za-z0-9]+)*\.[A-Za-z]+$/;
                if(cre.name.value == "") 
                {
                        alert("未輸入暱稱");
                }
                else if(cre.email.value == "") 
                {
                        alert("未輸入email");
                }else if(cre.email.value.search(emailRule)== -1) 
                {
                        alert("請確認email格式");
                }else if(cre.password.value == "") 
                {
                        alert("未輸入密碼");
                }else if(cre.password1.value == "") 
                {
                        alert("請再次輸入密碼");
                }else if(cre.password.value != cre.password1.value) 
                {
                        alert("確認密碼與密碼不同");
                }else{
          
                    var name = cre.name.value;
                    //alert(name);
                    var email = cre.email.value;
                    //alert(email);
                    var password = cre.password.value;
                    //alert(password);
                    //alert(name);
                  $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "create_cgi.php",
                    data:{name:name,email:email,password:password},
                    success: function(data) {
                       var MSg = "name："+ data["name"] + "，email："+data["email"]+ "，password："+data["password"];
                        MSg += "<br/>JSON格式資料："+data['json'];
                        MSg += "<br/>新增的自訂變數status="+data['status'];
                        $(".the-return").html(MSg);
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

        <div align=center>
	   <form action="" name="cre" id="cre" enctype="multipart/form-data" method="post">
                <fieldset>
                    <legend>註冊HPC帳戶</legend>
                    <span class="title">暱稱</span><br />
				    <input type="text" name="name"  placeholder="User name" id="name"><br />
                <span class="title">Email</span><br />
				    <input type="email" name="email"  placeholder="Use this as login account" id="email"><br />
                    <span class="title">密碼</span><br />
				    <input type="password" name="password"  placeholder="Password" id="password"><br />
                <span class="title">確認密碼</span><br />
				    <input type="password" name="password1" placeholder="Enter password again" id="password1"><br />
               
           </fieldset>

                <input type="button" class="submit" value="註冊" onclick="GoajaxCreate();"/>
                <input type="reset" value="取消" onClick="javascript:location.href='index.php'"/> 
           <div class="the-return">
                [HTML is replaced when successful.]
                </div>
                </form>

             </div>
    