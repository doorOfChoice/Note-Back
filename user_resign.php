<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/user_resign.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/login_init.js"></script>
    <title>登录</title>
  </head>
  <body>
    <div class="center">
        <h1>Note-Blog 注册</h1>
        <hr>
        <label for="">用户名 <span style="color:red">*</span></label>
        <input type="text" id="username" class="form-control" placeholder="Username">
        <p style="color:red" class="username-msg"></p>

        <label for="">密码 <span style="color:red">*</label>
        <input type="password" id="password" class="form-control" value="">
        <p style="color:red" class="password-msg"></p>

        <label for="">姓名 <span style="color:red">*</label>
        <input type="text" id="name" class="form-control" placeholder="Name">
        <p style="color:red" class="name-msg"></p>

        <div class="input-group">
          <label for="">性别 <span style="color:red">*</label>
          <select id="sex" class="form-control" name="">
            <option value="1">男</option>
            <option value="2">女</option>
          </select>
        </div>

        <label for="">电话 <span style="color:red">*</label>
        <input type="text" id="phone" class="form-control" placeholder="Phone">
        <p style="color:red" class="phone-msg"></p>

        <label for="">兴趣爱好</label>
        <input type="text" id="sex" class="form-control" placeholder="Hobby">

        <label for="">个人简介</label><br/>
        <textarea id="intro" class="from-control" id="intro"></textarea>

        <div class="button-group">
          <button type="button" id="resign" class="btn btn-lg btn-primary btn-block" name="button">注册</button>
        </div>
        <a href="user_login.php"><-返回登陆</a>
    </div>
  </body>
</html>
