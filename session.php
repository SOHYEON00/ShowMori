<!-- 세션 유지(오류방지) -->
<?php
  session_cache_limiter("private_no_expire");
  session_start();
 ?>
