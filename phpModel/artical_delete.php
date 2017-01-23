<?php
require_once("MysqlOperation.php");

if(isset($_POST['id']) &&
   isset($_POST['username']))
{
    $id = $_POST['id'];
    $username = $_POST['username'];

    $conn = new MysqlOperation($art_base);
    $result = $conn->query("DELETE from {$username} where id={$id}");

    if($result)
    {
        echo json_encode("status" => "ok");
    }
    else
    {
        echo json_encode("status" => "fail");
    }

}
?>
