//通过返回的JSON数据创建节点
function create_content(data){
  var notebook = $("#note-notebook");
  notebook.find(".artical-unit").remove();
  for(var i = data.length - 1; i >= 0; i--){
    var unit = $("<div class='artical-unit dot-ellipsis dot-resize-update'>");

    if(i == data.length - 1)
      unit.addClass("active");

    var id    = $("<p class='artical-id' hidden>" + data[i].id + "</p>");
    var tags  = $("<p class='artical-tags' hidden>" + data[i].tags + "</p>");
    var title = $("<h3 class='artical-title'>").text(data[i].title);
    var date  = $("<p class='artical-date'>").text(data[i].create_date);
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

  $.post("phpModel/artical_read.php", function(data){
    create_content(data);
    $(".loading-panel").hide();
 });
}

/**整个DOM加载完成后**/
$(function(){
  //新建文章
  $("#add-artical").bind("click", function(e){
    $(".loading-panel").show();
    $.post("phpModel/artical_add.php",
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
    if(!articalLegal()){
      alert("你的标题或者标签不合法");
      return;
    }
    $(".loading-panel").show();
    var active = $(".active");
    $.post("phpModel/artical_save.php",
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
    $.post("phpModel/artical_delete.php", {id : idcode}, function(data){
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
      $.post("phpModel/artical_find.php", {
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

  //预览内容
  var box = $("#editor .editor-box");
  var preview = $("#preview");
  box.bind("keyup", function(e){
    preview.html(marked($(this).val()));
  });
  readAllDatas();
});
