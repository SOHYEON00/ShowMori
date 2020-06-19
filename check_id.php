<!-- ID중복확인 -->
<meta charset="UTF-8">
<?php
  $id = $_REQUEST["id"]; //id값 변수로 받음
  if(!$id)
  {
    print "아이디를 입력하세요 <p>";
  }
  else {
    include './dbconn.php';

    $sql="SELECT COUNT(*) cnt FROM user_t WHERE ID='$id'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_array($result);

  if($row['cnt']<1){
    print "사용가능한 아이디입니다 <p>";
  } else{
    print "아이디가 중복됩니다. <br>다른 아이디를 사용해주세요<p>";
  }
 }
  print "<center><input type=button value=창닫기 onClick='self.close()'></center>";

  ?>
