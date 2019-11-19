<?php

$con = mysqli_connect('localhost', 'root', '');

mysqli_select_db($con, 'hotelmanagement');

$sql1 = 'SELECT * FROM rooms WHERE room_type = "Delux Room"';
$sql2 = 'SELECT * FROM rooms WHERE room_type = "Premier Room"';
$sql3 = 'SELECT * FROM rooms WHERE room_type = "Club Room"';
$sql4 = 'SELECT * FROM rooms WHERE room_type = "Orchid Suite"';

$record1 = mysqli_query($con, $sql1);
$record2 = mysqli_query($con, $sql2);
$record3 = mysqli_query($con, $sql3);
$record4 = mysqli_query($con, $sql4);

?>



<html lang="en">
<head>
    <meta charset="utf-8" />
    <title> Tabs</title>

<style>

body {
    padding: 20px;
}
.title{
    font-family: sans-serif;
    color: #dc2d5e;
    text-align: center;
}

.tabContainer{
    width: 100%;
    height: 350px;
}

.tabContainer .buttonContainer{
    height: 15%;
}

.tabContainer .buttonContainer button {
        width: 25%;
        height: 100%;
        float: left;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 10px;
        font-family: sans-serif;
        font-size: 18px;
        background-color: #eee;
    }

    .tabContainer .buttonContainer button:hover{
        background-color: #d7d4d4;
    }

    .tabContainer .tabPanel{
        height: 85%;
        background-color: grey;
        color: white;
        text-align: center;
        padding-top: 105px;
        box-sizing: border-box;
        font-family: sans-serif;
        font-size: 22px;
        display: none;

    }

	        .content-table{
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 24px;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);

        }

        .content-table thead tr{
            background-color: #009979;
            color: #ffffff;
            font-weight: bold;
            text-align: left;


        }

        .content-table th,
        .content-table td{
            padding: 12px 15px;
        }
       
        .content-table tbody tr{
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-last-of-type(even){
            background-color: #f3f3f3;
        }

        .content-table tbody tr:last-of-type{
            border-bottom: 2px solid #009879;
        }

</style>

</head>

<body>
    <h1 class="title">Tabs</h1>
    <div class="tabContainer">
        <div class="buttonContainer">
            <button onclick="showPanel(0,'#f44336')">Delux Room</button>
            <button onclick="showPanel(1,'#4caf50')">Premier Room</button>
            <button onclick="showPanel(2,'#2196f3')">Club Room</button>
            <button onclick="showPanel(3,'#ff5722')">Orchid Suite</button>
        </div>

        <div class="tabPanel">
		<table class="content-table">
        <thead>
            <tr>
                <th>Room Id</th>
                <th>Bedding Type</th>
                <th>Place</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while($rooms = mysqli_fetch_assoc($record1))
		{
			echo"<tr>
					<td>".$rooms['id']."</td>
					<td>".$rooms['bedding_type']."</td>
					<td>".$rooms['place']."</td>
					<td>".$rooms['cusid']."</td>
				</tr>";
		}
		?>
        </tbody>
		</table>
		</div>

        <div class="tabPanel">
		<table class="content-table">
        <thead>
            <tr>
                <th>Room Id</th>
                <th>Bedding Type</th>
                <th>Place</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while($rooms = mysqli_fetch_assoc($record2))
		{
			echo"<tr>
					<td>".$rooms['id']."</td>
					<td>".$rooms['bedding_type']."</td>
					<td>".$rooms['place']."</td>
					<td>".$rooms['cusid']."</td>
				</tr>";
		}
		?>
        </tbody>
		</table>
		</div>

        <div class="tabPanel">
		<table class="content-table">
        <thead>
            <tr>
                <th>Room Id</th>
                <th>Bedding Type</th>
                <th>Place</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while($rooms = mysqli_fetch_assoc($record3))
		{
			echo"<tr>
					<td>".$rooms['id']."</td>
					<td>".$rooms['bedding_type']."</td>
					<td>".$rooms['place']."</td>
					<td>".$rooms['cusid']."</td>
				</tr>";
		}
		?>
        </tbody>
		</table>
		</div>
        <div class="tabPanel">
		<table class="content-table">
        <thead>
            <tr>
                <th>Room Id</th>
                <th>Bedding Type</th>
                <th>Place</th>
                <th>Customer ID</th>
            </tr>
        </thead>
        <tbody>
		<?php
		while($rooms = mysqli_fetch_assoc($record4))
		{
			echo"<tr>
					<td>".$rooms['id']."</td>
					<td>".$rooms['bedding_type']."</td>
					<td>".$rooms['place']."</td>
					<td>".$rooms['cusid']."</td>
				</tr>";
		}
		?>
        </tbody>
		</table>
		</div>
    </div>

<script type="text/javascript">

var tabButtons = document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanels = document.querySelectorAll(".tabContainer .tabPanel");

function showPanel(panelIndex, colorCode) {
    tabButtons.forEach(function (node) {
        node.style.backgroundColor = "";
        node.style.color = "";
    });

    tabButtons[panelIndex].style.backgroundColor = colorCode;
    tabButtons[panelIndex].style.color = "white";
    tabPanels.forEach(function (node) {
        node.style.display = "none";
    });

    tabPanels[panelIndex].style.display = 'block';
    tabPanels[panelIndex].style.backgroundColor = colorCode;
}

</script>        
</body>
</html>