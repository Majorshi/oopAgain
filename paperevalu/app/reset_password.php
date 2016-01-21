<?php
	ob_start();
	@session_start();
	header("Content-Type:text/html;charset=utf-8");
	if($_POST){
		$id = $_POST["uid"];
		$old = $_POST["old"];
		$new = $_POST["new"];
		include("../system/config/root.php");
		if ($id == "")
			$id = $_SESSION['wt_id'];
			$sql = "select password from wt_users where uid = ".$id;
			$result = $mysqli->query($sql);
			while ($rowData = $result->fetch_assoc())	{
				if ( strcmp($old,$rowData['password']) == 0)	{

				} else {
					echo '0';
					exit();
				}
			}
			$sql = "update wt_users set password = ".$new." where uid = ".$id;
			$result = $mysqli->query($sql);
			echo '1';
		$mysqli->close();
	}
?>