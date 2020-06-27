<!-- 펀딩 내역 수정 및 삭제 기능 구현 -->
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


		if($func=='수정'){ //hidden버튼을 통한 값 넘기기 
			echo '
			<form method="GET" action="editContents_fund.php">
			<input type="hidden" name="sprm" value="'.$sprm.'">

			<style>
		        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
		        #contents{
		            position: relative;
		            width:600px;
		            height:100px;
		            top:30%;
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
		            <span >정말 포스트 정보를 수정하시겠습니까?</span>
		           <input id="getShowInfo_btn" type="submit" value="수정하기">
		        </p>

			</form>
			';

		}
		if($func=='삭제'){

			echo "<script>alert('정말 펀딩을 취소하시겠습니까? (해당 공연의 후원이 전체 취소됩니다.)');</script>";
			 
			 //게시글(펀딩)삭제 쿼리문
			 $q_delFund = "DELETE FROM D_INFO_T WHERE S_PRM='".$sprm."';";
	         $q_delFund .= "DELETE FROM s_date_t WHERE S_PRM='".$sprm."';";
	         $q_delFund .= "DELETE FROM post_t WHERE S_PRM='".$sprm."';";
	         $r_delFund = mysqli_multi_query($conn,$q_delFund);

	         //삭제가 제대로 이뤄졌는지 확인차 검색
	         $q_chk = "SELECT S_PRM FROM POST_T WHERE S_PRM='".$sprm."';";
	         $r_chk = mysqli_query($conn,$q_chk);

	        //삭제에 실패한 경우=검색 결과가 null이 아닌 경우
			if($r_chk){ echo "<script>alert('펀딩 취소에 실패했습니다.');</script>"; return;}

			//삭제에 성공한 경우
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
		            top: 15%;
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
		            <span >펀딩이 취소되었습니다.</span>
		            <button id="getShowInfo_btn"><a href="./main_page.html"> 다른 공연 둘러보기</a></button>  
		        </p>
                </body>
                </html>';
		}

		mysqli_close($conn);
	?>
	</div>
</body>
</html>
