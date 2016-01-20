<?php
  include('../system/global/header.inc');
?>
<script type="text/javascript" src="/paperevalu/static/js/login.js"></script>
<div class="container"> 
  <div id="loginWindow">
    <div id="title"> 
      <img src="../static/images/logo.gif" alt="院徽" />
      <span>论文盲审系统</span>
    </div>
    <div id="test" class="modal-body"> 
      <form class="form-signin" role="form" id="loginform" method="post"> 
        <input type="text" name="name" id="username" class="form-control form-magin" placeholder="用户名" required="" autofocus="" /> 
        <input type="password" name="password" id="password" class="form-control form-magin" placeholder="密码" required="" /> 
        <button class="btn btn-lg btn-primary btn-block form-magin" type="submit" data-dismiss="modal" onclick="login($('#loginform'))">登录</button>
      </form> 
    </div> 
  </div>
</div>
<?php
  include('../system/global/footer.inc');
?>
