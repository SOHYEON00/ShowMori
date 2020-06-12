<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<html>
<head>
  <title>회원가입</title>
  <script>
  function newcheckform(){
    if(!document.signup_form.user_id.value){
      alert('아이디가 입력되지 않았습니다. ');
      document.signup_form.user_id.focus();
      return;
    }

    else if(!document.signup_form.user_password.value){
      alert('비밀번호가 입력되지 않았습니다. ');
      document.signup_form.user_id.focus();
      return;
    }

    else if(!document.signup_form.user_name.value){
      alert('회원이름이 입력되지 않았습니다. ');
      document.signup_form.user_id.focus();
      return;
    }

    else if(!document.signup_form.user_phone.value){
      alert('전화번호가 입력되지 않았습니다. ');
      document.signup_form.user_id.focus();
      return;
    }

    document.signup_form.submit();
  }
  </script>
</head>

<body>
  <form action='./signup2.php' name='signup_form' method='post'>
    <br>
    <br>
    <CENTER>회원가입></b></div><br>
      <label>아이디 : </label><input type="text" name="user_id" class="box"/><br>
      <label>비밀번호 : </label><input type="text" name="user_password" class="box"/><br>
      <label>회원이름 : </label><input type="text" name="user_name" class="box"/><br>
      <label>전화번호 : </label><input type="text" name="user_phone" class="box"/><br>

      <center><input type="button" value="회원가입" OnClick="newcheckform();"/><br />
      </form>
