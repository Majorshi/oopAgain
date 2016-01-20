<?php

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
    $paperSet = array();

    $sqlSelect = "select `paper_id`,`paper_title`,`tutor_uid` from `wt_paper` where `paper_step` = 50";
    $ret = $mysqli->query( $sqlSelect );

    while( $row = $ret->fetch_assoc() ) {
        $paperSet[] = $row;
    }

    // 查询专家
    $profSet = array();



    echo json_encode( [
        "count" => $cnt,
        "major" => $majorSet
    ] );
