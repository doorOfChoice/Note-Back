<?php
session_start();
require("MysqlOperation.php");
if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
        if($server['username'] == $_COOKIE['username'] &&
           $server['password'] == $_COOKIE['password'] &&
           $server['csym'] == $_COOKIE['csym'])
        {
            $username = $server['username'];

            $mql    = new MysqlOperation($art_base);
            $result = $mql->getDatas($username);

            $array = array();
            while($row = $result->fetch_assoc()){
                $array[] = $row;
            }

            echo json_encode($array);
        }
    }
}

?>
