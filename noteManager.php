<?php
  session_start();
  if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym']){
         echo "<script> USERNAME = \"{$server['username']}\"; </script>";
      }
    }else{
      echo "<script type='text/javascript'>
        location.assign('user_login.php')
      </script>";
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
    <link rel="stylesheet" href="css/noteManager.css">
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="bs/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/marked.js"></script>
    <script type="text/javascript" src="js/markdown_dom_parser.js"></script>
    <script type="text/javascript" src="js/html2markdown.js"></script>
    <script type="text/javascript" src="js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="js/note_init.js"></script>

    <title>NoteManager</title>
  </head>
  <body>
    <div id="note-container" class="container-fluid">
      <div class="row">
        <div class="loading-panel">
          <img src="picture/loading.gif" class="loading-icon" alt="">
        </div>

        <div id="note-notebook" class="col-md-2 col-sm-2">

          <div class="menu-group">
            <img src="picture/logout.svg" class="icon" id="usr-logout" alt="注销">
            <img src="picture/add.svg"  class="icon" id="add-artical" alt="新建笔记">
          </div>

          <div class="search-group">
            <input type="text" class="search-box form-control " id="sear-box" placeholder="搜索">
            <button type="button" class="search-btn" id="sear-btn"></button>
          </div>
        </div>

        <div id="editor" class="col-md-5 col-sm-5">

            <div class="input-group">
              <input id="title" type="text" class="form-control" placeholder="标题">
              <span class="input-group-addon text-right">标题</span>
            </div>

            <div class="input-group">
              <input id="tags" type="text" class="form-control" placeholder="标签">
              <span class="input-group-addon">标签</span>
            </div>

            <textarea class="editor-box" id="editor-box"></textarea>

            <div class="button-group" id="buttonGroup">
              <button type="button" class="btn btn-success" id="save">保存</button>
              <button type="button" class="btn btn-danger" id="delete">删除</button>
              <button type="button" class="btn btn-info" id="uppic">上传图片</button>
            </div>
        </div>

        <div id="preview" class="col-md-5 col-sm-5"></div>
      </div>

    </div>
  </body>
</html>
