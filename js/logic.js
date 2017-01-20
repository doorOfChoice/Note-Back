function articalLegal(){
  return $.trim($("#title").val()) != '' &&
         $.trim($("#tags").val())  != '';
}
