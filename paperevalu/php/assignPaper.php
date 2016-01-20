<?php
include('../system/global/header.inc');
require_once ('funcLib/funcIsSignedIn.inc');

session_start();

if( isSignedIn() ) {

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
                        <option>static1</option>
                        <option>static2</option>
                    </select>

                    <button class="btn btn-primary" id="confirmMajor" >确认领域</button>
                </div>

                <div class="panel panel-primary">
                    <div class="panel-heading">
                        选择文件
                    </div>
                    <div class="panel-body">
                        <form action = "uploadFile.php" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <input name="file" id="input-1" type="file" class="btn btn-default btn-lg btn-block"/>
                            </div>

                            <button type="submit" class="btn btn-primary ">确认提交</button>
                        </form>
                    </div>
                    <div class="panel-footer">
                        <li class="help-block">必须是 PDF 格式文件</li>
                        <li class="help-block">文件大小小于 10 M</li>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
include('../system/global/footer.inc');
?>

