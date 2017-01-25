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
            if(isset($_POST['id'])      &&
               isset($_POST["tags"])    &&
               isset($_POST["title"])   &&
               isset($_POST["content"])
              )
            {

                $id = $_POST['id'];
                $tags = $_POST['tags'];
                $title = $_POST['title'];
                $content = $_POST['content'];
                $username = $server['username'];

                $mql    = new MysqlOperation($art_base);
                $result = $mql->query("
                UPDATE {$username} SET tags=\"{$tags}\",title=\"{$title}\",
                content=\"{$content}\",change_date=from_unixtime(unix_timestamp())
                where id={$id};
                ");

                if(!$result)
                {
                    echo json_encode(array("status"=>"fail"));
                }
                else
                {
                    $newRes = $mql->query("SELECT * FROM {$username} WHERE id={$id}");
                    echo json_encode($newRes->fetch_assoc());
                }
            }
        }
    }
}

?>
