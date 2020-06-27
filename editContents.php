<!-- 후원 정보 수정 화면 및 기능 -->
<?
	include './dbconn.php';
	session_start();


	$dprm = $_GET['dprm'];
	$title = $_GET['chk_title'];
	$get_reward = $_GET['reward'];
	$date = $_GET['bookDate'];
	$userid = $_SESSION['userid'];

	// string으로 받은 form_value값 int로 바꾸는 switch문
	switch ( $get_reward ) {
		  case 'reward1':
		    $money=20000;
		    break;
		  case 'reward2':
		   $money=30000;
		    break;
		  case 'reward3':
		    $money=40000;
		    break;
		  case 'reward4':
		   $money=50000;
		    break;
	}


	//후원 정보 수정 쿼리문 
	$q_updateDo = "UPDATE D_INFO_T SET D_MONEY='".$money."',D_DATE='".$date."' WHERE D_PRM='".$dprm."';";
	$r_updateDo = mysqli_query($conn,$q_updateDo);


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
		            <span >후원 정보가 변경되었습니다.</span>
		            <button id="getShowInfo_btn"><a href="./main_page.html"> 다른 공연 둘러보기</a></button>  
		        </p>
                </body>
                </html>';
mysqli_close($conn);

?>