<?php
	ob_start();
	@session_start();
	header("Content-Type:text/html;charset=utf-8");

	if($_POST)
	{
		$name = $_POST["luser"];
		$pwd = $_POST["lpwd"];
		//$pwd = MD5($pwd);
?>
<?php
	include("../system/config/root.php");
?>
<?php
	    $sqluser = "select * from wt_users where user_name='" . $name . "' and password='" . $pwd . "';";

	    $resultuser = $mysqli->query($sqluser);

	    if($resultuser && $resultuser->num_rows > 0)
	    {
	    	while($rowRes = $resultuser->fetch_assoc())
		    {
				$_SESSION["wt_username"] = $rowRes['user_name'];
				$_SESSION["wt_password"] = $rowRes['password'];
				$_SESSION["wt_id"] = $rowRes['uid'];
				$_SESSION["wt_status"] = $rowRes['status_id'];
			}

			echo "1";      //登录成功
	    }
	    else
	    {
	    	echo "0";      //登录失败
	    }

		$mysqli->close();
	}
	else
	{
		echo '2';       //登录失败
	}
?>