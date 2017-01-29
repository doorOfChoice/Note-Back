//验证提交文章的表单信息是否合法
function articalLegal(){
  return $.trim($("#title").val()) != '' &&
         $.trim($("#tags").val())  != '';
}

//删除文章
function menuDeleteClick(symb){
  $(symb).bind("click", function(event){
    event.stopPropagation();
    if(confirm("你确定要删除这篇文章吗?")){
        $(".loading-panel").show();
        var active = $(this).parent().parent();
        var idcode = active.find(".artical-id").text();

        $.post("phpModel/artical_delete.php", {id : idcode}, function(data){
          if(data.status == 'ok'){
            active.remove();
            var children = $(".artical-unit");
            if(children.length !== 0){
              $(children[0]).click();
            }else{
              $(".loading-panel").hide();
            }
          }

        }, "json");
    }
    return false;
  });
}

function menuAttrClick(symb){
    $(symb).bind("click", function(event){
        event.stopPropagation();
        $(".loading-panel").show();
        var id = $(this).parent().parent().find(".artical-id").text();
        var response = $.ajax("phpModel/artical_find.php", {
          type : "POST",
          dataType : "json",
          data : {
            string : id,
            query_type : "1"
          }
        }).done(function(data){
          if(data.length === 1){
            $(".menu-list-box-title").text("标题: "+ data[0].title);
            $(".menu-list-box-olddate").text("创建时间: "+ data[0].create_date);
            $(".menu-list-box-newdate").text("修改时间: "+ data[0].change_date);
            $(".menu-list-box-wordCount").text("字符数: "+ data[0].content.length);
            $(".menu-list-box-permission").val(data[0].view_permission);
            $(".menu-list-box-link").attr("href", "artical_view.php?username="+USERNAME+"&id="+id);
            $(".menu-list-box-id").text(id);
            $('#modal').modal({show : true, keyboard : true});
          }
        }).fail(function(){
          alert("修改失败, 请检查网络或者登录状态");
        }).always(function(){
          $(".loading-panel").hide();
        });

    });
}

//设定note块的点击事件
function unitClick(comp, symb){
  //点击后的颜色特效
  $(comp).bind("click", function(event){
    var parent = $(this).parent();
    parent.find(comp).removeClass(symb);
    $(this).addClass(symb);
  });

  //向服务器请求要的某篇文档
  $(comp).bind("click", function(event){
    $(".loading-panel").show();
    $.post("phpModel/artical_find.php", {
      query_type : 1,
      string : $(this).find(".artical-id").text()
    },function(data){
      if(data.length != 0){
        $("#tags").val(data[0].tags);
        $("#title").val(data[0].title);
        $(".editor-box").val(data[0].content);
        $("#preview").html(marked(data[0].content));
      }
      $(".loading-panel").hide();
    }, "json");
  });
}

//通过返回的JSON数据创建节点
function create_content(data){
  var notebook = $("#note-notebook");
  notebook.find(".artical-unit").remove();
  for(var i = data.length - 1; i >= 0; i--){
    var unit = $("<div class='artical-unit'>");

    if(i == data.length - 1)
      unit.addClass("active");

    var id    = $("<p class='artical-id' hidden>" + data[i].id + "</p>");
    var tags  = $("<p class='artical-tags' hidden>" + data[i].tags + "</p>");
    var title = $("<h4 class='artical-title'>").text(data[i].title);
    var date  = $("<p class='artical-date'>").text(data[i].create_date);
    var content = $("<p class='artical-content'>").text(data[i].content);
    var menuDelete = $("<span class='glyphicon glyphicon-remove menu-list-delete'></span>");
    var menuAttr = $("<span class='glyphicon glyphicon-th-list menu-list-artattr'></span>");
    var menuList = $("<div class='menu-list'></div>").append(menuAttr, menuDelete);
    unit.bind("mouseover", function(e){
       $(this).parent().parent().find(".artical-title").addClass("artical-unit-goin");
    }).bind("mouseleave", function(e){
       $(this).parent().parent().find(".artical-title").removeClass("artical-unit-goin");
    });
    unit.append(menuList, id, tags, title, date, content);
    notebook.append(unit);
  }
  $(".artical-unit").dotdotdot();
  unitClick(".artical-unit", "active");
  menuDeleteClick(".menu-list-delete");
  menuAttrClick(".menu-list-artattr");
}

/*
* function : 获取数据库中所有信息
* range：点击新建的时候和读入的时候
*/
function readAllDatas(){
  $(".loading-panel").show();

  $.post("phpModel/artical_read.php" ,function(data){
    create_content(data);
    if($(".active").length != 0){
      $(".active").click();
    }else{
      $(".loading-panel").hide();
    }

  }, "json");
}
/*
**获取textarea里光标的位置
**返回[0]=>开始位置
**   [1]=>终止位置
*/
function getCursor(ctrl){
  ctrl.focus();
  var posEnd = 0;
  var posStart = 0;
  //selectionStart/End适用于chrome safari Edge IE最新 firefox,不支持旧版
  if(ctrl.selectionStart || ctrl.selectionStart == 0){
    posEnd = ctrl.selectionEnd;
    posStart = ctrl.selectionStart;
  }
  return [posStart, posEnd];
}

/*设置textarea里光标的位置*/
function setCursor(ctrl, pos){
  ctrl.focus();
  if(ctrl.selectionStart || ctrl.selectionStart == 0){
    ctrl.selectionStart = ctrl.selectionEnd = pos;
  }
}

/*设置textarea光标处的内容*/
function setCursorContent(ctrl, content){
  var index = getCursor(ctrl)[0];
  var textUp = $(ctrl).val().substring(0, index);
  var textDown = $(ctrl).val().substring(index);
  var newString = content;
  $(ctrl).val(textUp + newString + textDown);
  setCursor(ctrl, index + newString.length);
}

/*显示文件信息*/
function showImageMessage(ctrl){
  var file = ctrl.files[0];
  /*
  **返回的格式信息
  **返回的数组格式[[fileSrc, fileSize, message], canShow, canUpLoad]
  */
  if(!file){
    return [["", "","没有选择文件"], false, false];
  }
  var fileType = file['type'];
  if(fileType !== "image/png" &&
     fileType !== "image/jpg" &&
     fileType !== "image/jpeg"&&
     fileType !== "image/png"){
     return [[fileSrc, fileSize,"文件格式不对"], false, false];
  }

  var fileSize = file['size'] / 1024;
  var fileSrc = window.URL.createObjectURL(file);

  if(fileSize > 1024){
    return [[fileSrc, fileSize, "文件超过1MB"], true, false];
  }

  return [[fileSrc, fileSize, "文件符合要求"], true, true];
}
