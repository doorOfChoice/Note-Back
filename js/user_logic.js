//获取所有表单的信息
function getAttributes(){
  return {
    "username" : $("#username").val(),
    "password" : $("#password").val(),
    "name"     : $("#name").val(),
    "sex"      : $("#sex").val() == 0 ? false : true,
    "birthday" : $("#birthday").val(),
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
  }

  return true;
}
//检测用户的密码是否合法
function check_password(passwordV){
  if(passwordV.length < 6 || passwordV.length > 18){
    return "密码长度请限制在6~18";
  }

  return true;
}

//检测用户的密码是否合法
function check_name(nameV){
  if(nameV.length < 2 || nameV.length > 10){
    return "名字长度请限制在2~10";
  }

  return true;
}

function check_birthday(birthdayV){
  if($.trim(birthdayV) == ""){
    return "生日不能为空";
  }

  return true;
}
//检测用户的电话是否合法
function check_phone(phoneV){
  var regexp = new RegExp("[0-9]{8,14}");
  if(!regexp.test(phoneV)){
    return "电话号码格式不对";
  }

  return true;
}

function check_intro(introV){
  var intro_len = introV.length;

  if(intro_len > 150){
    return "个人介绍不得超过150个字";
  }

  return true;
}

//验证两次密码是否一样
function check_modify_password(pw1, pw2){
  if(pw1 !== pw2){
    return "两次密码输入不同";
  }

  return true;
}
