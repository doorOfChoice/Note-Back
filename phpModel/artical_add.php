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
              if( isset($_POST["tags"])    &&
                  isset($_POST["title"])   &&
                  isset($_POST["content"])
                )
              {

                  $tags     = $_POST['tags'];
                  $title    = trim($_POST['title']);
                  $content  = $_POST['content'];
                  $username = $server['username'];

                  $mql    = new MysqlOperation($art_base);
                  $result = $mql->query(
                  "INSERT INTO {$username}(title, create_date, change_date, content, tags)
                   VALUES(\"{$title}\", from_unixtime(unix_timestamp(), '%Y-%m-%d %H-%i-%s'),
                   from_unixtime(unix_timestamp(), '%Y-%m-%d %H-%i-%s'), \"{$content}\", \"{$tags}\");"
                  );

                  if($result)
                  {
                    die(json_encode(array("status" => "ok")));
                  }
              }
          }
    }
}
?>
