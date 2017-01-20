function unitClick(comp, symb){
  //点击后的颜色特效
  $(comp).bind("click", function(e){
    var parent = $(this).parent();
    parent.find(comp).removeClass(symb);
    $(this).addClass(symb);
  });
  //将读出来的信息放进编辑框内
  $(comp).bind("click", function(e){
    $("#tags").val($(this).find(".artical-tags").text());
    $("#title").val($(this).find(".artical-title").text());
    $(".editor-box").val($(this).find(".artical-content").text());
    $("#preview").html(marked($(this).find(".artical-content").text()));
  });
}
