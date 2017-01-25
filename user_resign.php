<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/user_resign.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="laydate/laydate.js"></script>
    <script type="text/javascript" src="js/user_logic.js"></script>
    <script type="text/javascript" src="js/user_init.js"></script>
    <title>登录</title>
  </head>
  <body style="background-color:#F0F8FF;">
    <div class="center">
        <h1>Note-Blog 注册</h1>
        <hr>
        <label for="">用户名 <span style="color:red">*</span></label>
        <input type="text" id="username" class="form-control" placeholder="Username">
        <p style="color:red" class="username-msg"></p>

        <label for="">密码 <span style="color:red">*</span></label>
        <input type="password" id="password" class="form-control" value="">
        <p style="color:red" class="password-msg"></p>

        <label for="">姓名 <span style="color:red">*</span></label>
        <input type="text" id="name" class="form-control" placeholder="Name">
        <p style="color:red" class="name-msg"></p>

        <div class="input-group">
          <label for="">性别 <span style="color:red">*</span></label>
          <select id="sex" class="form-control" name="">
            <option value="0">男</option>
            <option value="1">女</option>
          </select>
        </div>

        <div class="input-group">
          <label for="">出生日期 <span style="color:red">*</span></label>
          <input type="text" class="form-control" id="birthday" onclick="laydate({elem:'#birthday'})" readonly style="cursor:pointer;">
          <p style="color:red" class="birthday-msg"></p>
        </div>

        <div class="input-group">
          <label for="">电话 <span style="color:red">*</label>
          <input type="text" id="phone" class="form-control" placeholder="Phone">
          <p style="color:red" class="phone-msg"></p>
        </div>


        <label for="">个人简介</label><br/>
        <textarea id="intro" class="from-control" ></textarea>
        <p style="color:red" class="intro-msg"></p>


        <div class="button-group">
          <button type="button" id="resign" class="btn btn-lg btn-primary btn-block" name="button">注册</button>
        </div>

        <a href="user_login.php"><-返回登陆</a>
    </div>
  </body>
</html>
