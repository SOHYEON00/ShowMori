<?
$conn = mysqli_connect("localhost","root","0204","world");

	if($conn->connect_error){
		printf("Connect failed: %s",$conn->connect_error);
		exit();
	}
?>