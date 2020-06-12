<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />


<html>
<head>
  <script>
    function checkform(){
      if(!document.login_form.user_id.value){
        alert('아이디가 입력되지 않았습니다. ');
        document.login_form.user_id.focus();
        return;
      }
      else if(!document.login_form.user_password.value){
        alert('비밀번호가 입력되지 않았습니다. ');
        document.login_form.user_password.focus();
        return;
      }
      document.login_form.submit();
    }
  </script>
</head>
<body>
  <?php
    include "./session.php";
    include './dbconn.php';

    $memberid=$_POST['user_id'];
    $memberpassword=$_POST['user_password'];


    $sql = "SELECT id,pw FROM user_t WHERE id='$memberid' AND pw='$memberpassword'";
    $res = $conn->query($sql);

      $row = $res->fetch_array(MYSQLI_ASSOC);

      if($row){
  
         $_SESSION['ses_username'] = $row['id'];
        echo $_SESSION['ses_username'].'님 안녕하세요<p/>';
        echo '<a href="./loginpage.php">로그아웃하기</a>';
      }

      else{
        echo '<html>

        <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head>
        <body>';?>

        <?php
        echo'로그인 실패입니다'; //로그인실패
        echo '<a href="./loginpage.php">로그인화면으로가기</a>';
        ?>
        
        <?
        echo '
        </body>
        </html>
        ';
      }
    ?>
 

</body>
</html>
