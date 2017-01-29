<?php
session_start();
require_once("phpModel/MysqlOperation.php");
$id       = empty($_GET['id'])       ? null : $_GET['id'];
$username = empty($_GET['username']) ? null : $_GET['username'];
if(!is_numeric($id)){
  die("参数错误");
}
if($id !== null && $username !== null)
{
    $usr_table = "user";
    $artical_table = $username;

    $mql = new MysqlOperation($usr_base);
    $result = $mql->query("SELECT * from {$usr_table} WHERE username=\"{$username}\"");
    if($result->num_rows == 0){
      die("亲,用户不存在");
    }

    $mql = new MysqlOperation($art_base);
    $result = $mql->query("SELECT * FROM {$artical_table} WHERE id={$id}");

    if($result->num_rows == 0){
      die("亲,文章不存在");
    }

    $artical = $result->fetch_assoc();
    if($artical['view_permission'] == '0')
    {
        if(isset($_COOKIE['username']))
        {
            $server = $_SESSION[$_COOKIE['username']];
            if($server)
            {
                if($server['username'] != $_COOKIE['username'] ||
                   $server['password'] != $_COOKIE['password'] ||
                   $server['csym'] != $_COOKIE['csym'])
                {
                    die("您没有权限访问");
                }
                else
                {
                  //增加浏览量
                  $mql->query("UPDATE {$artical_table} SET pageviews=pageviews+1 WHERE id={$id}");
                }
            }
            else
                die("您没有权限访问");
        }
        else
            die("您没有权限访问");
    }
}
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/artical_view.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/marked.js"></script>
    <style media="screen">
      img{
        max-width: 100%;
      }
    </style>
    <title></title>
  </head>
  <body>
    <div class="container">
      <div class="row">

        <div class="col-md-8 col-md-offset-2" id="view-container">
          <div class="artical text-center" >
            <div class="artical-title">
              <h1 class="title-attention"><?php echo $artical['title']; ?></h1>
            </div>

            <div class="artical-message">
                  <div class="row">

                    <div class="col-md-2">
                      <div class="artical-author">
                        <p>作者: <?php echo $username; ?></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="artical-create-date">
                        <p>创建日期: <?php echo $artical['create_date']; ?></p>
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="artical-change-date">
                        <p>修改日期: <?php echo $artical['change_date']; ?></p>
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="artical-pageviews">
                        <p>浏览量<span class="glyphicon glyphicon-eye-open"></span>:<?php echo $artical['pageviews']; ?></p>
                      </div>
                    </div>

                    <div class="col-md-12">
                      <div class="artical-tags">
                        <span class="glyphicon glyphicon-tags"></span>
                        <?php
                           $tags = preg_split("/\s/", $artical['tags']);
                           foreach ($tags as $key => $value) {
                             echo "<span class='label label-primary'><a href=''>{$value}</a></span> ";
                           }
                        ?>
                      </div>
                    </div>
                   </div>
            </div>


            <div class="artical-content text-left">
              <?php
                  $content = json_encode($artical['content']);
                  echo "<script type='text/javascript'>
                  $('.artical-content').html(marked({$content}));
                  </script>";
               ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
