<?php

    require( "../system/config/root.php" );


    $paperSet = $_POST[ "paperChosen" ];
    $expertSet = $_POST[ "expertChosen" ];
    $major = $_POST["major"];

    $paperAssigned = array(); // 成功分配的论文

    // 专家或论文不足
    if( count( $expertSet ) < 2 || count( $paperSet ) < 1 ) {
        exit();
    }

    // 最大随机迭代次数
    $maxIteration = 10;

    foreach( $paperSet as $eachPaperId ) {

        // 根据paperId查tutor_uid和paper_step和paper_major

        // listMajor中已过滤过token,这里不再判断
        $sqlSelect = "select `tutor_uid` from `wt_paper` where `paper_id` = " . $eachPaperId;
        $ret = $mysqli->query( $sqlSelect );
        if( $ret != true ) {
            exit();
        }
        $tutorSet = array();
        $ret->data_seek(0);

        while($row = $ret->fetch_assoc() ) {
            $tutorSet[] = $row;
        }
        $tutorId = $tutorSet[0]["tutor_uid"];


        // 从expertSet中随机取两个专家
        $expertChosen = array();

        // 随机选择过程
        $chosenOne = array_rand( $expertSet , 1 );
        $chosenTwo = 0;
        $expertChosen[] = $chosenOne;
        $isChosen = false;

        for( $i = 0 ; $i < $maxIteration ; $i++ ) {
            $_chosenTwo = array_rand( $expertSet , 1 );
            if( $_chosenTwo != $tutorId && !in_array( $_chosenTwo , $expertChosen ) ) { // 选中第二个
                $isChosen = true;
                $chosenTwo = $_chosenTwo;
                break;
            }
        }

        // 迭代之后未找到
        if( !$isChosen ) {
            exit();
        }

        // 找到之后为该论文分配
        $nowTime = time();

        $sqlInsert = "insert into `wt_paper_blind`(`paper_id` , `uid` , `add_time`) values ( ". $eachPaperId;
        $blindSql1 = $sqlInsert . ", ". $chosenOne . " , " . $nowTime . " ) ";
        $ret = $mysqli->query( $blindSql1 );
        if( $ret != true ) {
            exit();
        }
        $blindSql2 = $sqlInsert . ", ". $chosenTwo . ", " . $nowTime . " ) ";
        $ret = $mysqli->query( $blindSql2 );
        if( $ret != true ) {
            exit();
        }
        array_push( $paperAssigned , $eachPaperId );
    }

    $total = count( $paperSet );
    $assigned = count( $paperAssigned );

    echo json_encode( [

        "done" => $assigned,
        "failed" => $total - $assigned,
        "debug" => [ $chosenOne , $chosenTwo ]

    ]);