<?php
session_start();

require_once("MysqlOperation.php");
$table = "user";

if(isset($_COOKIE['username'])){
  $server = $_SESSION[$_COOKIE['username']];
  if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym'])
      {
            $username     = $server['username'];
            $old_password = !empty($_POST["oldPassword"]) ? md5($_POST["oldPassword"]) : null;
            $new_password = !empty($_POST["newPassword"]) ? md5($_POST["newPassword"]) : null;
            $new_password_again = !empty($_POST["newPasswordAgain"]) ? md5($_POST["newPasswordAgain"]) : null;

            if($old_password && $new_password && $new_password_again
               && ($new_password === $new_password_again)
               && ($old_password === $server['password']))
            {
                $mql = new MysqlOperation($usr_base);
                $result = $mql->query("
                   UPDATE {$table} SET password=\"{$new_password}\"
                   where username=\"{$username}\"");

                if($result)
                {
                  unset($_SESSION[$username]);
                  setcookie("username","",time()-3600, "/");
                  setcookie("password","",time()-3600, "/");
                  setcookie("csym","",time()-3600, "/");
                  echo json_encode(array("status" => "200", "descrip" => "密码修改成功"));
                }
                else
                {
                  echo json_encode(array("status" => "202", "descrip" => "更新数据库失败"));
                }
            }
            else
            {
              echo json_encode(array("status" => "201", "descrip" => "原始密码验证失败"));
            }
      }
  }
}
?>
