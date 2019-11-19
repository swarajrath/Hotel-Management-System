<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

if(isset($_POST['eid'], $_POST['uname'], $_POST['pass']))
{
$eid =  $_POST['eid'];
$uname = $_POST['uname'];
$pass = $_POST['pass'];
}

if(isset($_POST['add'])){
$query = "INSERT INTO admin (id, username, password) VALUES ('$eid', '$uname', '$pass')";
$result = mysqli_query($link, $query);
if($result){
	echo"Add Admin successfully";
}else{
	echo"Add Failed";
}
}
?>



<html>
<head>
<title> New Admin </title>
</head>

<body>
<link rel="stylesheet" type="text/css" href="CSS/updatestyle.css">
<div class="body-content">
  <div class="module">
    <h1>Add Admin</h1>
    <form class="form" action="" method="post">
	  <div>
	  <label> Employee ID </label>      
	  <input type="text" name="eid" value=""/>
	  </div>

	  <div>
	  <label> Username </label>      
      <input type="text" name="uname" value=""/>
	  </div>

	  <div>
	  <label> Password </label>      
      <input type="password" name="pass" value=""/>
	  </div>


      </br></br></br>
      <input type="submit" value="Add Admin" name="add" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>