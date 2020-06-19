<?php
  session_start();
  include './dbconn.php';

  $id=$_REQUEST['id'];
  $password=$_REQUEST['pass'];
  $name=$_REQUEST['name'];
  $phone=$_REQUEST['phone'];

  $sql = "update user_t set pw='".$password."', u_name='".$name."', u_phone='".$phone."' WHERE id='".$_SESSION['userid']."'";


  if($conn->query($sql)){
    echo 'success inserting <p/>';
    echo $name.'님 정보 수정 완료되었습니다!.<p/>';
  }else{
    echo 'fail to insert sql';
  }
  mysqli_close($conn);

  ?>

  <input type="button" value="홈으로" onClick="location='main_page.html'">
  </html>
