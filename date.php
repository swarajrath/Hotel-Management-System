<?php
$tdate = date("Y-m-d");
echo $tdate;

$datetime = new DateTime('tomorrow');
$datetime->format('Y-m-d');
echo $datetime
?>