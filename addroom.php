<?php

$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

if(isset($_POST['room_num'], $_POST['troom'])){
$rno = $_POST['room_num'];
$roomt = $_POST['troom'];
}

if(isset($_POST['add'])){
$query = "insert into room (room_no, room_type) VALUES ('$rno','$roomt')";
$result = mysqli_query($link, $query);

if($result){
	echo"Add room successfully";
}else{
	echo"Add Failed";
}
}
?>

<head>
<title> New Room </title>
</head>

<body>
<link rel="stylesheet" type="text/css" href="CSS/updatestyle.css">
<div class="body-content">
  <div class="module">
    <h1>Add Room</h1>
    <form class="form" action="" method="post">
	  <div>
	  <label> Room Number </label>      
	  <input type="number" name="room_num" value=""/>
	  </div>

	  <div>
	  <label> Room Type </label>      
      <input type="text" name="troom" value=""/>
	  </div>

      </br></br></br>
      <input type="submit" value="Add Room" name="add" class="btn btn-block btn-primary" />
    </form>
  </div>
</div>

</body>

</html>
