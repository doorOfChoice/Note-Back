<?php
    require("MysqlOperation.php");

    if(isset($_POST['id'])){
      $id = $_POST['id'];
      $conn = new MysqlOperation("localhost", "root", "root", $basename);
      $result = $conn->query("DELETE from {$table} where id={$id}");

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
