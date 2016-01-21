<?php
  include('../system/global/header.inc');

  ob_start();
  session_unset();
  @session_destroy();
?>
<link href="/paperevalu/static/css/index.css" rel="stylesheet" />
<script type="text/javascript" src="/paperevalu/static/js/login.js"></script>
<div class="container"> 
  <div id="loginWindow">
    <div id="title"> 
      <img src="/paperevalu/static/images/logo.gif" alt="院徽" />
      <span>论文盲审系统</span>
    </div>
    <div id="test" class="modal-body"> 
      <form class="form-signin" id="loginform" method="post"> 
        <input type="text" name="name" id="username" class="form-control form-magin" placeholder="用户名" required="" autofocus="" /> 
        <input type="password" name="password" id="password" class="form-control form-magin" placeholder="密码" required="" /> 
        <button class="btn btn-lg btn-primary btn-block form-magin" type="button" data-dismiss="modal" onclick="login($('#loginform'))">登录</button>
      </form> 
      <div class="loadtips"></div>
    </div> 
  </div>
</div>
<div class="footer">Copyright &copy; <?php echo date('Y'); ?>, All Rights Reserved Powered By School of Software, BIT</div>
</body>
</html>
