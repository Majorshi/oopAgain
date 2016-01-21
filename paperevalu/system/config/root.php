<?php

    $mysqli->real_connect('localhost', 'root', '', 'wetrial');
    if(mysqli_connect_errno())
    {
     echo mysqli_connect_error();
    }

    mysqli_set_charset($mysqli, "utf8");
?>