<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
      <link rel="stylesheet" href="bs/css/bootstrap.min.css">
      <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="css/user_login.css">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/login_init.js"></script>
    <title></title>
  </head>
  <body>
    <div class="center">
      <h1>Note-Blog</h1>
      <hr>
      <div class="input-group">
        <span class="input-group-addon">账号</span>
        <input type="text" id="username" class="form-control">
      </div>

      <div class="input-group">
        <span class="input-group-addon">密码</span>
        <input type="password" id="password" class="form-control">
      </div>

      <div class="button-group">
        <button type="button" id="login" class="btn btn-lg btn-success btn-block">登录</button>
      </div>

      <a href="user_resign.jsp">还没有账号吗?点击注册</a>
    </div>
  </body>
</html>
