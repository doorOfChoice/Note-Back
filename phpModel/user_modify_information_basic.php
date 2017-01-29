<?php
session_start();

require_once("MysqlOperation.php");
require_once("StringOperation.php");
$table = "user";

if(isset($_COOKIE['username'])){
  $server = $_SESSION[$_COOKIE['username']];
  if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym'])
      {

          if(!empty($_POST['name'])     &&
             !empty($_POST['sex'])      &&
             !empty($_POST['intro'])    &&
             !empty($_POST['phone'])    &&
             !empty($_POST['birthday']) )
          {
              $_POST["name"]  = str_convert($_POST['name']);
              $_POST['intro'] = str_convert($_POST['intro']);

              $mql = new MysqlOperation($usr_base);
              $result = $mql->query("UPDATE {$table} SET
              name=\"{$_POST['name']}\", sex={$_POST['sex']},
              intro=\"{$_POST['intro']}\"  , phone=\"{$_POST['phone']}\",
              birthday=\"{$_POST['birthday']}\" where username=\"{$server['username']}\"");

              if($result)
              {
                echo json_encode(array("status" => 200, "descrip"=>"修改成功"));
              }
              else
              {
                echo json_encode(array("status" => 201, "descrip"=>"数据库更新失败"));
              }
          }
          else
          {
            echo json_encode(array("status" => 202, "descrip"=>"参数不正确"));
          }
      }
  }
}
?>
