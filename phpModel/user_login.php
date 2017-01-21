<?php
  session_start();
  require("MysqlOperation.php");
  $table = "user";
  /*
  [200 登录成功] [201 密码错误] [202 用户不存在]
  */
  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $mql = new MysqlOperation($usr_base);

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
            //随机MD5数据
            $csym = md5(rand(0, 10000));
            $_SESSION[$username] = array(
              "username" => $username,
              "password" => $password,
              "csym"     => $csym
            );
            //ajax不同文件夹的时候一定要设置作用域
            setcookie("username", $username, time() + 3600*24, "/");
            setcookie("password", $password, time() + 3600*24,"/");
            setcookie("csym", $csym, time() + 3600*24, "/");

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
