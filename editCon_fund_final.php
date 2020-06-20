<?
session_start();
include './dbconn.php';

$userid=$_SESSION['userid'];

$fileSynop = $_GET['fileSynop'];
$filePoster = $_GET['filePoster'];
$startDate = $_GET['startDate'];
$lastDate = $_GET['lastDate'];
$deadLine = $_GET['deadLine'];
$goalSum = $_GET['goalSum'];
$sprm = $_GET['sprm'];

		

        $q_chkUprm = "SELECT u_prm from user_t where id='".$userid."';";
        $r_chkUprm = mysqli_query($conn,$q_chkUprm);
        $row_chkUprm = mysqli_fetch_array($r_chkUprm);
        $uprm = $row_chkUprm['u_prm'];

        $q_upFund = "UPDATE POST_T SET S_POSTER='".$filePoster."',S_SYNOP='".$fileSynop."',S_GOALSUM='".$goalSum."',S_DEADLINE='".$deadLine."',START_DAY='".$startDate."',LAST_DAY='".$lastDate."' WHERE S_PRM='".$sprm."' AND U_PRM='".$uprm."';";
        $r_upFund = mysqli_query($conn,$q_upFund);

     
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
                p{
                    position: relative;
                    width:600px;
                    height:100px;
                    top: 30%;
                    background-color: #EAEAEA;
                    margin: 0 auto;
                    text-align: center;
                }
                p span{
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
                </head>
                <body>
                <div id="header"></div>
                 <p id="contents">
                    <span >공연 정보 수정에 성공했습니다!</span>
                    <button id="getShowInfo_btn"><a href="./writepostpage.html"> 다른 공연 게시하기</a></button>   
                </p>    
                </body>
                </html>';
        


mysqli_close($conn);
?>