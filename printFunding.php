<?
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

	<link rel="stylesheet" href="./myPage_donation.css"/>
</head>

<body>
	<div id="header"></div>
	<div id="body">

		<?
			include './dbconn.php';
			
			//세션아이디로 u_prm얻어오기
			$q_getUprm = "SELECT U_PRM FROM USER_T WHERE ID='".$_SESSION['userid']."';";
			$r_getUprm = mysqli_query($conn,$q_getUprm);
			$row_getUprm = mysqli_fetch_array($r_getUprm);
			$userPrm = $row_getUprm['U_PRM'];

			$nDate = date('Y-m-d');//NOW(TODAY)

			//포스트한 글이 있는지 없는지 검사
			$q_chkIf = "SELECT S_PRM FROM POST_T WHERE U_PRM='".$userPrm."'";
			$r_chkIf = mysqli_query($conn,$q_chkIf);
			$row_chkIF=mysqli_fetch_array($r_chkIf);

			if(!$row_chkIF){

				echo "
					<p>'".$_SESSION['userid']."'님의 포스트 기록이 없습니다.</p>
					<button><a href='./wrtiepostpage.html'>글 게시하러 가기</a></button>
					";
				return;
			}
			echo "
			<p id='userId'>'".$_SESSION['userid']."'님이 게시한 공연</p>
			";	

			//로그인한 유저가 포스팅한 글의 INFO
			$q_selF = "SELECT S_PRM,S_TITLE,S_GOALSUM,S_DEADLINE FROM POST_T WHERE U_PRM='".$userPrm."'";
			$r_selF = mysqli_query($conn,$q_selF);

			while($row_selF=mysqli_fetch_array($r_selF)){

				$index=0;
				$show_prm = $row_selF['S_PRM'];
				$title = $row_selF['S_TITLE'];
				$goalsum = $row_selF['S_GOALSUM'];
				$deadline = $row_selF['S_DEADLINE'];

				echo"
					<table>
					<p class='show_title'>$title</p>
					<tr id='tr1'>
						<td>index</td>
						<td> 공연</td>
						<td>펀딩 현황</td>
						<td>남은 기간</td>
						<td>아이디</td>
						<td>후원 금액</td>
						<td>회원 전화번호</td>
						<td>글 수정</td>
						<td>글 삭제</td>
					</tr>
				";

				//공연 당 후원한 회원정보
				$q_infoUser = "SELECT ID,U_PHONE,d_money FROM USER_T AS U JOIN D_INFO_T AS D ON U.U_PRM = D.U_PRM WHERE D.S_PRM='".$show_prm."';";
				$r_infoUser = mysqli_query($conn,$q_infoUser);


				//$percentage계산 위한 쿼리문
				$qSumMoney = "SELECT sum(d_money) as sum from d_info_t WHERE S_PRM='".$row_table['S_PRM']."';";
				$rSumMoney = mysqli_query($conn,$qSumMoney);
				$rowSumMoney = mysqli_fetch_array($rSumMoney);


				
				while($row_infoUser = mysqli_fetch_array($r_infoUser)){

					if(!$row_infoUser) {return;}
					$u_id = $row_infoUser['ID'];
					$u_pnum = $row_infoUser['U_PHONE'];
					$u_money = $row_infoUser['d_money'];

					//$percentage계산 위한 쿼리문
					$percentage =round($rowSumMoney['sum']/$goalsum,2);
					$leftDate = intval((strtotime($deadline)-strtotime($nDate)) / 86400);//deadline - today

					echo "
						<tr>
						<td>$index</td>
						<td>$title</td>
						<td>$percentage %</td>
						<td>D-$leftDate</td>
					"; 

					echo "
						<td>$u_id</td>
						<td>$u_money</td>
						<td>$u_pnum</td>
						<td><button class='btn'><a href=''>수정</a></button></td>
						<td><button class='btn'><a href=''>삭제</a></button></td>
						</tr>
					";
					$index++;
					// if($index==$row_cnt2['CNT']){return;}
				}
				echo "</table> <br>";
			}
			/*
				while()
				{
					테이블, 첫 tr 출력 /유저가 올린 포스트 개수만큼 나와야 함.
					필요한 것 : u_prm이 올린 포스트 정보(s_title,s_deadline,s_goalsum)

					while()
					{
						각 테이블 당 후원한 사람들 + 게시글 정보 출력

					}
				}
			*/
			mysqli_close($conn);
		?>
	</div>
</body>
</html>