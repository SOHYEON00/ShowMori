<?
  session_start();
?>

<!DOCTYPE html>
<html>
<meta charset="UTF-8">
<!-- print header -->
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
</head>

<body>
  <div id="header"></div>
  <div id="showmorilogin">
  <!--  <form action='./login_form.php' name='login_form' method='post'> -->
      <br>
      <br>
      <form name="login_form" method="post" action="login_form.php">
      <div class="login_rectangle">
      <CENTER><p class="login_title">로그인</p><br>
        <div id="login_form">
          <div id="login1">

            <div id="id_input_button">
              <div id="id_pw_title">
                <ul>
                  <li> ID : </li>
                  <li> PW : </li>
                </ul>
              </div>
              <div id="id_pw_input">
                <ul>
                  <li><input type="text" name="id" class="login_input" required></li>
                  <li><input type="password" name="pass" class="login_input" required></li>
                </ul>
              </div>
              <div id="login_button">
                  <center><button id="button3" onClick="document.member_form.submit()">로그인</button>&nbsp;&nbsp;
              </div>
            </div>

            <div class="clear"></div>
            <div id="join_button">
              <button id="button4" onClick="./signup_form.php">회원가입</button>
            </div>
          </div> <!-- end of login1 -->
        </div> <!-- end of login_form -->
      </div> <!-- end of login_rectangle -->
    </form>
  </div>  <!-- end of showmorilogin -->
</body>
</html>
