<?php
  require("phpModel/MysqlOperation.php");

  if(isset($_POST['id'])    &&
     isset($_POST["tags"])  &&
     isset($_POST["title"]) &&
     isset($_POST["content"])){

    $id = $_POST['id'];
    $tags = $_POST['tags'];
    $title = $_POST['title'];
    $content = $_POST['content'];
    $table = "artical";

    $mql = new MysqlOperation("localhost", "root", "root", "test");

    $result = $mql->query("
    UPDATE {$table} SET tags=\"{$tags}\",title=\"{$title}\",
    content=\"{$content}\",change_date=from_unixtime(unix_timestamp())
    where id={$id};
    ");

    if(!$result){
      echo json_encode(array("status"=>"fail"));
    }else{
      echo json_encode(array("status"=>"ok"));
    }
  }
?>
