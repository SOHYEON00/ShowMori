<?
include "session.php";
include "dbconn.php";
?>

<!doctype html>
<html>
<!-- print header -->
<head>
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="stylesheet" type="text/css" href="./post.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">

//페이지가 로드되면 실행한다.
$(document).ready( function() {

  $("#header").load("header.html");
});

</script>
</head>

<body>
<div id="header"></div>
  <div id="showmorilogin">
  <form action='./login_form.php' name='login_form' method='post'>
    <br>
    <br>
    <div class="login_rectangle">
    <CENTER><p class="login_title">로그인</p></b><br>
      <label>ID : </label><input type="text" name="user_id" class="box"/><br>
      <label>PW : </label><input type="password" name="user_password" class="box"/></br>
<br><br>
      <center><input type="submit" value="로그인" class="login_button"/>
<br><br>
      <center><a href="./signuppage.html"><input type="button" value="회원가입" class="submit_button"/></a></br>
      </div>
  </div>

    </body>
</html>