<?php
  require("MysqlOpeation.php");
  $table = "user";
  if(isset($_POST['username'])){
    $username = $_POST['username'];
    $mql = new MysqlOpeation($usr_base);

    $result = $msq->query("SELECT * FROM {$table} WHERE username=\"{$username}\";");
    if($result){
      if($result->num_rows != 0)
        echo json_encode(array("status"=>101));
      else
        echo json_encode(array("status"=>100));
    }
  }
 ?>
