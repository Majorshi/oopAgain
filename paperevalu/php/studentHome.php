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
        <link href="../static/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="../static/css/home.css" rel="stylesheet" type="text/css" />
        <link href="../static/css/index.css" rel="stylesheet" type="text/css" />
        <div class="container">
            <div class="row">
                <div class="col-xs-3 mt60">
                    <ul class="nav nav-pills nav-stacked">
                        <li class="text-muted"><h3>论文盲审</h3></li>
                        <li class="active"><a href="studentHome.html"> 上传论文 </a></li>
                        <li class="inactive"><a href="studentProgress.html"> 查看评审进度 </a></li>
                        <li class="inactive"><a href="studentResult.html"> 查看评审结果 </a></li>
                        <li class="text-muted"><h3>个人信息</h3></li>
                        <li><a href="studentInfo.html">个人主页</a></li>
                        <li><a href="studentPassword.html">修改密码</a></li>
                    </ul>
                </div>
                <div class="col-xs-9 mt100">
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

