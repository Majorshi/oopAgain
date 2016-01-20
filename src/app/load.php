<?php
	ob_start();
	@session_start();
	header("Content-Type:text/html;charset=utf-8");

	if($_POST)
	{
		$name = $_POST["luser"];
		$pwd = $_POST["lpwd"];
		$pwd = MD5($pwd);
?>
<?php
	include("../system/config/root.php");
?>
<?php
	    $sqluser = "select * from wt_users where user_name='" .$name. "';";
	    $resultuser = $mysqli->query($sqluser);

	    if($resultuser)
	    {
		    echo json_encode(1);     //登录成功
		}
		else
		{
			echo json_encode(0);     //登录失败
		}

		$mysqli->close();
	}
	else
	{
		echo json_encode(2);       //登录失败
	}
?>