<!-- 로그아웃 처리
 -->

<?php
  session_start();
  session_destroy();
  $is_logged='NO';
 ?>

 <meta http-equiv="refresh" content="0;url=main_page.html"/>
