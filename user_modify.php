<?php
  session_start();
  $login = false;
  if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym'])
      {
         $login = true;
         echo "<script> USERNAME = \"{$server['username']}\"; </script>";
      }
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <?php
        if(!$login){
          echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0; url=user_login.php\"";
        }
    ?>
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/user_modify.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.js"></script>
    <script type="text/javascript" src="laydate/laydate.js"></script>
    <script type="text/javascript" src="js/user_logic.js"></script>
    <script type="text/javascript" src="js/user_modify.js"></script>
    <title>Note-Blog修改用户信息</title>
  </head>
  <body>

    <div class="loading-panel" hidden>
      <img src="picture/loading.gif" class="icon" alt="loading">
    </div>

    <div class="container" >
      <div class="row">
        <div class="col-md-2">
          <ul class="nav nav-pills nav-stacked" id="nav-message">
            <li class="active" id="message-basement"><a href="#">修改个人信息</a></li>
            <li id="message-password"><a href="#">修改密码</a></li>
          </ul>
        </div>

        <div class="col-md-10">
          <div class="user-message" >
            <h1>基本资料</h1>
            <div class="col-md-2 text-center interval">
              <img src="userimage\kankanba\83decd5278b958b9d19448384f5a5a28.jpg" class="circle center interval img-64" alt="head">
              <div class="button-group ">
                <button type="button" class="btn btn-default">修改头像</button>
              </div>
            </div>
            <div class="col-md-10">
              <div class="input-group input-group-name interval">
                <label for="">姓名</label>
                <input type="text" class="form-control" id="name">
              </div>

              <div class="input-group input-group-sex interval">
                <label for="">性别</label><br/>
                <select class="" id="sex">
                  <option value="0" class="0">男</option>
                  <option value="1" class="1">女</option>
                </select>
              </div>

              <div class="input-group input-group-birthday interval">
                <label for="">出生日期</label>
                <input type="text" class="form-control" id="birthday" onclick="laydate({elem:'#birthday'})" readonly>
              </div>

              <div class="input-group input-group-phone interval">
                <label for="">电话号码</label>
                <input type="text" class="form-control" id="phone" >
              </div>

              <div class="input-group input-group-intro interval">
                <label for="">个人介绍</label>
                <textarea class="form-control" id="intro"></textarea>
              </div>
            </div>

            <div class="button-group" >
              <button type="button" class="btn btn-default" id="user-message">保存修改</button>
            </div>
          </div>

          <div class="user-password" hidden>

              <h1>修改密码</h1>
              <div class="input-group interval">
                <label for="">旧密码</label>
                <input type="password" class="form-control " id="old-password">
              </div>

              <div class="input-group interval">
                <label for="">新密码</label>
                <input type="password" class="form-control" id="new-password">
              </div>

              <div class="input-group interval">
                <label for="">再输入一次</label>
                <input type="password" class="form-control" id="new-password-again">
              </div>

              <div class="button-group">
                <button type="button" class="btn btn-default" id="user-password">保存修改</button>
              </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
