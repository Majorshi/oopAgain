<?php
    /*$con = mysql_connect("localhost","root","");
    if(!$con) 
    {
        die('Could not connect: ' . mysql_error());
    }

    $db_selected = mysql_select_db("wetrial", $con);
    if(!$db_selected) 
    {
        die ("Can\'t use test_db : " . mysql_error());
    }
    mysql_query("SET NAMES utf8");*/

    $mysqli = mysqli_init();

    $mysqli->options(MYSQLI_OPT_CONNECT_TIMEOUT, 2);//设置超时时间

    $mysqli->real_connect('localhost', 'root', '', 'wetrial');
    if(mysqli_connect_errno())
    {
     echo mysqli_connect_error();
    } 
    mysqli_set_charset($mysqli, "utf8");
?>