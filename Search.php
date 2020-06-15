<!-- 조건에 맞는 데이터 출력-->
<!doctype html>
<html>
<!-- print header -->
<head>
  <link rel="stylesheet" type="text/css" href="./login.css">
  <link rel="stylesheet" type="text/css" href="./post.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>

<script type="text/javascript">

//페이지가 로드되면 실행한다.
$(document).ready( function() {

  $("#header").load("header.html");
});
</script>


<body>
<link rel="stylesheet" href="./main_page.css"/>
<link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Do+Hyeon&family=Nanum+Brush+Script&family=Nanum+Gothic:wght@800&display=swap" rel="stylesheet">

<div id="header"></div> 
<div id="body">

<!-- print posters -->
<table id="tname" name="tname">
<?
	include './dbconn.php';

	//입력한 텍스트 변수로 받아 검색
	$text = $_POST["srchTxt"];
	$qSrch = "SELECT * FROM POST_T WHERE S_TITLE LIKE '%$text%'";
	$rSrch = mysqli_query($conn,$qSrch);
	$nDate = date('Y-m-d');
	$cnt=1;

	while($row=mysqli_fetch_array($rSrch)){
		$title = $row['S_TITLE'];//공연제목
		$show_p = $row['S_PRM']; //POST_T.S_PRM

		//GET SUM(D_MONEY) BY BACKING
		$qSumMoney = "SELECT S_PRM, sum(d_money) as sum from d_info_t WHERE S_PRM='".$show_p."';";
		$rSumMoney = mysqli_query($conn,$qSumMoney);
		$row2 = mysqli_fetch_array($rSumMoney);

		$leftSum = ($row['S_GOALSUM']-$row2['sum']);//goalsum - donated sum
		$leftDate = intval((strtotime($row['S_DEADLINE'])-strtotime($nDate)) / 86400);
		//deadline - today

		$percentage =round($row2['sum']/$row['S_GOALSUM'],2);

	
		if($cnt%4==1){
			echo"
				<tr>
				<td>
				<a href='./s_info_page.html'><img src='./data/IMG/".$row['S_POSTER']."'/></a>
				<a href='./s_info_page.html'><p id='s_title'>$title</p></a>
				<p class='t_content'>$leftSum 남음
					&nbsp;&nbsp;
					$percentage %</a>
				</p>	
				<p class='t_content'>마감
					&nbsp;&nbsp;&nbsp;&nbsp;
				 	<a>D-$leftDate day</a>
				 </p>		
				</td>
				";
				$cnt++;
		}
		 else if($cnt%4==0){
			echo"<td>
				<a href='./s_info_page.html'><img src='./data/IMG/".$row['S_POSTER']."'/></a>
				<a href='./s_info_page.html'><p id='s_title'>$title</p></a>
				<p class='t_content'>$leftSum 남음
					&nbsp;&nbsp;
					$percentage %</a>
				</p>	
				<p class='t_content'>마감
					&nbsp;&nbsp;&nbsp;&nbsp;
				 	<a>D-$leftDate day</a>
				 </p>		
				</td>
				</tr>";
				$cnt++;
		}
		else{
			echo"<td>
				<a href='./s_info_page.html'><img src='./data/IMG/".$row['S_POSTER']."'/></a>
				<a href='./s_info_page.html'><p id='s_title'>$title</p></a>
				<p class='t_content'>$leftSum 남음
					&nbsp;&nbsp;
					$percentage %</a>
				</p>	
				<p class='t_content'>마감
					&nbsp;&nbsp;&nbsp;&nbsp;
				 	<a>D-$leftDate day</a>
				 </p>		
				</td>";
				$cnt++;
			}
	}//print info of show -tuples from DB
	mysqli_close($conn);
?>

</table>



