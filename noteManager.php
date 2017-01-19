
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
    <script type="text/javascript" src="js/component.js"></script>

    <script type="text/javascript">
      function create_content(data){
        var notebook = $("#note-notebook");
        notebook.find(".artical-unit").remove();
        for(var i = data.length - 1; i >= 0; i--){
          var unit = $("<div class='artical-unit dot-ellipsis dot-resize-update'>");

          if(i == data.length - 1)
            unit.addClass("active");

          var id=$("<p class='artical-id' hidden>" + data[i].id + "</p>");
          var tags = $("<p class='artical-tags' hidden>" + data[i].tags + "</p>");
          var title = $("<h3 class='artical-title'>").text(data[i].title);
          var date = $("<p class='artical-date'>").text(data[i].create_date);
          var content = $("<p class='artical-content'>").text(data[i].content);
          unit.append(id, tags, title, date, content);
          notebook.append(unit);
        }
        unitClick(".artical-unit", "active");
      }
      /*
      * function : 获取数据库中所有信息
      * range：点击新建的时候和读入的时候
      */
      function readAllDatas(){
        $(".loading-panel").show();

        $.post("phpModel/read.php", function(data){
          create_content(data);
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
          var active = $(".active");
          $.post("phpModel/save.php",
            {
              id : $(".active").find(".artical-id").text(),
              tags : $('#tags').val(),
              title : $('#title').val(),
              content : $('#editor-box').val()
            },
            function(data){
              $(".loading-panel").hide();
              active.find('.artical-title').text(data.title);
              active.find('.artical-content').text(data.content);
              active.find('.artical-tags').text(data.tags);
            }
          , "json");
        });

        //删除指定序号的文章
        $("#delete").bind("click", function(e){
          $(".loading-panel").show();
          var active = $(".active");
          var idcode = active.find(".artical-id").text();
          $.post("phpModel/delete.php", {id : idcode}, function(data){
            if(data.status == 'ok'){
              active.remove();
            }
            $(".loading-panel").hide();
          }, "json");
        });

        //查找指定标题的文章
        $("#sear-btn").bind("click", function(e){
          $(".loading-panel").show();
          if(!($.trim($("#sear-box").val()) == '')){
            $.post("phpModel/find.php", {
                query_type : "2",
                string : $("#sear-box").val()
            },function(data){
              create_content(data);
              $(".loading-panel").hide();
            },"json");
          }else{
            readAllDatas();
          }
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
            <img src="picture/add.svg"  class="icon" id="add-artical">
          </div>
          <div class="search-group">
            <input type="text" class="search-box" id="sear-box">
            <button type="button" class="search-btn" id="sear-btn"></button>
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
