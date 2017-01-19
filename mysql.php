<?php
  // $conn = new mysqli("localhost", "root", "root");
  //
  // if($conn->connect_error){
  //   die("fail".$conn->connect_error);
  // }
  //
  // echo "success","dsad";

// $servername = "localhost";
// $username = "root";
// $password = "root";
//
// $conn = new mysqli($servername, $username, $password, "test");
// if($conn->connect_error){
//   die("connect_error：".$conn->connect_error);
// }
//
// $sql="INSERT INTO artical(title,create_date,content, tags) VALUES('ohh', from_unixtime(unix_timestamp(), '%Y-%m-%d %H-%i-%s'), '儿子', 'life');";
// $result = $conn->query($sql);
// if($result)
//   echo "nice!";
// else {
//   echo "no";
// }
//
// $sql = "select * from artical";
// $resul = $conn->query($sql);
// while($row = $resul->fetch_assoc()){
//   echo $row['title'];
// }
//print_r($result);

class m{
  var $a ;
  public function __construct($a){
    $this->a = $a;
    echo $this->a;
  }
}
$m = new m("dsa");
echo $m->a;
?>
