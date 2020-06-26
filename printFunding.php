<!--  -마이페이지-펀딩내역 화면 및 처리-->
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

	<link rel="stylesheet" href="./myPage_donation.css?after"/>
</head>

<body>
	<div id="header"></div>
	<div id="body">

		<?
			include './dbconn.php';

			
			$userid = $_SESSION['userid'];
			$nDate = date('Y-m-d');//NOW(TODAY)

			//포스트한 글이 있는지 없는지 검사
			$q_chkIf = "SELECT S_PRM FROM POST_T WHERE id='".$userid."'";
			$r_chkIf = mysqli_query($conn,$q_chkIf);
			$row_chkIF=mysqli_fetch_array($r_chkIf);

			if(!$row_chkIF){
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
		            <span >"'.$_SESSION['userid'].'"님의 포스트 기록이 없습니다.</span>
		            <button id="getShowInfo_btn"><a href="./writepostpage.html"> 글 게시하러 가기</a></button>  
		        </p>
				';
		
				return;
			}
			echo "
			<p id='userId'>'".$_SESSION['userid']."'님이 게시한 공연</p>
			";	

			//로그인한 유저가 포스팅한 글의 INFOuserPrm
			$q_selF = "SELECT S_PRM,S_TITLE,S_GOALSUM,S_DEADLINE FROM POST_T WHERE id='".$userid."'";
			$r_selF = mysqli_query($conn,$q_selF);

			while($row_selF=mysqli_fetch_array($r_selF)){

				$index=0;
				$show_prm = $row_selF['S_PRM'];
				$title = $row_selF['S_TITLE'];
				$goalsum = $row_selF['S_GOALSUM'];
				$deadline = $row_selF['S_DEADLINE'];
				$cong ="";

				$leftDate = intval((strtotime($deadline)-strtotime($nDate)) / 86400);//deadline - today
				

				echo"
				<form name='do_form' method='GET' action='./editFunding.php'>
					<table>
					<input type='hidden' name='s_prm' value='".$show_prm."'/>

					<input type='submit' name='in_btn' class='btn2' value='수정'>

							<input type='submit' name='in_btn' class='btn2' value='삭제'>
					<p class='show_title'>$title</p>
					
					<tr id='tr1'>
						<td>index</td>
						<td> 공연</td>
						<td>펀딩 현황</td>
						<td>남은 기간</td>
						<td>아이디</td>
						<td>후원 금액</td>
						<td>회원 전화번호</td>
						
					</tr>
				";

				//공연 당 후원한 회원정보
				$q_infoUser = "SELECT D.ID,U_PHONE,d_money FROM USER_T AS U JOIN D_INFO_T AS D ON U.id = D.id WHERE D.S_PRM='".$show_prm."';";
				$r_infoUser = mysqli_query($conn,$q_infoUser);


				//$percentage계산 위한 쿼리문
				$qSumMoney = "SELECT sum(d_money) as sum from d_info_t WHERE S_PRM='".$show_prm."';";

				$rSumMoney = mysqli_query($conn,$qSumMoney);
				$rowSumMoney = mysqli_fetch_array($rSumMoney);
				
				if($rowSumMoney==NULL){$rowSumMoney=0;}
				$percentage =round($rowSumMoney['sum']/$goalsum,2)*100;
				if($percentage==100){ $cong="후원성공!";}
			
					

				echo"<a style='margin-left: 0;
			    position: relative;
			    top: -25px;
			    left: 23.5%;
			    font-weight: bold;
			    color: red;'>$cong</a>";

				while($row_infoUser = mysqli_fetch_array($r_infoUser)){

					

					if(!$row_infoUser) {return;}
					$u_id = $row_infoUser['ID'];
					$u_pnum = $row_infoUser['U_PHONE'];
					$u_money = $row_infoUser['d_money'];

					//$percentage계산 위한 쿼리문

					

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
						
						</tr>
					";
					$index++;
					// if($index==$row_cnt2['CNT']){return;}
				}
				echo "</table> <br></form>";
			}
			
			mysqli_close($conn);
		?>
	</div>
</body>
</html>