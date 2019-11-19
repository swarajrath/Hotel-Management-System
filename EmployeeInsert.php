<?php
session_start();
$con = mysqli_connect('localhost','root','');
mysqli_select_db($con,'hotelmanagement');


$fullname = $_POST['fname'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$start_date = $_POST['start_date'];
$salary = $_POST['salary'];
$emp_type = $_POST['emp_type'];
$resign_date = $_POST['resign_date'];


$sql = "INSERT INTO employee (fullname, address, phone, startdate, salary, emptype, resigndate) VALUES ('$fullname','$address','$phone','$start_date','$salary','$emp_type','$resign_date')";
$record = mysqli_query($con, $sql);

if($record){
echo"Insrted";
}
else{
echo"Not Inserted";
}


?>