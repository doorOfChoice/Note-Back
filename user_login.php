<?php
session_start();
if(isset($_COOKIE['username'])){
  $server = $_SESSION[$_COOKIE['username']];
  if($server){
    if($server['username'] == $_COOKIE['username'] &&
       $server['password'] == $_COOKIE['password'] &&
       $server['csym'] == $_COOKIE['csym']){
        echo "<script type='text/javascript'>
          location.assign('noteManager.php');
        </script>";
    }
  }
}
?>
<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="generator" content="Atom">
      <meta name="author" content="dawndevil, 351987551@qq.com">
      <meta name="keywords" content="blog, 笔记本, notebook">
      <meta name="description" content="简易的笔记本+博客后台">
      <link rel="stylesheet" href="js/bs/css/bootstrap.min.css">
      <link rel="stylesheet" href="js/bs/css/bootstrap-theme.min.css">
      <link rel="stylesheet" href="css/user_login.css">
      <script type="text/javascript" src="js/jquery.min.js"></script>
      <script type="text/javascript" src="js/bs/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="js/user_logic.js"></script>
      <script type="text/javascript" src="js/user_init.js"></script>
      <title>Note-Blog</title>
  </head>
  <body style="background-color:#F0F8FF;">
    <div class="center">
      <h1>Note-Blog</h1>
      <hr>
      <div class="input-group">
        <span class="input-group-addon">账号</span>
        <input type="text" id="username" class="form-control">
      </div>

      <div class="input-group">
        <span class="input-group-addon">密码</span>
        <input type="password" id="password" class="form-control login">
      </div>

      <div class="button-group">
        <button type="button" id="login" class="btn btn-lg btn-success btn-block">登录</button>
      </div>

      <a href="user_resign.php">还没有账号吗?点击注册</a>
    </div>
  </body>
</html>
