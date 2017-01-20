<?php
  require("MysqlOperation.php");

  if(isset($_POST['id'])    &&
     isset($_POST["tags"])  &&
     isset($_POST["title"]) &&
     isset($_POST["content"])){

    $id = $_POST['id'];
    $tags = $_POST['tags'];
    $title = $_POST['title'];
    $content = $_POST['content'];

    $mql = new MysqlOperation();

    $result = $mql->query("
    UPDATE {$table} SET tags=\"{$tags}\",title=\"{$title}\",
    content=\"{$content}\",change_date=from_unixtime(unix_timestamp())
    where id={$id};
    ");

    if(!$result){
      echo json_encode(array("status"=>"fail"));
    }else{
      $newRes = $mql->query("SELECT * FROM {$table} WHERE id={$id}");
      echo json_encode($newRes->fetch_assoc());
    }
  }
?>
