<!-- db안의 데이터 출력-->

<?
include './dbconn.php';

	$tmpfile = $_FILES['userfile']['tmp_name'];
	$o_name = $_FILES['userfile']['name'];
	$filename = iconv("UTF-8","EUC-KR",$_FILES['userfile']['name']);
	$folder = "C:/mysql-8.0.19-winx64/data/showmori/".$filename;
	move_uploaded_file($tmpfile,$folder);

	$qId = "SELECT * FROM test_img";
	$rId = mysqli_query($conn,$qId);
	$numId = mysqli_num_rows($rId);

	$newId = $numId +1;


	$query = "INSERT INTO test_img (id,img) VALUES ('".$newId."','".$o_name."')";
	$result = mysqli_query($conn,$query);
	echo "<script>alert('파일 업로드 완료');</script>";

	
	$q = "select * from test_img";
	$r = mysqli_query($conn,$q);

	while($row =mysqli_fetch_array($r)){
		echo "
		<table>
			<tr>
			<td>$row[id]</td>
			<td><img src='./IMG/".$row['img']."'width=400,height=400></td>
			</tr>
		</table>
		";
	}

	mysqli_close($conn);

?>