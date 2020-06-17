
<html>
<!-- print header -->
<head>
	<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

	<script type="text/javascript">

	//페이지가 로드되면 실행한다.
	$(document).ready( function() {

		$("#header").load("header.html");
	});

	</script>

	<link rel="stylesheet" href="./myPage_donation.css"/>
</head>

<body>
	<div id="header"></div>
	<div id="body">

	<?
			include './dbconn.php';
			
			$userPrm = 4;

			//u_prm으로 id 찾기
			$q_selId = "SELECT ID FROM USER_T WHERE U_PRM='".$userPrm."'";
			$r_selId = mysqli_query($conn,$q_selId);
			$rowId = mysqli_fetch_array($r_selId);
			$userId = $rowId['ID'];

			//u_prm으로 후원 정보 찾기 from d_date_t
			$q_selD = "SELECT S_PRM,D_MONEY  FROM D_INFO_T WHERE U_PRM='".$userPrm."'";
			$r_selD = mysqli_query($conn,$q_selD);
			$row_selD=mysqli_fetch_array($r_selD);
			

			if(!$row_selD){

				echo "
					<p>'".$userId."'님 후원 기록이 없습니다.</p>
					<button><a href='./main_page.html'>후원하러 가기</a></button>
				";
				return;
			}

			else{

				echo "

				<p id='userId'>'".$userId."'님</p>
				<table>
					<tr id='tr1'>
						<td>index</td>
						<td>공연</td>
						<td>펀딩 현황</td>	
						<td>후원 금액</td>
						<td>리워드</td>
						<td>수정</td>
						<td>삭제</td>
					</tr>
				";
			}

			$index = 0;

			
			
			//u_prm이용해서 post_t에서 공연타이틀 찾기
			$q_Sinfo = "SELECT P.S_PRM,S_TITLE,S_GOALSUM,D.D_MONEY as D_MONEY FROM POST_T AS P LEFT JOIN D_INFO_T AS D ON P.S_PRM = D.S_PRM WHERE D.U_PRM='".$userPrm."'";
			$r_Sinfo = mysqli_query($conn, $q_Sinfo);


			while($row_Sinfo=mysqli_fetch_array($r_Sinfo)){

				$sprm = $row_Sinfo['POST_T.S_PRM'];
				$title = $row_Sinfo['S_TITLE'];
				$dMoney = $row_Sinfo['D_MONEY'];

				//while문 끝내기 위한 count쿼리문
				$q_cnt = "SELECT U_PRM, COUNT(D_PRM) AS CntS FROM D_INFO_T WHERE U_PRM='".$userPrm."' GROUP BY U_PRM";
				$r_cnt = mysqli_query($conn,$q_cnt);
				$row_cnt=mysqli_fetch_array($r_cnt);

				$qSumMoney = "SELECT sum(d_money) as sum from d_info_t WHERE S_PRM='".$row_Sinfo['S_PRM']."';";
				$rSumMoney = mysqli_query($conn,$qSumMoney);
				$rowSumMoney = mysqli_fetch_array($rSumMoney);

				$percentage =round($rowSumMoney['sum']/$row_Sinfo['S_GOALSUM'],2);

				

				echo"
					<tr>
						<td>$index</td>
						<td>$title</td>
						<td>$percentage %</td>
						<td>$dMoney</td>
						<td>";


					$q_reward = "SELECT D_REWARD FROM REWARD_T WHERE D_MONEY<='".$row_Sinfo['D_MONEY']."';";
					$r_reward = mysqli_query($conn,$q_reward);

					while($row_reward=mysqli_fetch_array($r_reward)){

						echo"
								'".$row_reward['D_REWARD']."' ";

					}

					echo"		
							</td>
							<td><button class='btn'><a href=''>수정</a></button></td>
							<td><button class='btn'><a href=''>삭제</a></button></td>
						</tr>";
							
						$index++;
						
					if($index==$row_cnt['CntS']){ return;}
			}		

			echo "</table>";	
			mysqli_close($conn);
		?>
	</table>
	</div>
</body>
</html>