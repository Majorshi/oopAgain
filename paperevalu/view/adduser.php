<?php
  include('../system/global/header.inc');
  include('../system/global/session.inc');
?>
<link href="/paperevalu/static/css/home.css" rel="stylesheet" /> 

  <div class="navbar navbar-inverse navbar-fixed-top" role="navigation"> 
   <div class="container"> 
    <div class="navbar-header"> 
     <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button> 
     <a class="navbar-brand" href="adminHome.html">软件学院论文盲审系统</a> 
    </div> 
    <!-- Split button --> 
    <form class="navbar-form navbar-right"> 
     <div class="btn-group"> 
      <a href="adminInfo.html" class="btn btn-primary  active" role="button">管理员</a> 
      <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown"> <span class="caret"></span> <span class="sr-only">Toggle Dropdown</span> </button> 
      <ul class="dropdown-menu" role="menu"> 
       <li><a href="adminInfo.html">个人信息</a></li> 
       <li class="divider"></li> 
       <li> <a href="adminPassword.html">修改密码</a> </li> 
       <li class="divider"></li> 
       <li><a href="#">登出</a></li> 
      </ul> 
     </div> 
    </form> 
   </div> 
  </div> 
  <div class="container"> 
   <div class="row"> 
    <div class="col-xs-3 mt60"> 
     <ul class="nav nav-pills nav-stacked"> 
      <li class="text-muted"> <h3>论文盲审</h3> </li> 
      <li class="inactive"> <a href="adminHome.html"> 下载论文 </a> </li> 
      <li class="inactive"> <a href="adminCheckResult.html"> 查看查重结果 </a> </li> 
      <li class="text-muted"> <h3>个人信息</h3> </li> 
      <li class="active"><a href="adminInfo.html">个人主页</a></li> 
      <li class="inactive"><a href="adminPassword.html">修改密码</a></li> 
     </ul> 
    </div> 
    <div class="col-xs-9 mt100"> 
     <form class="form-horizontal"> 
      <div class="form-group"> 
       <label for="inputEmail3" class="col-sm-2 control-label">电子邮件</label> 
       <div class="col-sm-10"> 
        <input type="email" class="form-control" id="inputEmail3" placeholder="Email" /> 
       </div> 
      </div> 
      <div class="form-group"> 
       <label for="inputPassword3" class="col-sm-2 control-label">电话</label> 
       <div class="col-sm-10"> 
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" /> 
       </div> 
      </div> 
      <div class="form-group"> 
       <label for="inputPassword3" class="col-sm-2 control-label">地址</label> 
       <div class="col-sm-10"> 
        <input type="password" class="form-control" id="inputPassword3" placeholder="Password" /> 
       </div> 
      </div> 
      <div class="form-group"> 
       <div class="col-sm-offset-2 col-sm-10"> 
        <button type="submit" class="btn btn-default">Sign in</button> 
       </div> 
      </div> 
     </form> 
    </div> 
   </div> 
  </div>
  <?php
    echo $_SESSION['wt_password'];
    /*
    session_destroy();
    setcookie(session_name(),"",time()-1);
    $_SESSION = array();
    */
  ?> 

<?php
  include('../system/global/footer.inc');
?>