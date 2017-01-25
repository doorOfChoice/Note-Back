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
    $("#intro").keyup();
    $("#birthday").keyup();
    /*开始提交注册请求*/
    if(check_username(msg['username']) === true &&
       check_password(msg['password']) === true &&
       check_phone(msg['phone']) === true &&
       check_name(msg['name'])   === true &&
       check_intro(msg['intro']) === true &&
       check_birthday(msg['birthday']) === true) {
      $.post("phpModel/user_resign.php", {
        username : msg['username'],
        password : msg['password'],
        name     : msg['name']    ,
        sex      : msg['sex']     ,
        birthday : msg['birthday'],
        intro    : msg['intro']   ,
        phone    : msg['phone']
      }, function(data){
        alert(data.descrip);
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
        case 200 : location.assign("noteManager.php") ;break ;
        default  : alert(data.descrip); break;
      }
    }, "json");
  });


  $(".login").bind("keydown", function(e){
    if(e.keyCode == 13){
      $("#login").click();
    }
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

  //检测生日
  $("#birthday").bind("keyup", function(e){
    var result = check_birthday($(this).val());

    if(result !== true){
      $(".birthday-msg").text(result);
    }else{
      $(".birthday-msg").text(" ");
    }
  });

  //检测电话
  $("#phone").bind("keyup", function(e){
    var result = check_phone($(this).val());

    if(result !== true){
      $(".phone-msg").text(result);
    }else{
      $(".phone-msg").text(" ");
    }
  });

  //检测个人简介
  $("#intro").bind("keyup", function(e){
    var result = check_intro($("#intro").val());

    if(result !== true){
      $(".intro-msg").text(result);
    }else{
      $(".intro-msg").text(" ");
    }
  });
});
