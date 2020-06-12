<?php
    include "./dbconn";

    $userid = $POST['user_id'];
    $userpwd = $POST['user_password'];
    $username = $POST['user_name'];
    $userphone = $POST['user_phone'];

    $sql = mq("insert into user_t (id, pw, u_name, u_phone) values('".$userid."','".$userpwd."','".$username."','".$userphone."')");

 ?>

 <meta charset="utf-8" />
 <script type="text/javascript">alert('회원가입이 완료되었습니다.');</script>
 <meta http-equiv="refresh" content="0 url=/">
