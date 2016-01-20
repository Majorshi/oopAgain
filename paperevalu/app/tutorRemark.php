<?php
  ob_start();
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include("../system/config/root.php");
  include('../system/global/permissionCheck.php');
  permissionCheck(3);
  if ($_POST['paper_id'] != null && $_POST['tutor_opinion'] != null) {
  	$updatesql = "update wt_paper set tutor_opinion = '".$_POST['tutor_opinion']."', tutor_time = '".time()
  	."', paper_step = 20 where paper_id = '".$_POST['paper_id']."' and tutor_uid = '".$_SESSION['wt_id']."' and paper_step = 10";
  	$rst = $mysqli->query($updatesql);
  	if($rst === false)
	{
	    echo "<script>alert('提交失败，请重试');window.location.href='../index.php'; </script>";
	    exit();
	}
	if ($mysqli->affected_rows == 0) {
		echo "<script>alert('未找到符合条件的论文');window.location.href='../index.php'; </script>";
	    exit();
	}
	echo "<script>alert('提交成功，论文进入学院审核阶段');window.location.href='../index.php'; </script>";
  } else {
  	echo "<script>alert('非法参数');window.location.href='../index.php'; </script>";
  }
?>