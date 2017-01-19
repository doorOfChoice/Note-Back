<?php
    require("MysqlOperation.php");
    define("ID", "1");
    define("TITLE", "2");
    define("DATE", "3");
    define("CONTENT", "4");
    $key = array(TITLE=>"title", DATE=>"create_date", CONTENT=>"content");
    if(isset($_POST['query_type']) && isset($_POST['string'])){
      $type = $_POST['query_type'];
      $string = $_POST['string'];
      $mql = new MysqlOperation();

      if($type == ID){

        $result = $mql->query("SELECT * FROM {$table} where id={$string}");
        $array = array();
        while($result && $row = $result->fetch_assoc()){
          $array[] = $row;
        }

        echo json_encode($array);
      }else{
        $result = $mql->query("SELECT * FROM {$table} WHERE {$key[$type]}=\"{$string}\"");

        $array = array();
        while($result && $row = $result->fetch_assoc()){
          $array[] = $row;
        }

        echo json_encode($array);
      }
    }
?>
