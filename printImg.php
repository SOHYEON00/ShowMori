<? 
include './dbconn.php';
	
	$qInfo = "SELECT S_TITLE,S_POSTER,S_GOALSUM,S_DEADLINE from post_t INNER JOIN S_INFO_T ON POST_T.S_PRM=S_INFO_T.S_PRM;";
	$rPoster = mysqli_query($conn,$qInfo);

	
	while($row =mysqli_fetch_array($rPoster)){
		$title = $row['S_TITLE'];
		$goalSum = $row['S_GOALSUM'];
		$deadLine = $row['S_DEADLINE'];

		echo "
			<td>
			<img src='./data/IMG/".$row['S_POSTER']."'/>
			<p id='s_title'>$title</p>
			<p class='t_content'>펀딩현황 <a>$goalSum</a></p>
			<p class='t_content'>마감날짜 <a>$deadLine</a></p>		
			</td>";
	
	}
mysqli_close($conn);															
?>

