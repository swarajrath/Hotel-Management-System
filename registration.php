<?php
session_start();
header('location:book.php');
$con = mysqli_connect('localhost','root','');

mysqli_select_db($con, 'hotelmanagement');

$title = $_POST['title'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email = $_POST['email'];
$nationality = $_POST['nation'];
$phone = $_POST['phone'];
$adult = $_POST['adult'];
$child = $_POST['children'];
$atime = $_POST['arrival_time'];

$checkin = $_GET['c_in'];
$checkout = $_GET['c_out'];
$type_room = $_GET['room_type'];



$reg = "insert into customer(title, first_name, last_name, email, nationality, phone, room_type, adult, children, check_in, check_out, arrival_time) values ('$title' , '$first_name' , '$last_name' , '$email' , '$nationality' , '$phone' , '$type_room' , '$adult' , '$child' , '$checkin' , '$checkout' , '$atime')";
$result = mysqli_query($con, $reg);

if($result){
echo" Registration Successful";
}
else{
echo"Failed";
}

?>