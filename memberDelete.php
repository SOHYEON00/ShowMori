<!-- 회원 탈퇴 화면 -->

<?php
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <!-- print header -->
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="stylesheet" type="text/css" href="./post.css">
  <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
  <script type="text/javascript">
    //페이지가 로드되면 실행한다.
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
     top: 300px;
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
 .getShowInfo_btn{
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
    <span>회원 탈퇴 하시겠습니까?</span>
    <button class="getShowInfo_btn"><a href="./main_page.html"> 취소하기 </a></button>
    <button class="getShowInfo_btn"><a href="./memberDeleteform.php"> 탈퇴하기 </a></button>
  </p> <!-- end of wrap_deletemember -->
</body>
</html>
