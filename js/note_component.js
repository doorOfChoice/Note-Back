function unitClick(comp, symb){
  //点击后的颜色特效
  $(comp).bind("click", function(e){
    var parent = $(this).parent();
    parent.find(comp).removeClass(symb);
    $(this).addClass(symb);
  });
  //向服务器请求要的某篇文档
  $(comp).bind("click", function(e){
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
