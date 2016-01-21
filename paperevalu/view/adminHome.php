<?php
  include('../system/global/header.inc');
  include('../system/global/session.inc');
  include('../system/global/navbar.inc');
?>
	<link href="/paperevalu/static/css/home.css" rel="stylesheet" />
	<div class="col-xs-9 mt100"> 
    <table id="adminTable" class="table table-bordered table-hover"> 
      <tbody>
       <tr> 
        <th>标题</th> 
        <th>作者</th> 
        <th>学号</th> 
        <th>指导教师</th> 
       </tr> 
       <?php
	       include('../system/global/permissionCheck.php');
	       include("../system/config/root.php");
	 #
	 #permissionCheck(2);
	       
	       $downloadPaperSQLStr = "select wt_paper.paper_title, wt_paper.paper_location, wt_users.realname, wt_users.user_number, wt_paper.tutor_name from wt_paper, wt_users where wt_paper.uid = wt_users.uid";
	       $downloadPaper = $mysqli->query($downloadPaperSQLStr);
	       if($downloadPaper){
		       while($downloadPaperRow = $downloadPaper->fetch_assoc()){
			       echo "<tr>";
			       echo "<td> <a href=\"{$downloadPaperRow['paper_location']} target=\"_blank\"\">{$downloadPaperRow['paper_title']}</a> </td> ";
			       echo "<td> {$downloadPaperRow['realname']} </td> ";
			       echo "<td> {$downloadPaperRow['user_number']} </td> ";
			       echo "<td> {$downloadPaperRow['tutor_name']} </td> ";
			       echo "</tr>";
		       }
	       }
	    ?>

      </tbody>
     </table> 
    </div> 
<?php
	include('../system/global/navbarfooter.inc');
?>