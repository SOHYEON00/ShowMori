
<?
include './dbconn.php';

	$q = "SELECT * FROM POST_T";
	$r = mysqli_query($conn,$q);

	while($row =mysqli_fetch_array($r)){
		echo "
		<table>
			<tr>
			<td>$row[S_POSTER]</td>
			<td><img src='./data/IMG/".$row['S_POSTER']."'width=50,height=800></td>
			</tr>
		</table>
		";
	}
mysqli_close($conn);
?>
