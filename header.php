<?php
	session_start();
 ?>
<html>
	<head>
		<link rel="stylesheet" href="./header.css"/>
	</head>
	<body>
	<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Do+Hyeon&family=Nanum+Brush+Script&family=Nanum+Gothic:wght@800&display=swap" rel="stylesheet">

<!--header part -->
	<div id="header">
	<h1 class="title"><a href="./main_page.html">SHOW-MORI </a></h1>

	<form method="POST" action="search.php">
		<span id="search">
		<input type="text" id="search_text" name="srchTxt">
		<button type="submit" ><img src="./IMG/search.jpg" width="40" height="40" ></button>
		</span>
	</form>

	<button type="button" name="post" id="btn_post" onClick="location.href='writepostpage.html'">공연 게시하기</button>


		<span id="login">
			<?php
			 	if(!isset($_SESSION['userid'])){
			?>
			<a href="./loginpage.php">로그인</a> | <a href="./signup_form.php">회원가입</a>

			<?php
		} else {
		?>
		<?=$_SESSION['userid']?>
			<a href="./logout.php">로그아웃</a> | <a href="./myPage.html">마이페이지</a>
		<?php }  ?>
			</span>
<!--			<button type="button" class="login_botton" onClick="location.href='logout.php'">로그아웃</button>/
			<button type="button" class="login_botton" onClick="location.href='myPage.html'">마이페이지</button>
			<button type="button" ><img src="./IMG/profile.jpg" width="40" height="40"  onclick="location.href='myPage.html'"></button>
		</span>


		<span class="login">
		<button type="button" class="login_botton" onClick="location.href='loginpage.php'">로그인</button>/
		<button type="button" class="login_botton" onClick="location.href='signuppage.html'">회원가입</button>
		<button type="button" ><img src="./IMG/profile.jpg" width="40" height="40"  onclick="location.href='myPage.html'"></button>
	</span>
-->



	<img src="./IMG/headerLine.png" id="line">
	</div>
	</body>
</html>
