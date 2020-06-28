<!-- 로그아웃 처리
 -->

<?php
  session_start();
  //해당 세션 종료
  session_destroy();
  $is_logged='NO';
 ?>

 <meta http-equiv="refresh" content="0;url=main_page.html"/>