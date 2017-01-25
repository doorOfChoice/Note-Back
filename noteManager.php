<?php
  session_start();
  $login = false;
  if(isset($_COOKIE['username']))
  {
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym'])
      {
         $login = true;
         echo "<script> USERNAME = \"{$server['username']}\"; </script>";
      }
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php
       /*没有登录状态实行强制跳转
        *跳转到登录界面
        */
        if(!$login){
          echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=user_login.php\">";
        }
    ?>

    <link rel="stylesheet" href="bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/noteManager.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/marked.js"></script>
    <script type="text/javascript" src="js/markdown_dom_parser.js"></script>
    <script type="text/javascript" src="js/html2markdown.js"></script>
    <script type="text/javascript" src="js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="js/note_logic.js"></script>
    <script type="text/javascript" src="js/note_init.js"></script>
    <title>NoteManager</title>
  </head>
  <body>
    <div class="loading-panel" hidden>
      <img src="picture/loading.gif" class="loading-icon" alt="">
    </div>
    <div id="user">
      <input type="text" class="form-control" name="" value="">
    </div>
    <div id="note-container" class="container">
      <div class="row">
        <div class="col-md-2" style="background-color:white; height:100%; padding:0px">
          <div class="menu">
            <div class="menu-group interval">
              <img src="picture/add.svg"  class="icon" id="add-artical" alt="新建笔记">
              <a href="user_modify.php"><img src="picture/user.svg" class="icon" id="usr-message" alt="用户信息" target="_blank"></a>
             <img src="picture/logout.svg" class="icon" id="usr-logout" alt="注销">
            </div>
          </div>
          <div id="note-notebook" >
            <div class="search-group">
              <div class="input-group">
                <input type="text" class="search-box form-control " id="sear-box" placeholder="搜索">
                <span class="input-group-addon ">
                  <img class="search-btn" src="picture/search.svg" id="sear-btn"></img>
                </span>
              </div>
            </div>

          </div>
        </div>

        <div class="col-md-5" style="background-color:#363636; height:100%">
          <div class="upload-panel" id="up-panel" hidden>
            <div class="input-group interval">
              <span class="input-group-addon">URL连接</span>
              <input type="text" id="up-url" class="form-control" placeholder="URL">
            </div>

            <form id="up-image" enctype="multipart/form-data">
              <input type="file" id="file" name="file"  value="">
            </form>

            <div class="up-show">
              <img id="up-show-image" alt="no data" style="width:50%;">
              <p id="up-show-size"></p>
            </div>

            <div class="button-group">
                <button type="button" id="up-btn" class="btn btn-primary " name="button">上传</button>
                <button type="button" id="up-close" class="btn btn-danger " name="button">关闭</button>
            </div>

          </div>

          <div id="editor">
              <div class="input-group input-group-title interval" >
                <input id="title" type="text" class="form-control" placeholder="标题">
                <span class="input-group-addon text-right">标题</span>
              </div>

              <div class="input-group input-group-tags interval" >
                <input id="tags" type="text" class="form-control" placeholder="标签">
                <span class="input-group-addon">标签</span>
              </div>

              <textarea class="editor-box interval" id="editor-box"></textarea>

              <div  id="buttonGroup" >
                <button type="button" class="btn btn-success" id="save">保存</button>
                <button type="button" class="btn btn-danger" id="delete">删除</button>
                <button type="button" class="btn btn-info" id="uppic">上传图片</button>
              </div>
          </div>
        </div>

        <div class="col-md-5" style="background-color:#1C1C1C; height:100%">
            <div id="preview" ></div>
        </div>

      </div>

    </div>
  </body>
</html>
