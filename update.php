<?php
session_start();
$link = mysqli_connect('localhost','root','');
mysqli_select_db($link,'hotelmanagement');

$cid = $_GET['id'];
$troom = $_GET['rt'];
$title = $_GET['tit'];
$f_name = $_GET['fn'];
$l_name = $_GET['ln'];
$email = $_GET['em'];
$ch_in = $_GET['cin'];
$ch_out = $_GET['cout'];
$ro_num = $_GET['rnum'];
$adult = $_GET['ad'];
$children = $_GET['ch'];
$phone = $_GET['ph'];
$nationality = $_GET['na'];

if(isset($_POST['room_id'])){
$room_id = $_POST['room_id'];
}
?>

<html>
<head> <title> Beautiful Table </title>	</head>
<style>

body{
background: skyblue;
}

table{
	width: 600px;
	margin: auto;
	text-align: center;
	text-layout: fixed;
}

table, tr, th, td{
padding: 15px;
color: white;
border: 1px solid #080808;
border-collapse: collapse;
font-size: 18px;
font-family: Arial;
background: linear-gradient(top, #3c3c3c 0%, #222222 100%);
background: -webkit-linear-gradient(top, #3c3c3c 0%, #222222 100%);
}

.ghost-button {
    color: #009688;
    background: #fff;
    border: 1px solid #009688;
    font-size: 17px;
    padding: 7px 12px;
    font-weight: normal;
    margin: 6px 0;
    margin-right: 12px;
    display: inline-block;
    text-decoration: none;
    font-family: 'Open Sans', sans-serif;
    min-width: 120px;
}

.ghost-button:hover, .ghost-button:active {
  color:#fff;
  background:#009688;
}


</style>

<body>


<form method="post">
<table width="600" border="1" cellspacing="1">

    <tr>
	<th> DESCRIPTION </th>
	<th> INFORMATION </th>
	</tr>
	<tr>
	<th> Customer ID </th>
	<th> <?php echo $cid; ?> </th>
	</tr>
	<tr>
	<th> Full Name </th>
	<th> <?php echo $title.' '.$f_name.' '.$l_name; ?> </th>
	</tr>
	<tr>
    <th>Email</th>
	<th><?php echo $email; ?> </th>
	</tr>
	<tr>
    <th>Nationality</th>
	<th><?php echo $nationality; ?> </th>
	</tr>
	<tr>
    <th>Phone</th>
	<th><?php echo $phone; ?> </th>
	</tr>
	<tr>
    <th>Room Type</th>
	<th><?php echo $troom ?> </th>
	</tr>
	<tr>
    <th>Adults</th>
	<th><?php echo $adult; ?> </th>
	</tr>
	<tr>
	<tr>
	<th> Children </th>
	<th> <?php echo $children; ?> </th>
	<tr>
    <th> Check-in </th>
	<th><?php echo $ch_in; ?> </th>
	</tr>
	<tr>
    <th>Check-out</th>
	<th><?php echo $ch_out; ?> </th>       
    </tr>
	<tr>
	<th> Arrival Time </th>
	<th> <?php echo $_GET['atime']; ?> </th>
	<tr>

</table>

<select name="room_id">
<option> Select The Rooms </option>

<?php

$res=mysqli_query($link,"SELECT
    room.room_no
FROM
    room
WHERE
  room_type = '$troom' AND
  room.room_no not in 
  (
    SELECT
      room_date.room_no
    FROM
      room_date
    WHERE
      (room_date.check_in<='$ch_in' and room_date.check_out>='$ch_in')
      OR
      (room_date.check_in<'$ch_out' and room_date.check_out>='$ch_out')
      OR
      (room_date.check_in>='$ch_in' and room_date.check_out<'$ch_out')
   )");

if($res){
while($row=mysqli_fetch_array($res)){
$rid=$row['room_no'];
echo"<option>$rid<br></option>";
}
}

?>
</select>

<input type="submit" name="update" class="ghost-button" value="Accept"/>
<input type="submit" name="reject" class="ghost-button" value="Reject"/>
<input type="submit" name="checkin" class="ghost-button" value="checked-in"/>
<input type="submit" name="checkout" class="ghost-button" value="checked-out"/>

</form>

<?php



if(isset($_POST['update'])) 
{

$query = "INSERT INTO room_date(room_no, check_in, check_out, cus_id) VALUES ('$room_id', '$ch_in', '$ch_out', '$cid')";
$query2 = "update customer set status='Confirm', room_no='$room_id' where id='$cid'";
$result = mysqli_query($link, $query);

$result2 = mysqli_query($link, $query2);


$email_from = "swarajrath007@gmail.com";
$email_subject = "Booking Confirmation";
$email_body = "Hello $title $f_name.\n".
				"You have been approved to stay in our hotel at room no $room_id";

$to = "$email";
$headers = "From: Swaraj Rath <swarajrath007@gmail@gmail> \r\n";
$headers .= "Reply-To: swarajrath007@gmail.com \r\n";
$headers .= "Content-type: text/html \r\n";

mail($to, $email_subject, $email_body, $headers);


if($result){
	echo"Inserted Succefully";
	
	//echo "<script>window.close();</script>";
}
else {
	echo"Failed";
}
}

if(isset($_POST['reject'])){
$query6 = "DELETE from customer WHERE id='$cid'";
$result6 = mysqli_query($link, $query6);
if($result6){
	echo"Customer Succefully Rejected";

$email_from = "swarajrath007@gmail.com";
$email_subject = "Booking Cancellation";
$email_body = "Hello $title $f_name.\n".
				"Sorry, But at this moment all of our rooms have been completely filled.";

$to = "$email";
$headers = "From: Swaraj Rath <swarajrath007@gmail@gmail> \r\n";
$headers .= "Reply-To: swarajrath007@gmail.com \r\n";
$headers .= "Content-type: text/html \r\n";

mail($to, $email_subject, $email_body, $headers);

}else{
	echo"Failed to Reject";
}
}



if(isset($_POST['checkin'])){
$query3 = "update customer set status='Checked In' where id='$cid'";
$result3 = mysqli_query($link, $query3);
if($result3){
	echo"Customer Succefully Checked IN";
	header("refresh:1; url=Admin.php");
}else{
	echo"Failed to checkin";
}
}

if(isset($_POST['checkout'])){
$query4 = "update customer set status='Checked Out' where id='$cid'";
$query5 = "DELETE from room_date WHERE room_no='$ro_num'";
$result4 = mysqli_query($link, $query4);
$result5 = mysqli_query($link, $query5);
if($result5){
	echo"Customer Succefully Checked Out";
	echo"<a target='_blank' href='printbill.php?cuid=$cid&tit=$title&fna=$f_name&lna=$l_name&nan=$nationality&ph=$phone&rt=$troom&ad=$adult&ch=$children&chin=$ch_in&chout=$ch_out'>Bill Print</a>";

}else{
	echo"Failed to checkout";
}
}


?>


</body>

 </html>   