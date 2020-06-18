<?php 
session_start();
 ?>
 <html>
<!-- print header -->
<head>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	<script type="text/javascript">

	//페이지가 로드되면 실행한다.
	$(document).ready( function() {

		$("#header").load("header.php");
	});

	</script>

	<link rel="stylesheet" href="./myPage_donation.css?after"/>
</head>

<body>
	<div id="header"></div>
	<div id="body">

<?
	include './dbconn.php';

		
	$userId = $_SESSION['userid'];

	//u_prm으로 id 찾기
	$q_selU_PRM = "SELECT u_prm FROM USER_T WHERE ID='".$_SESSION['userid']."'";
	$r_selU_PRM = mysqli_query($conn,$q_selU_PRM);
	$rowU_PRM = mysqli_fetch_array($r_selU_PRM);
	$userPrm = $rowU_PRM['U_PRM'];

	$q_selF = "SELECT S_PRM FROM POST_T WHERE U_PRM='".$userPrm."'";
	$r_selF = mysqli_query($conn,$q_selF);
	$row_seF=mysqli_fetch_array($r_selF);
	$nDate = date('Y-m-d');//NOW(TODAY)

	if(!$row_seF){

		echo "
			<p>'".$userId."'님의 포스트 기록이 없습니다.</p>
			<button><a href='./wrtiepostpage.html'>글 게시하러 가기</a></button>
			";
		return;
	}
	else{
		echo "
			<p id='userId'>'".$userId."'님이 게시한 공연</p>
			";	
	}
	
	


	while($row_seF=mysqli_fetch_array($r_selF)){
		
		$index = 0;
		$sPrm = $row_seF['S_PRM'];

		echo"
				<table>
				<tr id='tr1'>
					<td>index</td>
					<td>공연</td>
					<td>펀딩 현황</td>
					<td>남은 기간</td>
					<td>아이디</td>
					<td>후원 금액</td>
					<td>회원 전화번호</td>
					<td>글 수정</td>
					<td>글 삭제</td>
				</tr>";


		$q_table = "SELECT S_PRM,S_TITLE, S_GOALSUM, S_DEADLINE FROM POST_T WHERE S_PRM='".$sPrm."'";
		$r_table = mysqli_query($conn,$q_table);

		while($row_table=mysqli_fetch_array($r_table)){

			$tSprm = $row_table['S_PRM'];

			//get $cnt to finish while()
			$q_cnt = "SELECT U_PRM, COUNT(S_PRM) AS CntS FROM POST_T WHERE U_PRM='".$userPrm."' GROUP BY U_PRM";
			$r_cnt = mysqli_query($conn,$q_cnt);
			$row_cnt=mysqli_fetch_array($r_cnt);

			//$percentage계산 위한 쿼리문
			$qSumMoney = "SELECT sum(d_money) as sum from d_info_t WHERE S_PRM='".$row_table['S_PRM']."';";
			$rSumMoney = mysqli_query($conn,$qSumMoney);
			$rowSumMoney = mysqli_fetch_array($rSumMoney);

			$title = $row_table['S_TITLE'];
			$percentage =round($rowSumMoney['sum']/$row_table['S_GOALSUM'],2);
			$leftDate = intval((strtotime($row_table['S_DEADLINE'])-strtotime($nDate)) / 86400);//deadline - today

			echo "
				<tr>
					<td>$index</td>
					<td>$title</td>
					<td>$percentage %</td>
					<td>D-$leftDate</td>
				"; 

			$q_infoUser = "SELECT ID,U_PHONE,d_money FROM USER_T AS U JOIN D_INFO_T AS D ON U.U_PRM = D.U_PRM WHERE D.S_PRM='".$tSprm."';";
			$r_infoUser = mysqli_query($conn,$q_infoUser);
			$row_infoUser = mysqli_fetch_array($r_infoUser);

			$id = $row_infoUser['ID'];
			$phone = $row_infoUser['U_PHONE'];
			$dMoney = $row_infoUser['d_money'];

			echo "
					<td>$id</td>
					<td>$dMoney</td>
					<td>$phone</td>
					<td><button class='btn'><a href=''>수정</a></button></td>
					<td><button class='btn'><a href=''>삭제</a></button></td>
					</tr>

				";
			
			$index++;
			if($index==$row_cnt['CntS']){ return;}
			
		}

		echo "</table>
			<p class='total'>00명이 후원 중</p><br><br>	";
	}
	
	mysqli_close($conn);
?>

	</div>
</body>
</html>