<?php
  require("MysqlOperation.php");
  header("Content-Type:text/json");
  $msql = new MysqlOperation();
  $result = $msql->getDatas($table);

  $array = array();
  while($row = $result->fetch_assoc()){
    $array[] = $row;
  }

  echo json_encode($array);
?>
