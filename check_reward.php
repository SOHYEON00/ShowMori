<!-- 리워드 프린트 -->
<meta charset="UTF-8">
<?
	include './dbconn.php';


	$vvalue = $_REQUEST['s_value'];
	$money=0; //변수선언

	//선택한 리워드에 따른 후원금액 변경 string으로 받은 form_value값 int로 바꾸는 switch문
	switch ( $vvalue ) {
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
	echo "선택하신 후원 금액 :'".$money."'<br>";

	//query for get reward
	$q_reward = "SELECT D_REWARD FROM REWARD_T WHERE D_MONEY<='".$money."';";
	$r_reward = mysqli_query($conn,$q_reward);
	echo "예상 리워드 :";

	while($row_reward=mysqli_fetch_array($r_reward)){
				echo"'".$row_reward['D_REWARD']."';";
	}
	
	mysqli_close($conn);
?>