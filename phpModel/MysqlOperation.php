<?php
class MysqlOperation{
    private  $servername = "localhost",
             $username   = "root",
             $password   = "zhanwubs22",
             $dbname     = "note-base",
             $conn       = null;
    //构造函数， 初始化数据库。
    public function __construct()
    {
        $args = func_get_args();
        $numb = count($args);

        switch($numb)
        {
            case 0: $this->conn = new \mysqli($this->servername, $this->username, $this->password);break;
            case 1: $this->conn = new \mysqli($this->servername, $this->username, $this->password, $args[0]);break;
            case 3: $this->conn = new \mysqli($args[0], $args[1], $args[2]);break;
            case 4: $this->conn = new \mysqli($args[0], $args[1], $args[2], $args[3]);break;
        }

        if(!isset($this->conn) || !$this->conn)
        {
          die("连接数据库失败");
        }

    }

    public function __destruct()
    {
        if(isset($this->conn) && $this->conn){
            $this->conn->close();
        }
    }

    public function query($sql)
    {
        //$type = $sql.substr(0, strpos($sql, " "));
        $result = $this->conn->query($sql);
        return $result;
    }

    //获取特定的列
    public function getDatas($table)
    {
        $heads = func_get_args();
        if(count($heads) <= 1)
        {
            return $this->conn->query("select * from {$table}");
        }
        else
        {
            $sql = "select ";

            for($i = 1, $size = count($heads); $i < $size; $i++){
                $sql .= ($i != $size - 1) ? $heads[$i]."," : $heads[$i]." ";
            }
            $sql .= "from {$table}";

            $result = $this->conn->query($sql);
            return $result;
       }
    }
}
//namespace mysql;
$art_base = "artical";   //文章库
$usr_base = "note_user"; //用户库
/*初始化数据库*/
$conn = new MysqlOperation();
$conn->query("CREATE DATABASE IF NOT EXISTS {$art_base}");
$conn->query("CREATE DATABASE IF NOT EXISTS {$usr_base}");
$conn->query("CREATE TABLE IF NOT EXISTS {$usr_base}.user(
              username TEXT NOT NULL,
              password TEXT NOT NULL,
              name VARCHAR(100) NOT NULL,
              sex BOOLEAN NOT NULL,
              birthday DATE NOT NULL,
              phone VARCHAR(30) NOT NULL,
              intro VARCHAR(500),
              head_address TEXT
              )");
?>
