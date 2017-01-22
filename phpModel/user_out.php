<?php
    session_start();
    if(isset($_POST['out']) && isset($_POST['username'])){
      unset($_SESSION[$_POST['username']]);
      setcookie("username","",time()-3600, "/");
      setcookie("password","",time()-3600, "/");
      setcookie("csym","",time()-3600, "/");
      echo json_encode(array("status" => 300, "descrip" => "注销成功"));
    }else{
      echo json_encode(array("status" => 301, "descrip" => "注销失败"));
    }
?>
