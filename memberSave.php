<!-- 회원가입처리 -->

<html>
<meta charset="utf-8">
<head>
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
  include './dbconn.php';

  $id=$_POST['id'];
  $password=($_POST['pass']);
  $name=$_POST['name'];
  $phone=$_POST['phone'];

  $sql = "insert into user_t (id, pw, u_name, u_phone)";
  $sql = $sql. "values('$id', '$password', '$name', '$phone')";

  if($conn->query($sql)){
    ?>
    <span> <? echo $name ?>님 가입 되셨습니다!.</span>
    <?
  }else{
    echo 'fail to insert sql';
  }
  mysqli_close($conn);

  ?>
  <button id="getShowInfo_btn"><a href="./loginpage.php"> 로그인하러가기 </a></button>

</div>
</body>
  </html>
