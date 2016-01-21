<?php
  include("../system/config/root.php");
  include('../system/global/header.inc');
  include('../system/global/session.inc');
  include('../system/global/navbar.inc');
  include('../system/global/permissionCheck.php');
  echo "<link href='/paperevalu/static/css/tutorRemark.css' rel='stylesheet' />";
  // function gettoken() {
  permissionCheck(3);
  if ($_GET['paper_id'] != null) {
    $papersql = "select * from wt_paper,wt_major where wt_paper.paper_id = ".$_GET['paper_id']." and wt_paper.tutor_uid = ".$_SESSION['wt_id']." and wt_major.major_id = wt_paper.paper_major and paper_step = 10";
    $paperres = $mysqli->query($papersql);
    if ($paperres->num_rows == 0) {
      echo "<script>alert('未找到论文');window.location.href='../index.php'; </script>";
      exit();
    }
    $paperres->data_seek(0);
    $paperdata = $paperres->fetch_assoc();
    $paperres->free();
    if ($paperdata['paper_step'] != 10) {
      echo "<script>alert('该论文已添加意见');window.location.href='../index.php'; </script>";
      exit();
    }
    $stusql = "select * from wt_users where uid = ".$paperdata['uid'];
    $stures = $mysqli->query($stusql);
    if ($stures->num_rows == 0) {
      echo "<script>alert('未找到学生');window.location.href='../index.php'; </script>";
      exit();
    }
    $stures->data_seek(0);
    $studata = $stures->fetch_assoc();
    $stures->free();
    include('../view/tutorRemark.php');
  } else {
    echo "<script>alert('非法参数');window.location.href='../index.php'; </script>";
    exit();
  }
?>
<?php
  include('../system/global/navbarfooter.inc');
?>