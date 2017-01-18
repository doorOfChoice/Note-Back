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
    <script type="text/ja class="container"vascript" src="js/markdown_dom_parser.js"></script>
    <script type="text/ja vascript" src="class="col-md-2"js/html2markdown.js"></script>
    <script type="text/javascript" src="js/jquery.dotdotdot.js"></script>

    <script type="text/javascript">
      $(function(){
        var box = $("#editor .editor-box");
        var preview = $("#preview");

        box.bind("keyup", function(e){
          preview.html(marked($(this).val()));
        });
      });
    </script>

    <title>NoteManager</title>
  </head>
  <body>
    <div id="note-container" class="container-fluid">
      <div class="row">
        <div id="note-notebook" class="col-md-2 col-sm-2">
          <div class="artical-unit dot-ellipsis dot-resize-update">
            <h3 class="artical-title">生命的意义</h3>
            <p class="artical-date">时间: 1997-08-01</p>
            <p class="artical-content">我草泥马</p>
          </div>
        </div>

        <div id="editor" class="col-md-5 col-sm-5">
            <textarea class="editor-box"></textarea>
            <div class="button-group" id="buttonGroup">
              <button type="button" class="btn btn-success" name="button">保存</button>
              <button type="button" class="btn btn-info" name="button">上传图片</button>
              <label for="">标签</label>
              <input type="text" name="" value="">
            </div>
        </div>

        <div id="preview" class="col-md-5 col-sm-5">
            dsdsad
        </div>
      </div>

    </div>
  </body>
</html>
