<?
  ob_start();
  @session_start();
  header("Content-Type:text/html;charset=utf-8");
  include("../system/config/root.php");
  include('../system/global/permissionCheck.php');
  permissionCheck(1);
  	if ($_POST['paper_title'] != null && $_POST['paper_abstract'] != null && $_POST['majorid']) {
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
            $result1->free();
            $sql2 = "select * from wt_users_relation, wt_users where wt_users.uid = wt_users_relation.teacher_id and wt_users_relation.student_id = ".$_SESSION['wt_id'];
            $teacherResult = $mysqli->query($sql2);
            if ($teacherResult->num_rows == 0) {
              echo "<script>alert('未找到您的导师信息，请联系管理员');window.location.href='index.php'; </script>";
              exit();
            } else {
              $teacherResult->data_seek(0);
              $dataset2 = $teacherResult->fetch_assoc();
              $dataset['teacher_name'] = $dataset2['user_name'];
              $dataset['teacher_id'] = $dataset2['uid'];
              $teacherResult->free();
              if ($update == 1) {
              	$deletesql = "delete from wt_paper  where uid = ".$_SESSION['wt_id']." and token = '".$token."'";
              	$mysqli->query($deletesql);
              }
              	$insertsql = "INSERT INTO `wetrial`.`wt_paper` (`paper_id`, `uid`, `paper_title`,".
              	" `paper_number`, `paper_abstract`, `paper_location`, `paper_major`, `token`,".
              	" `apply_time`, `tutor_uid`, `tutor_name`, `tutor_opinion`, `tutor_time`,".
              	" `inst_opinion`, `inst_time`, `paper_step`, `repet_res`, `check_res`) VALUES".
				" (NULL, '".$_SESSION['wt_id']."', '".$_POST['paper_title']."', NULL, '".
					$_POST['paper_abstract']."', NULL, '".$_POST['majorid']."', '".$token."', '".time()."', '".
					$dataset['teacher_id']."', '".$dataset['teacher_name']."', NULL, NULL, NULL, NULL, '1', '0', '0');";
			  
			  $insertres = $mysqli->query($insertsql);
			  if($insertres === false)
			  {
				 echo "<script>alert('添加记录失败，请重试');window.location.href='index.php'; </script>";
			  } else {
			  	 echo "<script>alert('添加成功！请等待审批');window.location.href='index.php'; </script>";
			  }
            }
          }
        }
      }
  	} else {
  		echo "<script>alert('非法参数');window.location.href='index.php'; </script>";
  	}
?>