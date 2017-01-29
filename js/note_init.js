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
        tags : $.trim($('#tags').val()),
        title : $.trim($('#title').val()),
        content : $('#editor-box').val()
      },
      function(data){
        $(".loading-panel").hide();
        active.find('.artical-title').text(data.title);
        active.find('.artical-content').text(data.content);
        active.find('.artical-tags').text(data.tags);
        active.dotdotdot();
      }
    , "json");
  });

  //查找指定标题的文章
  $("#sear-btn").bind("click", function(e){
    $(".loading-panel").show();
    if(!($.trim($("#sear-box").val()) == '')){
      $.post("phpModel/artical_find.php", {
          query_type : "2",
          string : $.trim($("#sear-box").val())
      },function(data){
        create_content(data);
        $(".loading-panel").hide();
      },"json");
    }else{
      readAllDatas();
    }
  });

  //回车执行搜索
  $("#sear-box").bind("keydown", function(e){
      if(e.keyCode == 13){
        $("#sear-btn").click();
      }
  });

  //注销按钮动作
  $("#usr-logout").bind("click", function(e){
    $(".loading-panel").show();
    $.post("phpModel/user_out.php", {out : true}, function(data){
      switch(data.status){
        case 300 : location.assign("user_login.php") ;break;
        default  : alert(data.descrip);break;
      }
      $(".loading-panel").hide();
    }, "json");
  });

  //上传图片
  $("#up-btn").bind("click", function(e){
    var httpURL = $.trim($("#up-url").val());
    var editText = $("#editor-box").val();
    //检测是否选择了文章
    if($(".active").length === 0){
      alert("请选择一篇文章.");
      return;
    }

    if(httpURL == ""){
      var status = showImageMessage($("#file")[0]);
      //文件格式/大小不正确
      if(status[2] !== true){
        alert(status[0][2]);
      }else{
        $(".loading-panel").show();
        var data = new FormData();
        data.append("file", $("#file")[0].files[0]);
        $.post({
          url : "phpModel/file_upload.php",
          type : "POST",
          data  : data,
          cache : false,
          contentType : false,
          processData : false
        }, function(data){
          switch(data.status){
            case 400 : setCursorContent($("#editor-box")[0],
                       "![](" + data.descrip + ")");
                       break;
            default  : alert(data.descrip); break;
          }
          $("#editor-box").keyup();
          $(".loading-panel").hide();
          $(".upload-panel").hide();
        }, "json");
      }
    }else{
      setCursorContent($("#editor-box")[0],"![](" + httpURL + ")");
      $("#editor-box").keyup();
      $(".upload-panel").hide();
    }

  });
  //保存文章其他信息
  $(".menu-list-box-save").bind("click", function(e){
      $(".loading-panel").show();

      var response = $.ajax("phpModel/artical_information_modify.php",{
        type : "POST",
        dataType : "JSON",
        data : {
          id : $(".menu-list-box-id").text(),
          view_permission : $(".menu-list-box-permission").val()
        }
      }).done(function(data){
        if(data.status === 200){
          alert("保存成功");
        }
      }).fail(function(){
        alert("修改失败, 请检查网络或者登录状态");
      }).always(function(){
        $(".loading-panel").hide();
      });
  });

  //文件被选择后显示缩略图
  $("#file").bind("change", function(e){
    var status = showImageMessage(this);
    if(status[1] === true){
      $("#up-show-image").attr("src", status[0][0]);
      $("#up-show-size").text("大小: " + status[0][1] + "KB");
    }
  });

  //显示上传图片框
  $("#uppic").bind("click", function(e){
    $(".upload-panel").show();
  });

  //关闭显示图片框
  $("#up-close").bind("click", function(e){
    $(".upload-panel").hide();
  });


  //预览内容
  var box = $("#editor .editor-box");
  var preview = $("#preview");

  box.bind("keyup", function(e){
    preview.html(marked($(this).val()));
  });

  box.bind("keydown", function(e){
    if(e.keyCode == 9){
      setCursorContent(this, "    ");
      return false;
    }
  });
  readAllDatas();
});
