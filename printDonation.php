<!-- 마이페이지-후원내역 화면 및 처리 -->

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
			$editDonation = './editDonation.php';
			$deleteDonation = './deleteDonation.php';

			//u_prm으로 id 찾기
			$q_selU_PRM = "SELECT U_PRM FROM USER_T WHERE ID='".$_SESSION['userid']."'";
			$r_selU_PRM = mysqli_query($conn,$q_selU_PRM);
			$rowU_PRM = mysqli_fetch_array($r_selU_PRM);
			$userPrm = $rowU_PRM['U_PRM'];


			//u_prm으로 후원 정보 찾기 from d_date_t
			$q_selD = "SELECT S_PRM,D_MONEY  FROM D_INFO_T WHERE U_PRM='".$userPrm."'";
			$r_selD = mysqli_query($conn,$q_selD);
			$row_selD=mysqli_fetch_array($r_selD);
			

			if(!$row_selD){

				echo'
					<style>
		        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
		     	#contents{
		            position: relative;
		            width:600px;
		            height:100px;
		            background-color: #EAEAEA;
		            margin: 0 auto;
		            text-align: center;
		        }	
		        #contents span{
		            font-family:"Nanum Brush Script";
		            font-size:30px;
		            padding: 0 10;
		            position: absolute;
		            top: 40%;
		            left:30%;
		        }
		        #getShowInfo_btn{
		            position:relative;
		            top:110%;
		            margin:0 auto;
		            background-color: #F96B6B;
		            border-radius: 12px;
		            font-size:18px;
		            color:white;
		            border: 10px;
		            height: 35px;
		        }
		        #contents a:visited{ color:white; }
		        }
		        </style>

					<div id="header"></div>
		        	<p id="contents">
		            <span >"'.$userId.'"님의 후원 기록이 없습니다.</span>
		            <button id="getShowInfo_btn"><a href="./main_page.html"> 후원하러가기</a></button>  
		        </p>
				';
				
				return;
			}

			else{

				echo "

				<p id='userId'>'".$userId."'님이 현재 후원 중인 공연</p>
				<form name='do_form' method='GET' action='./editDonation.php'>
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

			
			
			//get info of column using u_prm
			$q_Sinfo = "SELECT P.S_PRM as SPRM,S_TITLE,S_GOALSUM,D.D_MONEY as D_MONEY FROM POST_T AS P LEFT JOIN D_INFO_T AS D ON P.S_PRM = D.S_PRM WHERE D.U_PRM='".$userPrm."'";
			$r_Sinfo = mysqli_query($conn, $q_Sinfo);


			while($row_Sinfo=mysqli_fetch_array($r_Sinfo)){

				$sPrm = $row_Sinfo['SPRM'];
				$title = $row_Sinfo['S_TITLE'];
				$dMoney = $row_Sinfo['D_MONEY'];


				//get $cnt to finish while()
				$q_cnt = "SELECT U_PRM, COUNT(D_PRM) AS CntS FROM D_INFO_T WHERE U_PRM='".$userPrm."' GROUP BY U_PRM";
				$r_cnt = mysqli_query($conn,$q_cnt);
				$row_cnt=mysqli_fetch_array($r_cnt);

				$qSumMoney = "SELECT sum(d_money) as sum from d_info_t WHERE S_PRM='".$row_Sinfo['S_PRM']."';";
				$rSumMoney = mysqli_query($conn,$qSumMoney);
				$rowSumMoney = mysqli_fetch_array($rSumMoney);

				$percentage =round($rowSumMoney['sum']/$row_Sinfo['S_GOALSUM'],2)*100;


				echo"
					<tr>
						<td>$index</td>
						<input type='hidden' name='s_prm' value='".$sPrm."'/>
						<td>$title</td>
						<td>$percentage %</td>
						<td>$dMoney</td>
						<td>";

					//query for get reward
					$q_reward = "SELECT D_REWARD FROM REWARD_T WHERE D_MONEY<='".$row_Sinfo['D_MONEY']."';";
					$r_reward = mysqli_query($conn,$q_reward);

					while($row_reward=mysqli_fetch_array($r_reward)){

						echo"
								'".$row_reward['D_REWARD']."' ";

					}

					echo"		
							</td>
							<td><input type='submit' name='in_btn' class='btn' value='수정'></td>

							<td><input type='submit' name='in_btn' class='btn' value='삭제'></td>
						</tr>";
							
						$index++;
						
					if($index==$row_cnt['CntS']){ return;}
			}		

			echo "</table></form>";	
			mysqli_close($conn);
		?>
	</table>
	</div>
</body>
</html>