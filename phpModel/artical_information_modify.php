<?php
session_start();
require_once("MysqlOperation.php");
if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
        if($server['username'] == $_COOKIE['username'] &&
           $server['password'] == $_COOKIE['password'] &&
           $server['csym'] == $_COOKIE['csym'])
        {
            $id = empty($_POST['id']) ? null : $_POST['id'];
            $tags  = empty($_POST['tags'])  ? null : $_POST['tags'];
            $title = empty($_POST['title']) ? null : $_POST['title'];
            $content = empty($_POST['content']) ? null : $_POST['content'];
            $change_date = empty($_POST['change_date']) ? null : $_POST['change_date'];
            $view_permission = empty($_POST['view_permission']) ? null : $_POST['view_permission'];
            if(!empty($id))
            {
                $array = array(
                  $tags=>array("str", 0),
                  $title=>array("str", 1),
                  $content=>array("str", 2),
                  $change_date=>array("str", 3),
                  $view_permission=>array("num", 4)
                );

                $name = array("tags", "title", "content", "change_date", "view_permission");
                $index = 0;
                $mql = new MysqlOperation($art_base);
                $b_result = true;
                foreach ($array as $key => $value)
                {
                    if(!empty($key))
                    {
                      $sym = $value[0] === "str" ? '"' : '';

                      $result = $mql->query("UPDATE {$server['username']}
                      SET {$name[$value[1]]}={$sym}{$key}{$sym} WHERE id={$id}");

                      $b_result = $b_result && $result;

                    }
                }

                if($b_result)
                  echo json_encode(array("status"=>200, "descrip"=>"修改成功"));
                else
                  echo json_encode(array("status"=>201, "descrip"=>"修改失败"));
            }

        }
    }
}
?>
