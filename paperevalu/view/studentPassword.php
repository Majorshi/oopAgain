<?php
  include('../system/global/header.inc');
  include('../system/global/session.inc');
?>
<link href="/paperevalu/static/css/home.css" rel="stylesheet" />
<?php
  include('../system/global/navbar.inc')
?>
    <div class="col-xs-9 mt100"> 
    <form id = "info_form"> 
      <div class="form-group"> 
       <label for="exampleInputPassword1">原密码</label> 
       <input type="password" class="form-control" id="origin_password" placeholder="Password" /> 
      </div> 
      <div class="form-group"> 
       <label for="exampleInputPassword1">新密码</label> 
       <input type="password" class="form-control" id="new_password" placeholder="Password" /> 
      </div> 
      <div class="form-group"> 
       <label for="exampleInputPassword1">新密码确认</label> 
       <input type="password" class="form-control" id="new_password_comfirmed" placeholder="Password" /> 
      </div> 
      <button type="button" class="btn btn-default" onclick="upload()">提交</button> 
    </form> 
    </div> 
  
<script type = "text/javascript">

function upload(){
	var old = $('#origin_password').val();
	var new1 = $('#new_password').val();
	var new2 = $('#new_password_comfirmed').val();
	if (new1 == new2)	{
		var xmlhttp;
		var url="../app/reset_password.php";
		var type = 0;
		var uid = "";
		var poststr = "uid=" + "" + "&old=" + old + "&new=" + new1;
		if (window.XMLHttpRequest)	{// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp=new XMLHttpRequest();
		} else {// code for IE6, IE5
			xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
		} 
		xmlhttp.onreadystatechange = function() {
			if (xmlhttp.readyState == 4 && xmlhttp.status== 200)	{
				e = xmlhttp.responseText;
				if (e == '0')	 {
					alert("原密码错误");
				} else {
					alert("修改成功");
				}
				window.location.href = window.location.href;
			}
		}
		xmlhttp.open("POST",url,true);
		xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
		xmlhttp.send(poststr);
	} else {
		alert("两次新密码不相同");
	}
}

$('#info_form').validate({
    errorElement:'span',
    success:function(label){
        
        },
    rules:{
		'origin_password':{
			minlength:6,
			maxlength:30,
		},
		'new_password':{
			minlength:6,
			maxlength:30,
		},
		'new_password_comfirmed':{
			minlength:6,
			maxlength:30,
		}
    },
    messages:{
		'origin_password':{
			minlength:'<code>   密码至少6位</code>',
			maxlength:'<code>   密码最多30位</code>',
		},
		'new_password':{
			minlength:'<code>   密码至少6位</code>',
			maxlength:'<code>   密码最多30位</code>',
		},
		'new_password_comfirmed':{
			minlength:'<code>   密码至少6位</code>',
			maxlength:'<code>   密码最多30位</code>',
		}
	}
});
</script>
<?php
  include('../system/global/navbarfooter.inc');
?>