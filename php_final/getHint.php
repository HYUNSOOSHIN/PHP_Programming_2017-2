<?php
session_start();

$q=$_REQUEST['q']; $user_id="";

?>

  <?php
  $con = mysqli_connect('localhost','root','123123','soccer');

  if($q != ""){
  $sql="SELECT * FROM user_info WHERE user_id like '$q%' ";
  $result=mysqli_query($con,$sql);

  while ($row = mysqli_fetch_array($result)){
    $id = $row[0];
    $name = $row[1];
    $user = $row[2];
    $data = $row[3];
  
    if($user_id==""){
      $user_id = "이미 존재하는 이름: $name"; 
    } else {
      $user_id .= ", $name"; 
    }

  }

  echo $user_id==="" ? "중복된 이름이 없습니다." : $user_id;


  } else{
    echo "";
  }

  ?>
</table>
