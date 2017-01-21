<?php
    require_once("MysqlOperation.php");
    //四个常量名，表示不同的查询方式
    define("ID", "1");
    define("TITLE", "2");
    define("DATE", "3");
    define("CONTENT", "4");
    //每个常量名对应的数据库的名字
    $key = array(ID=>"id", TITLE=>"title", DATE=>"create_date", CONTENT=>"content");

    if(isset($_POST['query_type']) &&
       isset($_POST['string']) &&
       isset($_POST['username'])){
      
      $type   = $_POST['query_type']; //查询的类型
      $string = $_POST['string'];     //查询的内容
      $username = $_POST['username'];
      $mql = new MysqlOperation($art_base);

      $result = $mql->query("SELECT * FROM {$username} WHERE {$key[$type]} like\"%{$string}%\"");

      $array = array();
      while($result && $row = $result->fetch_assoc()){
        $array[] = $row;
      }

      echo json_encode($array);

    }
?>
