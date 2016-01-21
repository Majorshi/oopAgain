<?php
  include("../system/config/root.php");
  include('../system/global/header.inc');
  include('../system/global/session.inc');
  include('../system/global/navbar.inc');
  include('../system/global/permissionCheck.php');
  echo "<link href='/paperevalu/static/css/evaluateApply.css' rel='stylesheet' />";
  permissionCheck(1);
    $sql = "select * from wt_evaluate_period where start_time < ".time()." and end_time > ".time();
    $result = $mysqli->query($sql);
    if($result === false)
    {
        ee($mysqli->errno);
        ee($mysqli->error);
    }
    if ($result->num_rows == 0) {
      echo "<script>alert('当前时段不允许申请盲审');window.location.href='index.php'; </script>";
    } else {
        $data = array();
        $result->data_seek(0); #重置指针到起始
        $row = $result->fetch_assoc();
        $token = $row['token'];
        $result->free();
        $sql = "select * from wt_users where uid = ".$_SESSION['wt_id'];
        $re = $mysqli->query($sql);
        if ($re->num_rows == 0) {
          echo "<script>alert('用户不存在');window.location.href='index.php'; </script>";
        } else {

          $re->data_seek(0);
          $dataset = $re->fetch_assoc();
          $re->free();
          $sql1 = "select * from wt_paper where uid = ".$_SESSION['wt_id']." and token = '".$token."'";
          $result1 = $mysqli->query($sql1);
          if ($result1->num_rows != 0) {
            $result1->data_seek(0);
            $ds = $result1->fetch_assoc();
            if ($ds['paper_step'] == -30) {
              $update = 1;
            } else {
              echo "<script>alert('您在当前学年中已申请过盲审');window.location.href='index.php'; </script>";
              exit();
            }
          }
            echo "string";
            $result1->free();
            $sql2 = "select * from wt_users_relation, wt_users where wt_users.uid = wt_users_relation.teacher_id and wt_users_relation.student_id = ".$_SESSION['wt_id'];
            $teacherResult = $mysqli->query($sql2);
            echo "string";
            if ($teacherResult->num_rows == 0) {
              echo "<script>alert('未找到您的导师信息，请联系管理员');window.location.href='index.php'; </script>";
              exit();
            } else {
              $teacherResult->data_seek(0);
              $dataset2 = $teacherResult->fetch_assoc();
              $dataset['teacher_name'] = $dataset2['user_name'];
              $teacherResult->free();

              $majorsql = "select * from wt_major where state = 1";
              $majorres = $mysqli->query($majorsql);
              $majorres->data_seek(0); #重置指针到起始
              $majordata = array();
              while($mrow = $majorres->fetch_assoc())
              {
                  $majordata[] = $mrow;
              }
              include('../view/evaluateApply.php');
            }
          }
        }
  // }
  // $sql = "insert into wt_evaluate_period values(1, 1, ".strtotime("2016-1-1").", ".strtotime("2017-1-1").", '2016学年', '2016lalala', ".time().", ".time().", 1)";
  // $rst = $mysqli->query($sql);
  //判断当前时段的token
  
?>

<?php
include('../system/global/navbarfooter.inc');
?>