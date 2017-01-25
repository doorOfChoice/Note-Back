<?php
    session_start();
    if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
        if($server['username'] == $_COOKIE['username'] &&
           $server['password'] == $_COOKIE['password'] &&
           $server['csym'] == $_COOKIE['csym'])
        {
          if(isset($_POST['out'])){
            unset($_SESSION[$server['username']]);
            setcookie("username","",time()-3600, "/");
            setcookie("password","",time()-3600, "/");
            setcookie("csym","",time()-3600, "/");
            echo json_encode(array("status" => 300, "descrip" => "注销成功"));
          }else{
            echo json_encode(array("status" => 301, "descrip" => "注销失败"));
          }
        }
    }
}

?>
