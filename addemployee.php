<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

if(isset($_POST['f_name'], $_POST['address'], $_POST['phone'], $_POST['s_date'], $_POST['salary'], $_POST['etype'], $_POST['r_date']))
{
$fname =  $_POST['f_name'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$start_date = $_POST['s_date'];
$salary = $_POST['salary'];
$emp_type = $_POST['etype'];
$resign_date = $_POST['r_date'];
}

if(isset($_POST['add'])){
$query = "insert into employee (fullname, address, phone, startdate, salary, emptype, resigndate) VALUES ('$fname', '$address', '$phone', '$start_date', '$salary', '$emp_type', '$resign_date')";
$result = mysqli_query($link, $query);
if($result){
	echo"Add successfully";
}else{
	echo"Add Failed, Because the ID doesn't exist in the database";
}
}
?>



<html>
<head>
<title> New Employee </title>
</head>

<body>
<link rel="stylesheet" type="text/css" href="CSS/updatestyle.css">
<div class="body-content">
  <div class="module">
    <h1>Add Employee</h1>
    <form class="form" action="" method="post">
	  <div>
	  <label> Full Name </label>      
	  <input type="text" name="f_name" value=""/>
	  </div>

	  <div>
	  <label> Address </label>      
      <input type="text" name="address" value=""/>
	  </div>

	  <div>
	  <label> Phone </label>      
      <input type="text" name="phone" value=""/>
	  </div>

	  <div>
	  <label> Start Date </label>      
      <input type="date" name="s_date" value=""/>
	  </div>

	  <div>
	  <label> Salary </label>      
      <input type="text" name="salary" value=""/>
	  </div>

	  <div>
	  <label> Employment Type </label>      
      <input type="text" name="etype" value=""/>
	  </div>

	  <div>
	  <label> Resign Date </label>      
      <input type="date" name="r_date" value=""/>
	  </div>


      </br></br></br>
      <input type="submit" value="Add Employee" name="add" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>