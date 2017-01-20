<?php
    require("MysqlOperation.php");
    define("ID", "1");
    define("TITLE", "2");
    define("DATE", "3");
    define("CONTENT", "4");
    $key = array(ID=>"id", TITLE=>"title", DATE=>"create_date", CONTENT=>"content");
    if(isset($_POST['query_type']) && isset($_POST['string'])){
      $type = $_POST['query_type'];
      $string = $_POST['string'];
      $mql = new MysqlOperation();


      $result = $mql->query("SELECT * FROM {$table} WHERE {$key[$type]} like\"%{$string}%\"");

      $array = array();
      while($result && $row = $result->fetch_assoc()){
        $array[] = $row;
      }

      echo json_encode($array);

    }
?>
