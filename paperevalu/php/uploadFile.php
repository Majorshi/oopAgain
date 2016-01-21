<?php

require( "../system/config/root.php" );
include('../system/global/session.inc');
include('../system/global/permissionCheck.php');
permissionCheck(1);
    if( !(isset( $_FILES["file"]) || $_POST['paper_id'] == null )) {
        echo "<script>alert('非法参数');window.location.href='../index.php'; </script>";
        exit();
    }

    if( $_FILES["file"]["error"] > 0 ) {
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        return;
    }

    echo "Upload: " . $_FILES["file"]["name"] . "<br />";
    echo "Type: " . $_FILES["file"]["type"] . "<br />";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
    echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";

    if (file_exists("../upload/" . $_FILES["file"]["name"])) {

        echo $_FILES["file"]["name"] . " already exists. \n";
        return;

    }

    // 存储文件路径

    $username = $_SESSION[ "wt_username"];
    $uid = $_SESSION['wt_id'];
    $dateStr = $dateStr = date("Y-m-d-H-i-s", time());

    $path = "../upload/";
    $newFileLoc = $path . "_" .  $dateStr . "_" . $username . "_" . $_FILES["file"]["name"];

    move_uploaded_file( $_FILES["file"]["tmp_name"] , $newFileLoc);
    echo "Stored in: " . $newFileLoc ."\n";

    //检查论文是否正确
    $papercheckSQL = "select * from wt_paper where uid = ".$uid." and paper_id = ".$_POST['paper_id'];
    $pcres = $mysqli->query($papercheckSQL);
    if ($pcres->num_rows == 0) {
        echo "<script>alert('未找到论文');window.location.href='../index.php'; </script>";
        exit();
    }
    $pcres->data_seek(0);
    $paperdata = $pcres->fetch_assoc();
    $pcres->free();

    if (!($paperdata['paper_step'] == 30 || $paperdata['paper_step'] == 40)) {
        echo "<script>alert('论文未处于可上传阶段');window.location.href='../index.php'; </script>";
        exit();
    }
    $sqlSetFileLoc = "update `wt_paper` set `paper_location` =\"" . $newFileLoc . "\", paper_step = 40 where `uid` =" . $uid." and paper_id = '".$_POST['paper_id']
    ."'";
    $ret = $mysqli->query( $sqlSetFileLoc );
    if( $ret != true ) {
        echo "setting file location failed.\n";
        echo "SQL: " .$sqlSetFileLoc . "\n";
        unlink( $newFileLoc );
        echo "<script>alert('论文上传失败');window.location.href='../index.php'; </script>";
    }
    echo "<script>alert('论文上传成功');window.location.href='../php/studentPaper.php'; </script>";
