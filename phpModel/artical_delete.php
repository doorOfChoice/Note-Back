<?php
    require_once("MysqlOperation.php");

    if(isset($_POST['id']) &&
       isset($_POST['username'])){
      $id = $_POST['id'];
      $username = $_POST['username'];
      $conn = new MysqlOperation($art_base);
      $result = $conn->query("DELETE from {$username} where id={$id}");

      $array=array();
      if($result){
        $array["status"] = "ok";
        echo json_encode($array);
      }else{
        $array["status"] = "fail";
        echo json_encode($array);
      }

    }
?>
