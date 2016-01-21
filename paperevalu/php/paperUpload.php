<?php
    include("../system/config/root.php");
  include('../system/global/header.inc');
  include('../system/global/session.inc');
  include('../system/global/navbar.inc');
  include('../system/global/permissionCheck.php');
  permissionCheck(1);
  if ($_GET['paper_id'] == null) {
      echo "<script>alert('非法参数');window.location.href='../index.php'; </script>";
        exit();
  }
  $papercheckSQL = "select * from wt_paper where uid = ".$_SESSION['wt_id']." and paper_id = ".$_GET['paper_id'];
    $pcres = $mysqli->query($papercheckSQL);
    if ($pcres->num_rows == 0) {
        echo "<script>alert('未找到论文');window.location.href='../index.php'; </script>";
        exit();
    }
    $pcres->data_seek(0);
    $paperdata = $pcres->fetch_assoc();
    $pcres->free();

    if (!($paperdata['paper_step'] == 30 || $paperdata['paper_step'] == 40)) {
        echo "<script>alert('论文未处于可上传阶段');window.location.href='../index.php'; </script>";
        exit();
    }
        ?>
        <link rel="stylesheet" type="text/css" href="../static/css/home.css">
                <div class="col-xs-9 mt100">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            选择文件
                        </div>
                        <div class="panel-body">
                            <div><strong>论文标题: </strong><?php echo $paperdata['paper_title']; ?></div>
                            <div><strong>当前文件: </strong><?php if ($paperdata['paper_location'] == null) {
                                echo "未上传文件";
                            } else  {
                                $html = "<a href = '".$paperdata['paper_location']."'>";
                                $dateStr = date("Y-m-d-H-i-s", time());
                                $filename = strtok($paperdata['paper_location'],"_");
                                $filename = strtok("_");
                                $filename = strtok("_");
                                $filename = strtok("_");
                                $html = $html.$filename."</a>";
                                echo $html;
                            }
                                 ?></div>
                            <form action = "uploadFile.php" method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input name="file" id="input-1" type="file" class="btn btn-default btn-lg btn-block"/>
                                </div>
                                <input type="text" style="display:none" name="paper_id" value=<?php echo "'".$_GET['paper_id']."'"; ?>>
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
include('../system/global/navbarfooter.inc');
        ?>

