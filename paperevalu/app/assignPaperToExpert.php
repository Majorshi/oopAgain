<?php
/**
 * Created by PhpStorm.
 * User: seanr
 * Date: 2016/1/20
 * Time: 20:06
 */

    require( "../system/config/root.php" );

    $assignSet = $_POST["assignSet"];
    $paperSet = $assignSet[ "paperSet" ];
    $exptSet = $assignSet[ "exptSet" ];
    $restrict = $assignSet[ "restrict" ];

    foreach( $paperSet as $eachPaperId ) {

        // 根据paperId查tutor_uid和paper_step和paper_major
    }