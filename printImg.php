<? 
include './dbconn.php';
	
	$qInfo = "SELECT S_TITLE,S_POSTER,S_GOALSUM,S_DEADLINE,S_PRM from post_t;";
	$rPoster = mysqli_query($conn,$qInfo);


	while($row=mysqli_fetch_array($rPoster)){
		$title = $row['S_TITLE'];//공연제목
		$show_p = $row['S_PRM']; //POST_T.S_PRM

		//GET SUM(D_MONEY) BY BACKING
		$qSumMoney = "SELECT S_PRM, sum(d_money) as sum from d_info_t WHERE S_PRM='".$show_p."';";
		$rSumMoney = mysqli_query($conn,$qSumMoney);
		$row2 = mysqli_fetch_array($rSumMoney);

		$leftSum = ($row['S_GOALSUM']-$row2['sum']);//goalsum - donated sum
		$leftdate = $row['S_DEADLINE']; 
		//deadline - today

		echo "
			<td>
			<a href='./s_info_page.html'><img src='./data/IMG/".$row['S_POSTER']."'/></a>
			<a href='./s_info_page.html'><p id='s_title'>$title</p></a>
			<p class='t_content'><a>$leftSum</a>남음</p>
			<p class='t_content'><a>$leftdate</a></p>		
			</td>";
	
	}//print info of show -tuples from DB
mysqli_close($conn);															
?>

