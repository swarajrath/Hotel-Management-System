<?php
$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

if(isset($_GET['c_in'], $_GET['c_out'], $_GET['typer'])){
$checkin = $_GET['c_in'];
$checkout = $_GET['c_out'];
$type_room = $_GET['typer'];
}

if(isset($_POST['title'], $_POST['fname'], $_POST['lname'], $_POST['email'], $_POST['nation'], $_POST['phone'], $_POST['adult'], $_POST['children'], $_POST['arrival_time'], $_POST['room_id']))
{
$title = $_POST['title'];
$first_name = $_POST['fname'];
$last_name = $_POST['lname'];
$email = $_POST['email'];
$nationality = $_POST['nation'];
$phone = $_POST['phone'];
$adult = $_POST['adult'];
$child = $_POST['children'];
$atime = $_POST['arrival_time'];
$roomid = $_POST['room_id'];
}


if(isset($_POST['submit'])){
$reg = "INSERT INTO customer (title, first_name, last_name, email, nationality, phone, room_type, adult, children, check_in, check_out, arrival_time, status, room_no) VALUES ('$title', '$first_name', '$last_name', '$email', '$nationality', '$phone', '$type_room', '$adult', '$child', '$checkin', '$checkout', '$atime', 'Checked In', '$roomid')";
$result = mysqli_query($link, $reg);
$query = "INSERT INTO room_date(room_no, check_in, check_out) VALUES ('$roomid', '$checkin', '$checkout')";
$result2 = mysqli_query($link, $query);

if($result){
echo" Registration Successful";
}
else{
echo"Failed";
}
}

?>

<html>
<head>
	<title> User Login And Registration </title>
	<link rel="stylesheet" type="text/css" href="CSS/bookstyle.css">
	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	
</head>

<body>
	<div class="container">
	<div class="login-box">
	<div class="row">
	<div class="col-md-6 login-left">
	<h2> Personal Information </h2>

	<form action="" method="post">

	<div class="form-group">
	<label> Title </label>
	<select class="form-control" name="title">
	<option value="Mr.">Mr.</option>
	<option value="Ms.">Ms.</option>
	<option value="Mrs.">Mrs.</option>
	<option value="Miss">Miss</option>
	<option value="Dr.">Dr.</option>
	</select>
	</div>


	<div class="form-group">
	<label><b> Firstname </b></label>
	<input type="text" name="fname" class="form-control" required>
	</div>

	<div class="form-group">
	<label> Last Name </label>
	<input type="text" name="lname" class="form-control" required>
	</div>
	
	<div class="form-group">
	<label> Email </label>
	<input type="email" name="email" class="form-control" required>
	</div>

	<div class="form-group">
	<label> Nationality </label>
	<input type="text" name="nation" class="form-control" required>
	</div>

	<div class="form-group">
	<label> Phone </label>
	<input type="text" name="phone" class="form-control" required>
	</div>


	</div>

		<div class="col-md-6 login-right">
		<h2> Booking Details </h2>

		<div class="form-group">
		<label> Adults </label>
		<input type="number" name="adult" max="2" class="form-control2" required>
		<label> Children </label>
		<input type="number" name="children" max="2" class="form-control2">
		</div>

		<div class="form-group">
		<label> Hotel Arrival Time </label>
		<input type="time" name="arrival_time" class="form-control" required>
		</div> 

		<select name="room_id">
		<option> Select The Rooms </option>

		<?php

		$res=mysqli_query($link,"SELECT
	  room.room_no
		FROM
	  room
		WHERE
		 room_type = '$type_room' AND
		 room.room_no not in 
		 (
		   SELECT
		     room_date.room_no
		   FROM
		     room_date
		   WHERE
		     (room_date.check_in<='$checkin' and room_date.check_out>='$checkin')
		     OR
		     (room_date.check_in<'$checkout' and room_date.check_out>='$checkout')
		     OR
		     (room_date.check_in>='$checkin' and room_date.check_out<'$checkout')
		  )");

		if($res){
		while($row=mysqli_fetch_array($res)){
		$rid=$row['room_no'];
		echo"<option>$rid<br></option>";
}
}

?>
</select>


	<input type="submit" name="submit" class="btn btn-primary"></button>
	</form>
	</div>


</div>
</div>
</div>
	
</body>
</html>