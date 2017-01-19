function unitClick(comp, symb){
  $(comp).bind("click", function(e){
    var parent = $(this).parent();
    parent.find(comp).removeClass(symb);
    $(this).addClass(symb);
  });

  $(comp).bind("click", function(e){
    $(".editor-box").val($(this).find(".artical-content").text());
    $("#preview").html(marked($(this).find(".artical-content").text()));
  });
}
