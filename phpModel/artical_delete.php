<?php
session_start();
require_once("MysqlOperation.php");

if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
        if($server['username'] == $_COOKIE['username'] &&
           $server['password'] == $_COOKIE['password'] &&
           $server['csym'] == $_COOKIE['csym'])
        {
          if(isset($_POST['id']))
          {
              $id = $_POST['id'];
              $username = $server['username'];

              $conn = new MysqlOperation($art_base);
              $result = $conn->query("DELETE from {$username} where id={$id}");

              if($result)
              {
                  echo json_encode(array("status" => "ok"));
              }
              else
              {
                  echo json_encode(array("status" => "fail"));
              }

          }
        }
    }
}

?>
