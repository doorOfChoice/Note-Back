<?php
  require("phpModel/MysqlOperation.php");
  header("Content-Type:text/json");
  $msql = new MysqlOperation("localhost", "root", "root", "test");
  $result = $msql->getDatas("artical");

  $array = array();
  while($row = $result->fetch_assoc()){
    $array[] = $row;
  }

  echo json_encode($array);
?>
