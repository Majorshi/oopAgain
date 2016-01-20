<?php

	function permissionCheck($agreed_state) {
		if ($_SESSION['wt_id'] == null) {
			echo "<script>alert('请先登录');window.location.href='index.php'; </script>";
			exit();
		}
		if ($_SESSION['wt_status'] != $agreed_state) {
			echo "<script>alert('您当前的身份无法使用此功能');window.location.href='index.php'; </script>";
			exit();
		}
	}
	
?>