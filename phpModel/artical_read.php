<?php
require("MysqlOperation.php");
if(isset($_POST['username'])){
    $username = $_POST['username'];

    $mql    = new MysqlOperation($art_base);
    $result = $mql->getDatas($username);

    $array = array();
    while($row = $result->fetch_assoc()){
        $array[] = $row;
    }

    echo json_encode($array);
}
?>
