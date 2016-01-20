function login(formEl)
{
	var userval = formEl.find('#username').val();
	var userpwd = formEl.find('#password').val();

	if (userval == "" || userpwd == "")
	{
		return false;
	}

	alert(userval + '---' + userpwd);

	var xmlhttp;
	var lpoststr = "luser=" + userval + "&lpwd=" + userpwd;
	var lurl = "/paperevalu/app/load.php";

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
		alert(xmlhttp.readyState);
		alert(xmlhttp.status);

		//alert(xmlhttp.responseText);

		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			e = xmlhttp.responseText;
			eval("var result = e" );

			if(result == "1")
			{
				alert("登录成功");
				return false;
			}
			else
			{
				alert(result);
				return false;
			}
		}
	}
	xmlhttp.open("POST",lurl,true);
	xmlhttp.setRequestHeader("Content-type","application/x-www-form-urlencoded");
	xmlhttp.send(lpoststr);
}