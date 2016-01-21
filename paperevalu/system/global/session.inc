<?php
	ob_start();
	@session_start();
	header("Content-Type:text/html;charset=utf-8");
	date_default_timezone_set('PRC');  // 北京时间

	if(! $_SESSION)
	{
		echo "<script type='text/javascript'>window.location.href='/paperevalu/view/login.php'</script>";
	}

	// http://www.jb51.net/article/38025.htm    学习地址

	// 获取当前时间的时间戳  echo time()

	// 获取指定时间时间戳  echo strtotime("2016-1-21")

	// 解析当前时间戳，获取时间  echo date("Y-m-d H:i:s", time())   如：2016-01-21 00:36:25

	// 解析指定时间戳，获取时间  echo date("Y-m-d H:i:s", $timestamp) 
?>