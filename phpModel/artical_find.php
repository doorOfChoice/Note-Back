<?php
session_start();
require_once("MysqlOperation.php");

//四个常量名，表示不同的查询方式
define("ID", "1");
define("DATE", "3");
define("TAGS", "5");
define("TITLE", "2");
define("CONTENT", "4");
//每个常量名对应的数据库的名字
$key = array(ID=>"id", TITLE=>"title", DATE=>"create_date", CONTENT=>"content", TAGS=>"tags");

if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
        if($server['username'] == $_COOKIE['username'] &&
           $server['password'] == $_COOKIE['password'] &&
           $server['csym'] == $_COOKIE['csym'])
        {
            if(isset($_POST['query_type']) &&
               isset($_POST['string'])
              )
            {
                $type     = $_POST['query_type']; //查询的类型
                $string   = $_POST['string'];     //查询的内容
                $username = $server['username'];  //用户名

                $mql    = new MysqlOperation($art_base);
                $result = $mql->query("SELECT * FROM {$username} WHERE {$key[$type]} like \"%{$string}%\"");

                $array = array();
                while($result && $row = $result->fetch_assoc())
                {
                    $array[] = $row;
                }

                echo json_encode($array);
            }
        }
    }
}

?>
