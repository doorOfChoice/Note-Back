<?php
    require("phpModel/MysqlOperation.php");

    if(isset($_POST['id'])){
      $id = $_POST['id'];
      $conn = new MysqlOperation("localhost", "root", "root", "test");
      $result = $conn->query("DELETE from artical where id={$id}");

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
