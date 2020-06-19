<!-- 후원 내역->수정 -->

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
		session_start();
		include './dbconn.php';

		$sprm = $_GET['s_prm'];
		$func = $_GET['in_btn'];
		$userid = $_SESSION['userid'];

		$q_getU = "SELECT U_PRM FROM USER_T WHERE ID='".$userid."';";
		$r_getU = mysqli_query($conn,$q_getU);
		$row_getU = mysqli_fetch_array($r_getU);
		$uprm = $row_getU['U_PRM'];

		$q_getInfo = "SELECT D_PRM, S_TITLE, D_MONEY,D_DATE FROM D_INFO_T JOIN POST_T ON D_INFO_T.S_PRM=POST_T.S_PRM WHERE D_INFO_T.U_PRM='".$uprm."' AND D_INFO_T.S_PRM='".$sprm."';";
		$r_getInfo = mysqli_query($conn,$q_getInfo);

		while($row_getInfo = mysqli_fetch_array($r_getInfo)){

			$dprm = $row_getInfo['D_PRM'];
			$sTitle = $row_getInfo['S_TITLE'];
			$dMoney = $row_getInfo['D_MONEY'];
			$dDate= $row_getInfo['D_DATE'];
		}


		if($func=='수정'){

		}
		if($func=='삭제'){

			echo "<script>alert('정말 후원을 취소하시겠습니까?');</script>";
			$q_delete = "DELETE FROM D_INFO_T WHERE D_PRM='".$dprm."';";
			$r_delete =mysqli_query($conn,$q_delete);
			
			$q_chkDelete = "SELECT D_PRM FROM D_INFO_T WHERE D_PRM='".$dprm."';";
			$r_chkDelete = mysqli_query($conn,$q_chkDelete);
			$row_chkDelete = mysqli_fetch_array($r_chkDelete);

			if($row_chkDelete){ echo "<script>alert('후원 취소에 실패했습니다.');</script>"; return;}

			echo'<html>
                <head>
                <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
                <script type="text/javascript">
                //페이지가 로드되면 실행한다.
                $(document).ready( function() {
                    $("#header").load("header.php");
                });
                </script>
                 <style>
		        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
		        #contents{
		            position: relative;
		            width:600px;
		            height:100px;
		            top:10%;
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
		        </style>

		      <div id="header"></div>
		          <p id="contents">
		            <span >후원이 취소되었습니다.</span>
		            <button id="getShowInfo_btn"><a href="./main_page.html"> 다른 공연 둘러보기</a></button>  
		        </p>
                </body>
                </html>';
		}

		
	?>
	</div>
</body>
</html>