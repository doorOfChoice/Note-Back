
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
    <!--<script type="text/javascript" src="js/markdown_dom_parser.js"></script>-->
    <!--<script type="text/javascript" src="js/html2markdown.js"></script>-->
    <script type="text/javascript" src="js/jquery.dotdotdot.js"></script>
    <script type="text/javascript" src="js/component.js"></script>

    <script type="text/javascript">
      /*
      * function : 获取数据库中所有信息
      * range：点击新建的时候和读入的时候
      */
      function readAllDatas(){
        $(".loading-panel").show();

        $.post("phpModel/read.php", function(data){
        var notebook = $("#note-notebook");
        notebook.find(".artical-unit").remove();
        for(var i = data.length - 1; i >= 0; i--){
          var unit = $("<div>").addClass("artical-unit dot-ellipsis dot-resize-update");
          if(i == data.length - 1)
            unit.addClass("active");

          var id=$("<p id='artical-id' hidden>"+data[i].id+"</p>");
          var tags = $("<p id='artical-tags' hidden>" + data[i].tags + "</p>");
          var title = $("<h3>").addClass("artical-title")
                               .text(data[i].title);
          var date = $("<p>").addClass("artical-date")
                             .text(data[i].create_date);
          var content = $("<p>").addClass("artical-content")
                                .text(data[i].content);

          notebook.append(unit.append(id, tags, title, date, content));
        }
        unitClick(".artical-unit", "active");
        $(".loading-panel").hide();
       });
      }
    </script>
    <script type="text/javascript">
      $(function(){
        //新建文章
        $("#add-artical").bind("click", function(e){
          $(".loading-panel").show();
          $.post("phpModel/add.php",
          {
            tags  :  "无",
            title :　"无标题",
            content : "无内容"
          }, function(e){
            readAllDatas();
          });
        });
        //保存文章
        $("#save").bind("click", function(e){
          $(".loading-panel").show();
          console.log($('.active').find("#artical-tags").text());
          $.post("phpModel/save.php",
            {
              id : $(".active").find("#artical-id").text(),
              tags : $('#tags').val(),
              title : $('#title').val(),
              content : $('#editor-box').val(),
              timeout : 10
            },
            function(data){
              $(".loading-panel").hide();
            }
          );
        });

        //删除指定序号的文章
        $("#delete").bind("click", function(e){
          $(".loading-panel").show();
          var active = $(".active");
          var idcode = active.find("#artical-id").text();
          $.post("phpModel/delete.php", {id : idcode}, function(data){
            if(data.status == 'ok'){
              console.log("删除成功");
              active.remove();
            }
            $(".loading-panel").hide();
          }, "json");
        });
      });
    </script>
    <script type="text/javascript">
      $(function(){
        var box = $("#editor .editor-box");
        var preview = $("#preview");
        box.bind("keyup", function(e){
          preview.html(marked($(this).val()));
        });
        readAllDatas();
      });
    </script>

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
            <img src="picture/add.svg" alt="" class="icon" id="add-artical">
          </div>
        </div>

        <div id="editor" class="col-md-5 col-sm-5">
            <input id="title" type="text" class="editor-title">

            <textarea class="editor-box" id="editor-box"></textarea>
            <div class="button-group" id="buttonGroup">
              <button type="button" class="btn btn-success" id="save">保存</button>
              <button type="button" class="btn btn-danger" id="delete">删除</button>
              <button type="button" class="btn btn-info" id="uppic">上传图片</button>
              <input type="text" name="" value="" id="tags">
            </div>
        </div>

        <div id="preview" class="col-md-5 col-sm-5"></div>
      </div>

    </div>
  </body>
</html>
