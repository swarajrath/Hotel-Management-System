<?php
$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

$sql = "DELETE FROM employee WHERE id='$_GET[eid]'";
$record = mysqli_query($link, $sql);

if($record){
	header("refresh:1; url=Admin.php");
}
else{
	echo"Not Deleted";
}

?>