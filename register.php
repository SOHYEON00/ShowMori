<?
	include './dbconn.php';

	$id = $_POST['user_id'];
	$pw = $_POST['user_password'];

	$query = "SELECT * FROM test where id ='$id'";
	$result = mysqli_query($conn,$query);
	$row_num = mysqli_num_rows($result);
	
	if($row_num ==0){
		$query2 = "INSERT INTO test VALUES ('$id','$pw')";
		mysqli_query($conn,$query2);
		echo "<script>alert('회원가입 완료'); location.href='./main2.php'</script>";
		
	}
	else{
		echo"<script>
			alert('해당 아이디가 존재합니다.');
			location.href = './index.html';
		</script>";
	}
?>