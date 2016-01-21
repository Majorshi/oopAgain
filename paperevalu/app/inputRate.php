<?php

		$paperID = $_POST["paperID"];
		$paperRate = $_POST["paperRate"];
#$paperID = isset($_POST['paperID']) ? htmlspecialchars($_POST['paperID']) : '';
#$paperRate = isset($_POST['paperRate']) ? htmlspecialchars($_POST['paperRate']) : '';


	include("../system/config/root.php");
   
    #$testSQLStr = "select * from wt_paper_repet";
    #$testRate = $mysqli->query($testSQLStr);
   
    $insertRateSQLStr = "insert into wt_paper_repet (paper_id, repet_rate) values ({$paperID}, {$paperRate})";
    $insertRate = $mysqli->query($insertRateSQLStr);
    
    
    #大于 25 时，查重不通过，论文状态设为 90
    if($paperRate > 25){
	    $updatePaperStepSQLStr = "update wt_paper set paper_step = 90 where paper_id = {$paperID}";
    }
    else {
	 $updatePaperStepSQLStr = "update wt_paper set paper_step = 50 where paper_id = {$paperID}";   
    }
    $updatePaperStep = $mysqli->query($updatePaperStepSQLStr);
    
    if($insertRate && $updatePaperStep){
	    echo("1");
    }
    else{
	    echo("0");
    }

		$mysqli->close();
		#echo("{$paperID}");
		#echo("---");
		#echo("{$paperRate}");
		#while($testRowRate = $testRate->fetch_assoc()){
	#		echo("{$testRowRate['repet_rate']}");
	#		}


?>