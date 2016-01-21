<?php
	ob_start();
	@session_start();
	header("Content-Type:text/html;charset=utf-8");
	if($_POST){
		$id = $_POST["uid"];
		$value = $_POST["value"];
		include("../system/config/root.php");
		if ($id == "") {
			$sql = "select * from wt_major";
			$result = $mysqli->query($sql);
			while($rowData = $result->fetch_assoc()){
				echo "<option value = ".$rowData['major_id']."> ".$rowData['major_name']." </option>";
			}
		} else {
			$id = $_SESSION['wt_id'];
			$sql = "update wt_user_extradata set user_major = ".$value." where uid = ".$id;
			$result = $mysqli->query($sql);
		}
		$mysqli->close();
	} else {
		//echo '<script type="text/javascript">window.location="../login.php";</script>';
	}
?>