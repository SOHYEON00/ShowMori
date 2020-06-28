<!-- 로그인 처리 -->

<?
session_start();
include "./dbconn.php";

$id = $_REQUEST["id"];
$pw = $_REQUEST["pass"];


$sql = "SELECT id,pw FROM user_t WHERE id='$id' AND pw='$pw'"; //입력된 id값과 pw가 일치한지 확인
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

  <style>
 @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
 #contents{
     position: relative;
     width:600px;
     height:100px;
     top: 30%;
     background-color: #EAEAEA;
     margin: 0 auto;
     text-align: center;
 }
 #contents span{
     font-family:"Nanum Brush Script";
     font-size:30px;
     padding: 0 10;
     position: absolute;
     top: 40%;
     left:30%;
 }
 #getShowInfo_btn{
     position:relative;
     top:110%;
     margin:0 auto;
     background-color: #F96B6B;
     border-radius: 12px;
     font-size:18px;
     color:white;
     border: 10px;
     height: 35px;
 }
 #contents a:visited{ color:white; }
 }
 </style>
</head>

<body>
  <div id="header"></div>
  <p id="contents">
  <?php
  //row 튜플에 존재 할 때 로그인 정보 세션에 저장
  if($row){
    $_SESSION['userid'] = $row['id'];
    $_SESSION['userpass'] = $row['pass'];
    $_SESSION['username'] = $row['name'];
    $_SESSION['userphone'] = $row['phone'];
    ?>
    <span> <? echo $_SESSION['userid'] ?>님 안녕하세요.</span>
    <button id="getShowInfo_btn"><a href="./main_page.html"> 메인 페이지로 가기 </a></button>
    <?
    exit;
  }
   //row 튜플에 데이터가 존재하지 않을 때
  else{
     ?>
      <script>
      alert("로그인에 실패하였습니다");
      history.back();
      </script>
      <?php
    }
      ?>

  </p>

</body>
</html>