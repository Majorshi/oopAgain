<?php
    require ("../system/global/session.inc");
    require( "../system/config/root.php" );



    // 查询领域
    $sqlSelect = "select `major_id`,`major_name` from `wt_major` where 1";
    $ret = $mysqli->query( $sqlSelect );

    if( $ret != true ) {
        echo json_decode([
            "count" => 0
        ]);
    }

    $majorSet = array();

    $ret->data_seek(0);
    $cnt = 0;
    while($row = $ret->fetch_assoc() ) {
        $majorSet[] = $row;
        $cnt += 1;
    }
    $ret->free();


    // 查询待分配论文

    // 首先获得当前token
    $nowTime = time();


    $sqlSelectToken = "select `token` from `wt_evaluate_period` where `start_time` <" . $nowTime . " and " . $nowTime . "< end_time";
    $ret = $mysqli->query( $sqlSelectToken );
    if( $ret != true ) {
        exit();
    }

    $tokenData = array();
    while( $row = $ret->fetch_assoc() ) {
        $tokenData[] = $row;
    }
    $token = $tokenData[0]["token"];

    // 获得符合token的论文
    $paperSet = array();
    $sqlSelect = "select `paper_id`,`paper_title`,`paper_major`,`tutor_uid` from `wt_paper` where `paper_step` = 50 and `token` =" . $token;
    $ret = $mysqli->query( $sqlSelect );
    while( $row = $ret->fetch_assoc() ) {
        $paperSet[] = $row ;
    }

    // 查询专家
    $expertSet = array();

    $sqlSelect = "SELECT a.uid,a.realname,b.user_major FROM wt_users a JOIN wt_users_extradata b on a.uid=b.uid WHERE a.uid = b.uid and a.is_expert = 1";
    $ret = $mysqli->query( $sqlSelect );

    while( $row = $ret->fetch_assoc() ) {
        $expertSet[] = $row;
    }

    // 返回专家和论文
    echo json_encode( [
        "majorSet" => $majorSet,
        "paperSet" => $paperSet,
        "expertSet" => $expertSet
    ] );
