<?
        include './dbconn.php';

        $title = $_GET['title'];
        $fileSynop = $_GET['fileSynop'];
        $filePoster = $_GET['filePoster'];
        $startDate = $_GET['startDate'];
        $lastDate = $_GET['lastDate'];
        $deadLine = $_GET['deadLine'];
        $goalSum = $_GET['goalSum'];


        $q_insert = "INSERT INTO POST_T(U_PRM, S_POSTER,S_SYNOP,S_TITLE,S_DEADLINE,START_DAY,LAST_DAY,S_GOALSUM ) VALUES(1,'".$filePoster."','".$fileSynop."','".$title."','".$deadLine."','".$startDate."','".$lastDate."','".$goalSum."'); ";
        $r_insert = mysqli_query($conn,$q_insert);

      
echo'<html>
<head>
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">
//페이지가 로드되면 실행한다.
$(document).ready( function() {
    $("#header").load("header.html");
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
</style>
</head>
<body>
<div id="header"></div>
<p >
    <span >포스트 등록을 성공했습니다!</span>
    <input type="button" onClick=location.href("s_info_page.html") value="내가 올린 글 보러 가기" id="getShowInfo_btn"></button>  
</p>    
</body>
</html>';
mysqli_close($conn);
?>