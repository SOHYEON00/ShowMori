<?
try{
   $conn = mysqli_connect("localhost","root","0204","showmori");
}
catch(Exception $ex)
{
   echo "connect failed";
   echo $ex->getMessage()."<br>";
   exit();
}

?>