<?
session_start();
include "./dbconn.php";

$id = $_REQUEST["id"];
$pw = $_REQUEST["pass"];


$sql = "SELECT id,pw FROM user_t WHERE id='$id' AND pw='$pw'";
$res = $conn->query($sql);
$row = $res->fetch_array(MYSQLI_ASSOC);

?>

<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="stylesheet" type="text/css" href="./post.css">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

  <script type="text/javascript">
  $(document).ready( function() {

    $("#header").load("header.php");
  });
  </script>
</head>

<body>
  <div id="header"></div>
  <div id="showmorilogin">
    <div class="alignmiddle">
  <?php
  if($row){
    $_SESSION['userid'] = $row['id'];
    $_SESSION['username'] = $row['name'];
    $_SESSION['userphone'] = $row['phone'];
    echo $_SESSION['userid'].'님 안녕하세요<p/>';
    header("Location:http://localhost/main_page.html");
    exit;
  }
  else{
     ?>
      <script>
      alert("로그인에 실패하였습니다");
      history.back();
      </script>
      <?php
    }
      ?>

  </div>
</div>

</body>
</html>
