<?php
  include("../system/config/root.php");
  include('../system/global/header.inc');
  include('../system/global/session.inc');
  include('../system/global/navbar.inc');
  include('../system/global/permissionCheck.php');
  echo "<link href='/paperevalu/static/css/studentPaper.css' rel='stylesheet' />";
  $step = array(10 => '等待导师意见', 20 => '等待学院审批', 30 => '等待上传论文', -30 => '申请未通过', 40 => '等待查重', 50 => '等待分配审批', -50 => '查重未通过', 60 => '等待专家审查', 70 => '审查通过', 80 => '论文需修改', 90 => '审查未通过', 100 => '盲选审查通过');
  $color = array(10 => '#5bc0de', 20 => '#5bc0de', 30 => '#428bca', -30 => '#d9534f', 40 => '#5bc0de', 50 => '#5bc0de', -50 => '#d9534f', 60 => '#5bc0de', 70 => '#5bc0de', 80 => '#428bca', 90 => '#d9534f', 100 => '#5cb85c');
  $type = array(10 => 'text', 20 => 'text', 30 => 'button', -30 => 'button', 40 => 'text', 50 => 'text', -50 => 'button', 60 => 'text', 70 => 'text', 80 => 'button', 90 => 'text', 100 => 'text');
  $href = array(30 => '', -30 => '', 50 => '', 80 => '');
  permissionCheck(1); //只允许学生访问本页
  $sql = "select wt_paper.*,wt_evaluate_period.evaluate_name from wt_paper,wt_evaluate_period where wt_paper.uid = ".$_SESSION['wt_id']." and wt_paper.token = wt_evaluate_period.token order by apply_time DESC";
  
  $paperres = $mysqli->query($sql);
  $data = array();
  $paperres->data_seek(0); #重置指针到起始
  while($row = $paperres->fetch_assoc())
  {
    $data[] = $row;
  }
  $paperres->free();
  include('../view/studentPaper.php');
?>

<?php
  include('../system/global/navbarfooter.inc');
?>;
