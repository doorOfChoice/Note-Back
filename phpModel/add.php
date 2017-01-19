<?php
  require("MysqlOperation.php");

  if(isset($_POST["title"])   &&
     isset($_POST["content"]) &&
     isset($_POST["tags"])  ) {

    $tags = $_POST['tags'];
    $title = trim($_POST['title']);
    $content = $_POST['content'];

    $mql    = new MysqlOperation("localhost", "root", "root", $basename);
    $result = $mql->query(
      "INSERT INTO {$table}(title, create_date, change_date, content, tags)
        VALUES(\"{$title}\", from_unixtime(unix_timestamp(), '%Y-%m-%d %H-%i-%s'),
        from_unixtime(unix_timestamp(), '%Y-%m-%d %H-%i-%s'), \"{$content}\", \"{$tags}\");"
    );

    if($result){
      die("yes");
    }else{

    }
  }


 ?>
