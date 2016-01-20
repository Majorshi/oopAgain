<?php
	ob_start();
	@session_start();

	if(! $_SESSION)
	{
		echo "<script type='text/javascript'>window.location.href='/paperevalu/view/login.php'</script>";
	}
?>