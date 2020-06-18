<html>
<meta charset="utf-8">

<?php
  include './dbconn.php';

  $id=$_POST['id'];
  $password=($_POST['pass']);
  $name=$_POST['name'];
  $phone=$_POST['phone'];

  $sql = "insert into user_t (id, pw, u_name, u_phone)";
  $sql = $sql. "values('$id', '$password', '$name', '$phone')";

  if($conn->query($sql)){
    echo 'success inserting <p/>';
    echo $name.'님 가입 되셨습니다!.<p/>';
  }else{
    echo 'fail to insert sql';
  }
  mysqli_close($conn);

  ?>

  <input type="button" value="로그인하러가기" onClick="location='loginpage.php'">
  </html>
