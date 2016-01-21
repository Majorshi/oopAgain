<div class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
  <div class="container"> 
    <div class="navbar-header">
      <img src="/paperevalu/static/images/logo.gif" alt="院徽" />
      <span>论文盲审系统</span>
    </div>
    <!-- Split button -->
    <form class="navbar-form navbar-right">
      <div class="btn-group">
        <a href="adminInfo.html" class="btn btn-primary active" role="button">
          <?php
            if($_SESSION['wt_status'] == 3)
            {
              echo "研究生导师";
            }
            else if($_SESSION['wt_status'] == 2)
            {
              echo "管理员";
            }
            else
            {
              echo "研究生";
            }
          ?>
        </a>
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" style="height: 34px;">
          <span class="caret"></span>
          <span class="sr-only">Toggle Dropdown</span>
        </button> 
        <ul class="dropdown-menu" role="menu"> 
          <li><a href="/paperevalu/view/studentInfo.php">个人信息</a></li>
          <li class="divider"></li>
          <li><a href="/paperevalu/view/studentPassword.php">修改密码</a></li>
          <li class="divider"></li>
          <li><a href="javascript:void(0)" onclick="">登出</a></li> 
        </ul>
      </div>
    </form>
  </div> 
</div>
<div class="container">
  <div class="row"> 
    <div class="col-xs-3 mt60"> 
      <ul class="nav nav-pills nav-stacked"> 
        <li class="text-muted"> <h3>论文评审</h3> </li> 
        <?php 
          if($_SESSION['wt_status'] == 3){
        ?>
          <li><a href="javascript:void(0)"> 评审论文 </a> </li> 
          <li><a href="javascript:void(0)"> 填写意见 </a> </li> 
          <li><a href="javascript:void(0)"> 查看评审进度 </a> </li> 
        <?php
          } else if($_SESSION['wt_status'] == 2) {
        ?>
          <li><a href="javascript:void(0)"> 审核申请 </a> </li> 
          <li><a href="javascript:void(0)"> 分配论文 </a> </li> 
          <li><a href="javascript:void(0)"> 查看评审结果 </a> </li> 
        <?php
          } else{
        ?>
          <li><a href="/paperevalu/php/evaluateApply.php"> 申请论文评审 </a> </li> 
          <li><a href="javascript:void(0)"> 上传论文 </a> </li> 
          <li><a href="javascript:void(0)"> 查看评审进度 </a> </li> 
          <li><a href="javascript:void(0)"> 查看评审结果 </a> </li> 
        <?php } ?>
        <li class="text-muted"> <h3>个人信息</h3> </li> 
        <li><a href="/paperevalu/view/studentInfo.php">个人主页</a> </li> 
        <li><a href="/paperevalu/view/studentPassword.php">修改密码</a> </li> 
      </ul> 
    </div>
    