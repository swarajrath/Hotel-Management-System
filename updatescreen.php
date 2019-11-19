<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');
$cus_id = $_GET['id'];

if(isset($_POST['f_name'], $_POST['l_name'], $_POST['email'], $_POST['nation'], $_POST['phone'], $_POST['troom'], $_POST['adults'], $_POST['child'], $_POST['c_in'], $_POST['c_out'], $_POST['a_time'], $_POST['r_num'], $_POST['status']))
{
$fname =  $_POST['f_name'];
$lname =  $_POST['l_name'];
$email = $_POST['email'];
$nation = $_POST['nation'];
$phone = $_POST['phone'];
$room_type = $_POST['troom'];
$adult = $_POST['adults'];
$children = $_POST['child'];
$checkin = $_POST['c_in'];
$checkout = $_POST['c_out'];
$atime = $_POST['a_time'];
$room_num = $_POST['r_num'];
$status = $_POST['status'];
}

if(isset($_POST['update'])){
$query = "update customer set first_name='$fname', last_name='$lname', email='$email',nationality='$nation',phone='$phone',room_type='$room_type',adult='$adult',children='$children',check_in='$checkin',check_out='$checkout',arrival_time='a_time',room_no='$room_num',status='$status'  where id='$cus_id'";
$result = mysqli_query($link, $query);
if($result){
	echo"update successful";
	header("refresh:1; url=Admin.php");
}else{
	echo"Update Failed";
}
}
?>

<html>
<head>
<title> Customer Update </title>
</head>

<body>
<link rel="stylesheet" type="text/css" href="CSS/updatestyle.css">
<div class="body-content">
  <div class="module">
    <h1>Update Customer</h1>
    <form class="form" action="" method="post">
	  <div>
	  <label> First Name </label>      
	  <input type="text" name="f_name" value="<?php echo $_GET['fne'] ?>"/>
	  </div>

	  <div>
	  <label> Last Name </label>      
      <input type="text" name="l_name" value="<?php echo $_GET['lne'] ?>"/>
	  </div>

	  <div>
	  <label> Email </label>      
      <input type="text" name="email" value="<?php echo $_GET['em'] ?>"/>
	  </div>

	  <div>
	  <label> Nationality </label>      
      <input type="text" name="nation" value="<?php echo $_GET['nan'] ?>"/>
	  </div>

	  <div>
	  <label> Phone </label>      
      <input type="text" name="phone" value="<?php echo $_GET['ph'] ?>"/>
	  </div>

	  <div>
	  <label> Room Type </label>      
      <input type="text" name="troom" value="<?php echo $_GET['rt'] ?>"/>
	  </div>

	  <div>
	  <label> Adult </label>      
      <input type="text" name = "adults" value="<?php echo $_GET['ad'] ?>"/>
	  </div>

	  <div>
	  <label> Children </label>      
      <input type="text" name="child" value="<?php echo $_GET['cd'] ?>"/>
	  </div>

	  <div>
	  <label> Check-In </label>      
      <input type="date" name="c_in" value="<?php echo $_GET['cin'] ?>"/>
	  </div>

	  <div>
	  <label> Check-Out </label>      
      <input type="date" name="c_out" value="<?php echo $_GET['cout'] ?>"/>
	  </div>

	  <div>
	  <label> Arrival Time </label>      
      <input type="time" name="a_time" value="<?php echo $_GET['at'] ?>"/>
	  </div>

	  <div>
	  <label> Room Number </label>      
      <input type="text" name="r_num" value="<?php echo $_GET['rno'] ?>"/>
	  </div>

	  <div>
	  <label> Status </label>      
      <input type="text" name="status" value="<?php echo $_GET['st'] ?>"/>
	  </div>

      </br></br></br>
      <input type="submit" value="Update Customer" name="update" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>