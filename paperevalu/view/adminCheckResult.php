<?php
  	include('../system/global/header.inc');
  	include('../system/global/session.inc');
  	include('../system/global/navbar.inc');
?>
	<link href="/paperevalu/static/css/home.css" rel="stylesheet" />
	<script type="text/javascript" src="/paperevalu/static/js/inputRate.js"></script>
    <div class="col-xs-9 mt100"> 
      <table id="adminCheckTable" class="table table-bordered table-hover"> 
      <tbody>
       <tr> 
        <th>标题</th> 
        <th>作者</th>
        <th>重复率</th> 
       </tr> 
       
 <?php
	 include('../system/global/permissionCheck.php');
	 include("../system/config/root.php");
	 #
	 #permissionCheck(3);

	#获取已查重结果
		$checkResultSQLStr = "select wt_paper.paper_title as paperTitle, wt_users.realname as userName, wt_paper_repet.repet_rate as paperRate from wt_paper, wt_users, wt_paper_repet where wt_paper_repet.paper_id = wt_paper.paper_id and wt_paper.uid = wt_users.uid";
		#$checkResultSQLStr = "select paper_title from wt_paper";
		
		
		$checkResult = $mysqli->query($checkResultSQLStr);
		if($checkResult)
		{
			while($checkRowResult = $checkResult->fetch_assoc()){
				if ($checkRowResult['paperRate'] > 25){
					echo "<tr class=\"danger\">";#danger
				}
				else{
					echo "<tr>";
				}
				echo "<td>{$checkRowResult['paperTitle']}</td>";
				echo "<td>{$checkRowResult['userName']}</td>";
				echo "<td>{$checkRowResult['paperRate']}%</td>" ;
				echo "</tr>";
			}
		}
		
		#获取需要查重但未查重结果
		#$prepareCheckResultSQLStr = "select paper_title as paperTitle, paper_id as paperID from wt_paper where paper_id not in (select paper_id from wt_paper_repet) and paper_step >= 40";
		$prepareCheckResultSQLStr = "select paper_title as paperTitle, wt_users.realname as userName, paper_id as paperID from wt_paper, wt_users where wt_paper.uid = wt_users.uid and paper_id not in (select paper_id from wt_paper_repet) and paper_step >= 40";
		$prepareCheckResult = $mysqli->query($prepareCheckResultSQLStr);
		if($prepareCheckResult){
			while($prepareCheckRowResult = $prepareCheckResult->fetch_assoc()){
				echo "<tr>";
				echo "<td>{$prepareCheckRowResult['paperTitle']}</td>";
				echo "<td>{$prepareCheckRowResult['userName']}</td>";
				echo "<td>";
				echo "<form class=\"form-inline\">";
				echo "<div class=\"form-group\">";
				echo "<label class=\"sr-only\" for=\"exampleInputEmail3\">Email address</label>";
				echo "<input id=\"{$prepareCheckRowResult['paperID']}\" type=\"number\" class=\"form-control\" name = \"info_rate\"  placeholder=\"rate\"> ";
				echo "</div>";
	
				echo "<button type=\"button\" class=\"btn btn-success\" onclick = \"inputRate('{$prepareCheckRowResult['paperID']}')\">录入</button>";
				echo "</form>";
				echo "</td>";
				echo "</tr>";
			}
		}
		
		$mysqli->close()
	?>
       
       
      </tbody>
     </table> 
    </div> 
<?php
	include('../system/global/navbarfooter.inc');
?>