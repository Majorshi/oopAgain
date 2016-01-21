<?php

include('../system/global/session.inc');
require_once ('funcLib/funcIsSignedIn.inc');

// TODO:权限
if( false ) {

    print "您还没有登录，5秒之后跳转回主页";
    print ",如果没有自动跳转，请点击";
    print "<a href = \"/paperevalu/view/index.html\" >这里</a>";
    // header('Refresh: 5; url = /paperevalu/view/index.html');

} else {
    ?>
    <script type="text/javascript" src="../static/js/listMajor.js"></script>
    <link href="../static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="../static/css/home.css" rel="stylesheet" type="text/css" />
    <link href="../static/css/index.css" rel="stylesheet" type="text/css" />
    <div class="container">
        <div class="row">

            <div class="col-xs-9 mt100">

                <div class="btn-group">

                    <select id="major">
                        <option value="0">全部领域</option>
                    </select>


                </div>


                <button class="btn btn-primary" id="confirmMajor" >确认</button>

                <div class="btn-group">
                    <table id="paperlist">
                        <tr>
                            <td><input type="checkbox" value="0" ></td>
                                <td>论文标题</td>

                        </tr>
                    </table>

                    <talbe id="expertlist">
                        <tr>
                            <td><input type="checkexpert" value="0" ></td>
                            <td>专家真名</td>
                        </tr>
                    </talbe>
                </div>

            </div>
        </div>
    </div>
    <?php
}
?>

