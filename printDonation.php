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


			//유저가 후원한 공연,후원금액 찾는 쿼리문
			$q_selD = "SELECT S_PRM,D_MONEY  FROM D_INFO_T WHERE id='".$userId."';";
			$r_selD = mysqli_query($conn,$q_selD);
			$row_selD=mysqli_fetch_array($r_selD);
			

			//후원기록이 없는 경우
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

			//유저가 후원한 공연 및 후원정보
			$q_Sinfo = "SELECT P.S_PRM as SPRM,S_TITLE,S_GOALSUM,D.D_MONEY as D_MONEY FROM POST_T AS P LEFT JOIN D_INFO_T AS D ON P.S_PRM = D.S_PRM WHERE D.id='".$userId."';";
			$r_Sinfo = mysqli_query($conn, $q_Sinfo);


			while($row_Sinfo=mysqli_fetch_array($r_Sinfo)){

				$sPrm = $row_Sinfo['SPRM'];
				$title = $row_Sinfo['S_TITLE'];
				$dMoney = $row_Sinfo['D_MONEY'];


				//get $cnt to finish while()
				$q_cnt = "SELECT ID, COUNT(D_PRM) AS CntS FROM D_INFO_T WHERE id='".$userId."' GROUP BY ID";
				$r_cnt = mysqli_query($conn,$q_cnt); 
				$row_cnt=mysqli_fetch_array($r_cnt);

				//percentage를 위한 쿼리문
				$qSumMoney = "SELECT SUM(d_money) as SUM1 from D_INFO_T WHERE S_PRM='".$sPrm."';";
				$rSumMoney = mysqli_query($conn,$qSumMoney);
				$rowSumMoney = mysqli_fetch_array($rSumMoney);

				$percentage =round($rowSumMoney['SUM1']/$row_Sinfo['S_GOALSUM'],2)*100;
				

				echo"
					<tr>
						<td>$index</td>
						<input type='hidden' name='s_prm' value='".$sPrm."'/>
						<td>$title</td>";
				if($percentage==100){ echo"<td style='color:red;'>$percentage %</td>";} //후원성공한 경우 글씨컬러 변경
				else{ echo "<td>$percentage %</td>";}

				echo"
					<td>$dMoney</td>
					<td>";

					//query for get reward
					$q_reward = "SELECT D_REWARD FROM REWARD_T WHERE D_MONEY<='".$row_Sinfo['D_MONEY']."';";
					$r_reward = mysqli_query($conn,$q_reward);

					while($row_reward=mysqli_fetch_array($r_reward)){
						echo" '".$row_reward['D_REWARD']."' ";

					}

					echo"		
							</td>
							<td><input type='submit' name='in_btn' class='btn' value='수정'></td>
							<td><input type='submit' name='in_btn' class='btn' value='삭제'></td>
						</tr>";
							
						$index++;
						
					if($index==$row_cnt['CntS']){ return;} //while문 종료
			}		

			echo "</table></form>";	
			mysqli_close($conn);
		?>
	</table>
	</div>
</body>
</html>