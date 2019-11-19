<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');
$emp_id = $_GET['id'];

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

if(isset($_POST['update'])){
$query = "update employee set fullname='$fname', address='$address', phone='$phone', startdate='$start_date', salary='$salary', emptype='$emp_type', resigndate= '$resign_date'  where id='$emp_id'";
$result = mysqli_query($link, $query);
if($result){
	echo"update successful";
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
	  <label> Full Name </label>      
	  <input type="text" name="f_name" value="<?php echo $_GET['fn'] ?>"/>
	  </div>

	  <div>
	  <label> Address </label>      
      <input type="text" name="address" value="<?php echo $_GET['ad'] ?>"/>
	  </div>

	  <div>
	  <label> Phone </label>      
      <input type="text" name="phone" value="<?php echo $_GET['ph'] ?>"/>
	  </div>

	  <div>
	  <label> Start Date </label>      
      <input type="date" name="s_date" value="<?php echo $_GET['sdate'] ?>"/>
	  </div>

	  <div>
	  <label> Salary </label>      
      <input type="text" name="salary" value="<?php echo $_GET['sal'] ?>"/>
	  </div>

	  <div>
	  <label> Employment Type </label>      
      <input type="text" name="etype" value="<?php echo $_GET['empt'] ?>"/>
	  </div>

	  <div>
	  <label> Resign Date </label>      
      <input type="date" name="r_date" value="<?php echo $_GET['rdate'] ?>"/>
	  </div>


      </br></br></br>
      <input type="submit" value="Update Employee" name="update" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>