<?php

require( "../system/config/root.php" );

    if( !isset( $_FILES["file"] ) ) {
        echo "no files\n";
        return;
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

    $username = $_SESSION[ "wt_username" ];

    $dateStr = date(DATE_ATOM, mktime(0, 0, 0, 7, 1, 2000));
    $dateStr = str_ireplace( [ "+" , "-" , ":" ] , "_" , $dateStr );

    $path = "../upload/";
    $newFileLoc = $path . "_" .  $dateStr . "_" . $username . "_" . $_FILES["file"]["name"];

    move_uploaded_file( $_FILES["file"]["tmp_name"] , $newFileLoc);
    echo "Stored in: " . $newFileLoc ."\n";

    // only for testing !!!!
    $username = "admin";
    // delete above !!!

    $sqlFindUser = "select `uid` from `wt_users` where `user_name` = \"" . $username . "\"";

    $sql = "insert into `test`(`data`) values(\"". $newFileLoc . "\")";
    $ret = $mysqli->query( $sqlFindUser );

    if( $ret != true ) {
        echo "user not found\n";
        return;
    }

    $data = array();

    $ret->data_seek(0);

    while($row = $ret->fetch_assoc() ) {
        $data[] = $row;
    }


    if( count( $data ) > 1 ) {
        echo "dup users found\n";
        return;
    }

    // 得到用户uid
    $uid = $data[0]["uid"];

    $sqlSetFileLoc = "update `wt_paper` set `paper_location` =\"" . $newFileLoc . "\" where `uid` =" . $uid;
    $ret = $mysqli->query( $sqlSetFileLoc );

    if( $ret != true ) {
        echo "setting file location failed.\n";
        echo "SQL: " .$sqlSetFileLoc . "\n";
        unlink( $newFileLoc );
    }

    $ret->free();

    // 状态4？

