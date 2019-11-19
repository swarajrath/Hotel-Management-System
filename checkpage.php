<?php
$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');


$tdate = date("Y-m-d");
$datetime = new DateTime('tomorrow');

?>

<html>
<head>
	<title> User Login And Registration </title>

	<link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

	<style>

	body{
	background: linear-gradient(rgba(0, 0, 50, 5), rgba(0, 0, 50, 0.5)), url(images/image.jpg);
	background-size: cover;
	background-position: center;
	}


	.login-left{
	background: rgba(211, 211, 211, 0.5);
	padding: 35px;
	max-width: 700px;
	position: relative;
	top: 100px;
	left: 300px;
	}


	.form-control{
	background-color: transparent;
	} 

	a{
	color: #fff ;
	margin-top: -200px !important;
	}

	h1{
	color: #fff !impportant;
	margin-top: 200px !important;
	text-align: center;
	text-transform: uppercase;
	}

	</style>

	</head>

	<body>


	<div class="login-left">
	<div class="col-md-6">
	<form action="" method="post">

	<h2> Check Availability </h2>

	<h2> Booking Details </h2>
	<div class="form-group">
	<label> Room Type </label>
	<select class="form-control" name="rtype">
	<option value='Deluxe Room'>Deluxe Room</option>
	<option value="Premier Room">Premier Room</option>
	<option value="Club Room">Club Room</option>
	<option value="Orchid Suite">Orchid Suite</option>
	</select>


	<div class="form-group">
	<label> Enter Check-in Date </label>
	<input type="date" name="c_in" class="form-control" min="<?php echo $tdate; ?>" required>
	</div>

	<div class="form-group">
	<label> Enter Check-out Date </label>
	<input type="date" name="c_out" class="form-control" min="<?php echo $datetime->format('Y-m-d'); ?>" required>
	</div>	

	<button type="submit" name="submit" class="btn btn-primary"> Check Availability </button>

	</form>
	</div>
	</div>


	<?php

	if(isset($_POST['submit']))
	{
	if(isset($_POST['rtype'], $_POST['c_in'] , $_POST['c_out']))
	{
	$room_type = $_POST['rtype'];
	$cin = $_POST['c_in'];
	$cout = $_POST['c_out'];

	$query = "SELECT COUNT(*) AS total
		FROM
    room
	WHERE
	room_type = '$room_type' AND
	room.room_no not in 
	(
    SELECT
      room_date.room_no
    FROM
      room_date
    WHERE
      (room_date.check_in<='$cin' and room_date.check_out>='$cin')
      OR
      (room_date.check_in<'$cout' and room_date.check_out>='$cout')
      OR
      (room_date.check_in>='$cin' and room_date.check_out<'$cout')
   )";

	$result = mysqli_query($link, $query);
	$value = mysqli_fetch_assoc($result);
	$number = $value['total'];



	echo "Hurry Up, Only {$number} room left";
		echo"<a href='book.php?c_in=$cin&c_out=$cout&typer=$room_type'>Continue Booking</a>";

	}
	}

	?>

	</body>

	</html>