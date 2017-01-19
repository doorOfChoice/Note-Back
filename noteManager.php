
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
      function readAllDatas(){
        $.post("read.php", function(data){
        var notebook = $("#note-notebook");
        notebook.empty();
        for(var i = data.length - 1; i >= 0; i--){
          var unit = $("<div>").addClass("artical-unit dot-ellipsis dot-resize-update ");
          if(i == data.length - 1)
            unit.addClass("active");
          var id=$("<p class='myid' hidden>"+data[i].id+"</p>");
          var tags = $("<p class='tags' hidden>" + data[i].tags + "</p>");
          var title = $("<h3>").addClass("artical-title")
                             .text(data[i].title);
          var date = $("<p>").addClass("artical-date")
                             .text(data[i].create_date);
          var content = $("<p>").addClass("artical-content")
                             .text(data[i].content);
          unit.append(id, title, date, content);
          notebook.append(unit);
        }

        unitClick(".artical-unit", "active");
       });
      }
    </script>
    <script type="text/javascript">
      $(function(){
        $("#save").bind("click", function(e){
          $.post("save.php",
          {
            tags :  $("#tags").val(),
            title : $("#title").val(),
            content : $("#editor-box").val()
          }, function(e){
            readAllDatas();
          });

        });

        $("#delete").bind("click", function(e){
          var active = $(".active");
          var idcode = active.find(".myid").text();
          $.post("delete.php", {id : idcode}, function(data){
            if(data.status == 'ok'){
              console.log("删除成功");
              active.remove();
            }
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

    </script>
    <title>NoteManager</title>
  </head>
  <body>
    <div id="note-container" class="container-fluid">
      <div class="row">
        <div id="note-notebook" class="col-md-2 col-sm-2">

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

        <div id="preview" class="col-md-5 col-sm-5">
            dsdsad
        </div>
      </div>

    </div>
  </body>
</html>
