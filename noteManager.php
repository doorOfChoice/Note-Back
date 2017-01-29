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
    <meta name="robots" content="none">
    <?php
       /*没有登录状态实行强制跳转
        *跳转到登录界面
        */
        if(!$login){
          echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"0;url=user_login.php\">";
        }
    ?>

    <link rel="stylesheet" href="js/highlight/styles/atom-one-dark.css">
    <link rel="stylesheet" href="js/bs/css/bootstrap.min.css">
    <link rel="stylesheet" href="js/bs/css/bootstrap-theme.min.css">
    <link rel="stylesheet" href="css/noteManager.css">

    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/bs/js/bootstrap.js"></script>
    <script type="text/javascript" src="js/marked.js"></script>
    <script type="text/javascript" src="js/highlight/highlight.pack.js"></script>
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
    <!-- 模态框，用来对某文章进行操作 -->
    <div id ="modal" class="modal fade menu-list-box" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

            <div class="modal-title">
              文章信息
            </div>
          </div>

          <div class="modal-body">
            <p class="menu-list-box-id" hidden></p>
            <p class="menu-list-box-title">标题:</p>
            <p class="menu-list-box-olddate">创建时间:</p>
            <p class="menu-list-box-newdate">最近修改:</p>
            <p class="menu-list-box-wordCount">字数:</p>
            <div class="input-group">
              <label for="">是否允许他人查看此文章</label>
              <select class="form-control menu-list-box-permission" name="">
                <option value="0">禁止</option>
                <option value="1">允许</option>
              </select>
            </div>
            <a href="#" class="menu-list-box-link" target="_blank">文章地址</a><br/>
            <div class="button-group">
              <button type="button" class="btn btn-primary menu-list-box-save">保存</button>
            </div>

          </div>

        </div>
      </div>
    </div>

    <div id="note-container" class="container">
      <div class="row">

        <div class="col-md-2 col-sm-4 col-xs-4" style="background-color:white; height:100%; padding:0px" id="row-notebook">

          <div class="menu">
            <div class="menu-group interval">
              <img src="picture/add.svg"  class="icon" id="add-artical" alt="新建笔记">
              <a href="user_modify.php"><img src="picture/user.svg" class="icon" id="usr-message" alt="用户信息" target="_blank"></a>
             <img src="picture/logout.svg" class="icon" id="usr-logout" alt="注销">
            </div>
          </div>

          <div class="search-group">
            <div class="input-group">
              <input type="text" class="search-box form-control " id="sear-box" placeholder="搜索">
              <span class="input-group-addon ">
                <img class="search-btn" src="picture/search.svg"  id="sear-btn"></img>
              </span>
            </div>
          </div>

          <div id="note-notebook" >

          </div>
        </div>

        <div class="col-md-5 col-sm-8 col-xs-8" style="background-color:#363636; height:100%" id="row-editor">
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

              <input id="title" type="text" name="editor-input" class="form-control interval" placeholder="标题">
              <!--<span class="input-group-addon text-right">标题</span>-->

              <input id="tags" type="text" name="editor-input" class="form-control interval" placeholder="标签">
              <!--<span class="input-group-addon">标签</span>-->


              <textarea class="editor-box interval" name="editor-box" id="editor-box"></textarea>

              <div  id="buttonGroup" >
                <button type="button" class="btn btn-success" id="save">保存</button>
                <button type="button" class="btn btn-info" id="uppic">上传图片</button>
              </div>
          </div>
        </div>

        <div class="col-md-5 col-sm-12 col-xs-12" style="background-color:#1C1C1C; height:100%" id="row-preview">
            <div id="preview" ></div>
        </div>

      </div>

    </div>
  </body>
</html>
