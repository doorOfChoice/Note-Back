<?php
  session_start();
  //返回文件的后缀
  function getSuffix($filename){
    $index = strpos($filename, ".");
    return $index < 0 ? "" : substr($filename, $index + 1);
  }
  //检测格式是否正确
  function isFormat($suffix){
    return $suffix === "gif" ||
           $suffix === "jpg" ||
           $suffix === "png" ||
           $suffix === "jpeg"||
           $suffix === "svg" ;
  }
  //检测大小是否超过1MB
  function isSize($size){
    return $size <= 1024 * 1024;
  }

  if(isset($_COOKIE['username'])){
    $server = $_SESSION[$_COOKIE['username']];
    if($server){
      if($server['username'] == $_COOKIE['username'] &&
         $server['password'] == $_COOKIE['password'] &&
         $server['csym'] == $_COOKIE['csym']){
           /*[
           //400=>上传成功
           //401=>格式不正确
           //402=>文件大小超过1MB
           //403=>文件创建失败
           //410=>其他错误
           ]*/
           if(!isset($_POST['username']) || $_FILES['file']['error'] > 0){
             die(json_encode(array("status" => 410, "descrip"=>$_FILES['file']['error'])));
           }else{
             $temp_pos  = $_FILES['file']['tmp_name'];
             $filename  = $_FILES['file']['name'];
             $username  = $_POST['username'];
             $uploadDir = "../userimage/{$username}";
             $suffix    = getSuffix($filename);

             if(!isFormat($suffix)){
               die(json_encode(array("status" => 401, "descrip"=>"格式不正确")));
             }

             if(!isSize($_FILES['file']['size'])){
               die(json_encode(array("status" => 402, "descrip"=>"文件超过1MB")));
             }
             //初始化用户目录
             if(!file_exists($uploadDir)){
               mkdir($uploadDir, 0700);
             }

             $savename = md5(time()).".{$suffix}";
             if(move_uploaded_file($temp_pos, "{$uploadDir}/{$savename}")){
               die(json_encode(array("status" => 400, "descrip"=>"{$uploadDir}/{$savename}")));
             }else{
               die(json_encode(array("status" => 403, "descrip"=>"创建文件失败")));
             }
           }
      }
    }
  }
?>
