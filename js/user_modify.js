//从服务器上获取用户信息
function printUserMessage(username){
  $(".loading-panel").show();
  $.post("phpModel/user_message.php", {username : username}, function(data){
    if(data != null)
      setUserMessage(data);
    $(".loading-panel").hide();
  }, "json");
}
//把信息放入到对应的组件里面
function setUserMessage(message){
  if(message != null){
    $("#name").val(message.name);
    $("#sex").val(message.sex);
    $("#phone").val(message.phone);
    $("#birthday").val(message.birthday);
    $("#intro").val(message.intro);
  }
}
$(function(){
  /*  添加切换导航的监听器
   *  可以在个人信息和修改密码之间切换
   */
  printUserMessage(USERNAME);
  var navMessageChildren = $("#nav-message").children();
  navMessageChildren.bind("click", function(e){
    navMessageChildren.removeClass("active");
    $(this).addClass("active");
    if($(this).attr("id") === "message-basement"){
      $(".user-message").show(500);
      $(".user-password").hide(500);

      printUserMessage(USERNAME);
    }else if($(this).attr("id") === "message-password"){
      $(".user-message").hide(500);
      $(".user-password").show(500);
    }
  });

  //提交保存信息
  $("#user-message").bind("click", function(e){
    $(".loading-panel").show();
    var msg = getAttributes();
    var errorMsg;
    if((errorMsg = check_name(msg['name'])) === true &&
       (errorMsg = check_phone(msg['phone'])) === true &&
       (errorMsg = check_birthday(msg['birthday'])) === true &&
       (errorMsg = check_intro(msg['intro'])) === true){

         $.post("phpModel/user_modify_information_basic.php", {
           username : USERNAME,
           name : msg['name'],
           sex  : msg['sex'],
           phone : msg['phone'],
           intro : msg['intro'],
           birthday : msg['birthday']
         }, function(data){
           $(".loading-panel").hide();
         });
    }else{
      alert(errorMsg);
      $(".loading-panel").hide();
    }
  });

  $("#user-password").bind("click", function(e){
    var oldPassword = $("#old-password").val();
    var newPassword = $("#new-password").val();
    var newPasswordAgain = $("#new-password-again").val();
    var errorMsg ;
    if((errorMsg = check_password(oldPassword)) === true &&
       (errorMsg = check_password(newPassword)) === true &&
       (errorMsg = check_password(newPasswordAgain)) === true &&
       (errorMsg = check_modify_password(newPassword, newPasswordAgain))
       === true){
         $(".loading-panel").show();
         $.post("phpModel/user_modify_information_password.php",{
           username : USERNAME,
           oldPassword : oldPassword,
           newPassword : newPassword,
           newPasswordAgain : newPasswordAgain
         }, function(data){
           if(data.status == 200){
             alert("修改密码成功!");
             window.location.reload();
           }
           $(".loading-panel").hide();
         }, "json");
    }else{
      alert(errorMsg);
      $(".loading-panel").hide();
    }
  });
});
