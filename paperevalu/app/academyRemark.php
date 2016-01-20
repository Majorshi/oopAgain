<?php
  ob_start();
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include("../system/config/root.php");
  include('../system/global/permissionCheck.php');
  permissionCheck(2);
  if ($_POST['paper_id'] != null && $_POST['inst_opinion'] != null && $_POST['agree'] != null) {
  	$step = 30;
  	if ($_POST['agree'] == 0) {
  		$step = -30;
  	}
  	$updatesql = "update wt_paper set inst_opinion = '".$_POST['inst_opinion']."', inst_time = '".time()
  	."', paper_step = ".$step." where paper_id = '".$_POST['paper_id']."' and paper_step = 20";
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
	echo "<script>alert('审核成功');window.location.href='../index.php'; </script>";
  } else {
  	echo "<script>alert('非法参数');window.location.href='../index.php'; </script>";
  }
?>