<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

$adminid = $_GET['aid'];

if(isset($_POST['uname'], $_POST['pass'], $_POST['opass'])){
$username = $_POST['uname'];
$pass = $_POST['pass'];
$old_pass = $_POST['opass'];
}

if(isset($_POST['change']))
	{
	$query = "select * from admin where username = '$username' && password = '$old_pass'";
	$result = mysqli_query($link, $query);
	$num = mysqli_num_rows($result);

	if($num == 1)
	{
	$query2 = "UPDATE admin set password='$pass' WHERE id='$adminid'";
	$result2 = mysqli_query($link, $query2);
	if($result2){
	echo"Password Changed Succefully";
	}
	else{
	echo"password not changed";
	}
	}
	else
	{
		echo"Old Username and password Incorrect";
	}
	}
	
?>

<html>
<head>
<title> Change Password </title>
</head>

<body>
<link rel="stylesheet" type="text/css" href="CSS/updatestyle.css">
<div class="body-content">
  <div class="module">
    <h1>Password Change</h1>
    <form class="form" action="" method="post">
	  <div>
	  <label> Enter Username</label>      
	  <input type="text" name="uname" value=""/>
	  </div>

	  <div>
	  <label> Enter Old Password </label>      
      <input type="password" name="opass" value=""/>
	  </div>


	  <div>
	  <label> Enter New Password </label>      
      <input type="password" name="pass" value=""/>
	  </div>

      </br></br></br>
      <input type="submit" value="Change Password" name="change" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>
