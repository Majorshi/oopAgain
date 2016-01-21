<?php
  include('../system/global/header.inc');
  include('../system/global/session.inc');
?>
<link href="/paperevalu/static/css/home.css" rel="stylesheet" /> 
<?php
  include('../system/global/navbar.inc');
?>
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
    <?php
      /*echo $_SESSION['wt_password'];
      session_destroy();
      setcookie(session_name(),"",time()-1);
      $_SESSION = array();
      */
    ?> 
<?php
    include('../system/global/navbarfooter.inc');
?>