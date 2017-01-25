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

            $mql = new MysqlOperation($usr_base);
            $username = $server['username'];
            $result = $mql->query("SELECT name,sex,birthday,phone,intro,head_address
                                   FROM {$table} where username=\"{$username}\"");

            if($result && $result->num_rows != 0)
            {
                echo json_encode(array("status"=>200, "data"=>$result->fetch_assoc(), "descrip"=>"获取成功"));
            }
            else
            {
                echo json_encode(array("status"=>201, "descrip"=>"获取数据库失败"));
            }
        }
    }
  }
?>
