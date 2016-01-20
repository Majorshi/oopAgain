function login(formEl)
{
	var userval = formEl.find('#username').val();
	var userpwd = formEl.find('#password').val();

	if (userval == "" || userpwd == "")
	{
		return false;
	}

	$.post(
		"../app/load.php",  
        {
			luser: userval,
			lpwd: userpwd
		},
		function(data, status)
		{
			if(status == 'success')
			{
				if(data == 1)
				{
					setTimeout("window.location='adduser.php'",100);
					return false;
				}
				else
				{
					$(".loadtips").html("*用户名密码错误");
					return false;
				}
			}
			else
			{
				$(".loadtips").html("*用户名密码错误");
				return false;
			}
		}
    );



	//alert(userval + '---' + userpwd);

	/*var xmlhttp;
	var lpoststr = "luser=" + userval + "&lpwd=" + userpwd;
	var lurl = "../app/load.php";

	if (window.XMLHttpRequest)
	{
		// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{
		// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			e = xmlhttp.responseText;
			eval("var result = e" );

			alert(result);

			if(result == "1")
			{
				//alert('success');
				return false;
			}
			else
			{
				$(".loadtips").html("*用户名密码错误");
				return false;
			}
		}
	}
	xmlhttp.open("POST",lurl,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(lpoststr);*/
}