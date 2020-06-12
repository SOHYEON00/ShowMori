<!-- 로그인하고 로그아웃하기까지 로그인상태를 유지 -->
<?php
// 현재 폼 값을 유지시켜주는 역할
  session_cache_limiter("private_no_expire");
  session_start();
 ?>
