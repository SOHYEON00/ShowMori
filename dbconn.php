<?
try{
   $conn = mysqli_connect("localhost","root","0204","showmori");
}
catch(Exception $ex) //DB연결 불가 시 오류 메세지 처리
{
   echo "connect failed";
   echo $ex->getMessage()."<br>";
   exit();
}

?>