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
            if(isset($_POST['username']))
            {
                $mql = new MysqlOperation($usr_base);
                $username = $_POST['username'];
                $result = $mql->query("SELECT name,sex,birthday,phone,intro FROM
                          {$table} where username=\"{$username}\"");

                if($result && $result->num_rows != 0){
                    echo json_encode($result->fetch_assoc());
                }
            }
        }
    }
  }
?>
