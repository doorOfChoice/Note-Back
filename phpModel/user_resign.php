<?php
require_once("MysqlOperation.php");
$table = "user";
/*[100 注册成功] [101 用户已经存在] [500]数据库错误*/
if(!empty($_POST['username']) &&
   !empty($_POST['password']) &&
   !empty($_POST['name'])     &&
   !empty($_POST['sex'] )    &&
   !empty($_POST['birthday']))
{
    $sex  = $_POST['sex'] ;
    $name = $_POST['name'];
    $intro = $_POST['intro'];
    $phone = $_POST['phone'];
    $birthday = $_POST['birthday'];
    $username=$_POST['username'];
    $password=md5($_POST['password']);

    $mql = new MysqlOperation($usr_base);
    if($mql)
    {
        $result = $mql->query("SELECT * from {$table} WHERE username=\"{$username}\"");

        if($result)
        {
            if($result->num_rows != 0)
            { //判断是否已经注册过了
                echo json_encode(array("status"=>101, "descrip" => "账号已被注册"));
            }
        else
        {
            //加入新的用户
            $create_table = $mql->query("
            CREATE TABLE IF NOT EXISTS {$art_base}.{$username}(
            id INT NOT NULL AUTO_INCREMENT,
            create_date DATETIME NOT NULL,
            change_date DATETIME NOT NULL,
            pageviews INT NOT NULL DEFAULT 0,
            view_permission BOOLEAN NOT NULL DEFAULT 0,
            title VARCHAR(100) NOT NULL,
            tags VARCHAR(100) NOT NULL,
            content MEDIUMTEXT,
            PRIMARY KEY(id)
            )");

            if($create_table)
            {
                $default_head  = 'picture/head/'. (($sex === 'false') ? 'default-man.jpg' : 'default-woman.jpg');

                $insert_member = $mql->query("
                INSERT INTO {$table}(username, password, name, sex, birthday, intro, phone, head_address)
                VALUES(\"{$username}\", \"{$password}\", \"{$name}\",
                {$sex}, \"{$birthday}\", \"{$intro}\", \"{$phone}\", \"{$default_head}\");
                ");

                //插入成功返回刚刚注册的 用户名 和 密码
                if($insert_member)
                {
                    echo json_encode(array(
                      "status"  => 100,
                      "name"    => $name,
                      "sex"     => $sex,
                      "birthday"=> $birthday,
                      "intro"   => $intro,
                      "phone"   => $phone,

                      "descrip" => "注册成功"
                    ));
                }
          }
          else
          {
              echo json_encode(array("status" => 500, "descrip" => "创建数据表失败"));
          }
        }
      }
    }
}
?>
