//获取所有表单的信息
function getAttributes(type){
  return {
    "username" : $("#username").val(),
    "password" : $("#password").val(),
    "name"     : $("#name").val(),
    "sex"      : $("#sex").val() == 1 ? false : true,
    "intro"    : $("#intro").val(),
    "phone"    : $("#phone").val()
  };
}
//检测用户名是否合法
function check_username(usernameV){
  var reg = new RegExp("^[a-z|A-Z|0-9]{6,18}$");
  if($.trim(usernameV) == ''){
    return "账号不能为空";
  }else if(!reg.test(usernameV)){
    return "有非法字符或者位数没在6~18之间";
  }else{
    return true;
  }
}
//检测用户的密码是否合法
function check_password(passwordV){
  if(passwordV.length < 6 || passwordV.length > 18){
    return "密码长度请限制在6~18";
  }else{
    return true;
  }
}

//检测用户的密码是否合法
function check_name(nameV){
  if(nameV.length < 2 || nameV.length > 10){
    return "名字长度请限制在2~10";
  }else{
    return true;
  }
}

//检测用户的电话是否合法
function check_phone(phoneV){
  var regexp = new RegExp("[0-9]{8,14}");
  if(!regexp.test(phoneV)){
    return "电话号码格式不对";
  }else{
    return true;
  }
}

$(function(){
  //提交注册请求
  $("#resign").bind("click", function(e){
    //获取所有属性
    var msg = getAttributes();
    /*显示所有的错误信息*/
    $("#username").keyup();
    $("#password").keyup();
    $("#name").keyup();
    $("#phone").keyup();
    /*开始提交注册请求*/
    if(check_username(msg['username']) === true &&
       check_password(msg['password']) === true &&
       check_phone(msg['phone']) === true &&
       check_name(msg['name']) === true) {
      $.post("phpModel/user_resign.php", {
        username : msg['username'],
        password : msg['password'],
        name     : msg['name']    ,
        sex      : msg['sex']     ,
        intro    : msg['intro']   ,
        phone    : msg['phone']
      }, function(data){
        switch(data.status){
          case 100: alert("注册成功"); break;
          case 101: alert("已经被注册"); break;
        }
      }, "json");
    }
  });

  //提交登录请求
  $("#login").bind("click", function(e){
    $.post("phpModel/user_login.php", {
      username : $("#username").val(),
      password : $("#password").val(),
    }, function(data){
      switch(data.status){
        case 200: location.assign("noteManager.php");break;
        case 201: alert("密码错误"); break;
        case 202: alert("用户不存在"); break;
      }
    }, "json");
  });
  //检测用户名
  $("#username").bind("keyup", function(e){
    var result = check_username($(this).val());

    if(result !== true){
      $(".username-msg").text(result);
    }else{
      $(".username-msg").text(" ");
    }
  });
  //检测密码
  $("#password").bind("keyup", function(e){
    var result = check_password($(this).val());

    if(result !== true){
      $(".password-msg").text(result);
    }else{
      $(".password-msg").text(" ");
    }
  });

  //检测名字
  $("#name").bind("keyup", function(e){
    var result = check_name($(this).val());

    if(result !== true){
      $(".name-msg").text(result);
    }else{
      $(".name-msg").text(" ");
    }
  });

  //检测名字
  $("#phone").bind("keyup", function(e){
    var result = check_phone($(this).val());

    if(result !== true){
      $(".phone-msg").text(result);
    }else{
      $(".phone-msg").text(" ");
    }
  });
});
