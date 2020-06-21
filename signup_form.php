<!-- 회원가입 페이지 -->
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
    <script>
    function check_id()
    {
      window.open("check_id.php?id="+document.member_form.id.value, "IDcheck", "left=200, top=200, width=200, height=60, scrollbars=no, resizeble=yes");
    }
    function check_input()
    {
      if(!document.member_form.id.value){
        alert("아이디를 입력해주세요");
        document.member_form.id.focus();
        document.member_form.id.select();
      }
      else if(!document.member_form.pass.value){
        alert("비밀번호를 입력해주세요");
        document.member_form.pass.focus();
        document.member_form.pass.select();
      }
      else if(!document.member_form.name.value){
        alert("이름을 입력해주세요");
        document.member_form.name.focus();
        document.member_form.name.select();
      }
      else if(document.member_form.pass.value != document.member_form.pass_confirm.value)
      {
          alert("비밀번호가 일치하지 않습니다. \n다시입력해주세요");
          document.member_form.pass.focus();
          document.member_form.pass.select();
          return;
      }
      else{
        document.member_form.submit();
      }
    }

    function reset_form() //취소하기 버튼 눌렀을 때
    {
      document.member_form.id.value="";
      document.member_form.pass.value="";
      document.member_form.pass_confirm.value="";
      document.member_form.name.value="";
      document.member_form.phone.value="";

      document.member_form.id.focus();
      return;
    }
    </script>
  </head>

  <body>
    <div id="header"></div>
    <div id="showmorilogin">
      <!-- <form action='./login2.php' name='login_form' method='post'> -->
        <br>
        <br>
        <form name="member_form" method="post" action="memberSave.php">
        <div id="signup_rectangle">
        <CENTER><p class="login_title">회원가입</p><br>
            <div id="signup_form"> <!--회원가입 양식 -->
              <div id="join1">  <!-- 회원가입 종목 -->
                <ul>
                  <li>* ID : </li>
                  <li>* PASSWORD : </li>
                  <li>* PASSWORD CONFIRM : </li>
                  <li>* NAME : </li>
                  <li>* PHONE NUMBER : </li>
                </ul>
              </div>

              <div id="join2">  <!-- 입력 값 -->
                <ul>
                  <li><div id="id1"><input type="text" name="id" required></div>
                    <button id="id2" onClick="check_id();">중복확인</button>
                    <li><input type="password" name="pass" required></li>
                    <li><input type="password" name="pass_confirm" required></li>
                    <li><input type="text" name="name" required></li>
                    <li><input type="text" class="hp" name="phone"></li>
                  </ul>
                </div> <!--end of join2 -->
                <div class="clear"></div>
                <div id="button">
                  <button id="button1" onClick="check_input();">가입하기</button>&nbsp;&nbsp;
                  <button id="button2" onClick="reset_form();">다시쓰기</button>
                </div>
              </div> <!-- end of signup_form -->
            </form>
          </div> <!-- end of signup_rectangle" -->
      </div> <!-- end of showmorilogin -->
  </body>
  </html>
