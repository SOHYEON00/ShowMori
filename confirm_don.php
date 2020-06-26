<!-- INSERT INTO D_INFO_t -->
<?
session_start();
include './dbconn.php';

$userid = $_SESSION['userid'];
$title = $_GET['chk_title'];
$money = $_GET['sel_money'];
$date = $_GET['bookDate'];

//쇼 정보 겟
$q_getS = "SELECT S_PRM FROM POST_T WHERE S_TITLE='".$title."';";
$r_getS = mysqli_query($conn,$q_getS);
$row_getS = mysqli_fetch_array($r_getS);

$sprm = $row_getS['S_PRM'];


$q_insert = "INSERT INTO D_INFO_T(S_PRM,ID,D_MONEY,D_DATE) VALUES('".$sprm."','".$userid."','".$money."','".$date."');";
$r_insert = mysqli_query($conn,$q_insert);

		echo'
        <html>
        <head>
        <!-- print header -->
          <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
          <link rel="stylesheet" href="./donation_page.css?after"/>
          <script type="text/javascript">

          //페이지가 로드되면 실행한다.
          $(document).ready( function() {

            $("#header").load("header.php");
          });

          </script>
        </head>
        <body>
			<style>
        @import url("https://fonts.googleapis.com/css2?family=Nanum+Brush+Script&t&family=Nanum+Gothic:wght@800&display=swap");
     	#contents{
            position: relative;
            width:600px;
            height:100px;
            top: 10%;
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
            <span >후원에 성공했습니다.</span>
            <button id="getShowInfo_btn"><a href="./main_page.html"> 다른 포스트 둘러보러 가기</a></button>  
        </p>
        </body>
        </html>
		';
        mysqli_close($conn);

?>