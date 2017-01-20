function getAttributes(type){
  return {
    "username" : $("#username").val(),
    "password" : $("#password").val(),
    "name"     : $("#name").val(),
    "sex"      : $("#sex").val() == 1 ?
                 false : true,
    "intro"    : $("#intro").val(),
    "phone"    : $("#phone").val()
  };
}

$(function(){
  $("#resign").bind("click", function(e){
    var msg = getAttributes();
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

  });
});

$(function(){
  $("#login").bind("click", function(e){
    $.post("phpModel/user_login.php", {
      username : $("#username").val(),
      password : $("#password").val(),
    }, function(data){
      switch(data.status){
        case 200: alert("登录成功"); break;
        case 201: alert("密码错误"); break;
        case 202: alert("用户不存在"); break;
      }
    }, "json");

  });
});
