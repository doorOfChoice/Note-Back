<?php
  //namespace mysql;
  $basename = "test";
  $table    = "artical";
  class MysqlOperation{
    private  $servername = "",
             $username   = "",
             $password   = "",
             $dbname     = "",
             $conn       = null;
    public function __construct(){
      $args = func_get_args();
      $numb = count($args);

      switch($numb){
        case 0: $this->conn = new \mysqli('localhost', 'root', 'root');break;
        case 3: $this->conn = new \mysqli($args[0], $args[1], $args[2]);break;
        case 4: $this->conn = new \mysqli($args[0], $args[1], $args[2], $args[3]);break;
      }

      if(!isset($this->conn) || !$this->conn){
        die("连接数据库失败");
      }
    }

    public function __destruct(){
      if(isset($this->conn) && $this->conn){
        $this->conn->close();
      }
    }

    public function query($sql){
      //$type = $sql.substr(0, strpos($sql, " "));
      $result = $this->conn->query($sql);
      return $result;
    }

    public function getDatas($table){
      $heads = func_get_args();
      if(count($heads) <= 1)
        return $this->conn->query("select * from {$table}");
      else{
        $sql = "select ";

        for($i = 1, $size = count($heads); $i < $size; $i++){
          if($i != $size - 1)
            $sql .= $heads[$i].",";
          else
            $sql .= $heads[$i]." ";
        }
        $sql .= "from {$table}";
        $result = $this->conn->query($sql);
        return $result;
      }
    }
  }
 ?>
