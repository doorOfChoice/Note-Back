<?php
  require("MysqlOperation.php");
  $table = "user";
  /*
  [200 登录成功] [201 密码错误] [202 用户不存在]
  */
  if(isset($_POST['username']) && isset($_POST['password'])){
    $username=$_POST['username'];
    $password=md5($_POST['password']);
    $mql = new MysqlOperation();

    if($mql){
      $result = $mql->query("SELECT * from {$table} WHERE username=\"{$username}\"");
      if($result){
        if($result->num_rows == 0){
          echo json_encode(array("status"=>202));
        }else{
          //获取从数据库中得到的用户信息
          $user = $result->fetch_assoc();

          if($password != $user['password']){ //密码输入错误
            echo json_encode(array("status"=>201));
          }else{  //登录成功
            echo json_encode(array(
              "status"=>200,
              "username"=>$username,
              "password"=>$password
            ));
          }
        }
      }
    }

  }
?>
