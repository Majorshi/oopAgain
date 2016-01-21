<?php
	include('../system/global/session.inc');
	if($_POST){
		$uid = $_POST["uid"];
		$type = $_POST["type"];
		include("../system/config/root.php");
		if ($uid == "") {
			$uid = $_SESSION['wt_id'];
		}
		if ($type == 1)	{
			$sql = "SELECT a.*,b.* FROM wt_users a JOIN wt_users_extradata b on a.uid=b.uid WHERE a.uid = ".$uid;
			$result = $mysqli->query($sql);
			while($rowData = $result->fetch_assoc()){
				$rowData['entrance_time'] = date("Y年m月", $rowData['entrance_time']);
				$rowData['reg_time'] = date("Y/m/d H:i:s", $rowData['reg_time']);
				echo json_encode($rowData);
			}
			$mysqli->close();
		}
		else 
		{
			$dataArray = Array();
			if ($_POST['email'] != "")
				$dataArray[] = "email='" . $_POST['email'] . "'";
			if ($_POST['mobile'] != "")
				$dataArray[] = "mobile='" .$_POST['mobile']. "'";
			if (!empty($dataArray))	
			{
				$sql = "update wt_users set ".implode(' , ', $dataArray)." where uid=".$uid;
				$result = $mysqli->query($sql);
			}
			
			unset($dataArray);
			if ($_POST['leader_name'] != "")
				$dataArray[] = "leader_name='" .  $_POST['leader_name']. "'";
			if ($_POST['user_unit'] != "")
				$dataArray[] = "user_unit='" .  $_POST['user_unit']. "'";
			if ($_POST['user_post'] != "")
				$dataArray[] = "user_post='" .  $_POST['user_post']. "'";
			if ($_POST['if_leader'] != "")
				$dataArray[] = "if_leader='" . $_POST['if_leader']. "'";
			if ($_POST['user_major'] != "")
				$dataArray[] = "user_major='" . $_POST['user_major']. "'";
			if (!empty($dataArray)) {
				$sql = "update wt_users_extradata set ".implode(' , ', $dataArray)." where uid=".$uid;
				$result = $mysqli->query($sql);
			}
			echo '0';
		}
	} 
	else 
	{
		//echo '<script type="text/javascript">window.location="../login.php";</script>';
	}
?>