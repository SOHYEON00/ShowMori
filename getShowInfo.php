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


echo "포스트를 완성하였습니다.";



mysqli_close($conn);
?>