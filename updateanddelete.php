<html>

<head>
	<title>The Bliss - We Got Your Event</title>
	<link rel="icon" href="Images/WEB logo.png" type="image/gif"> 		<!--icon next to the title-->
	<link rel="stylesheet" type="text/css" href="The Bliss.css">
	<script language="javascript" type="text/javascript" src="The Bliss.js"></script>
</head>

<body bgcolor="#eed4ff">

<?php

$servername = "localhost";
$user = "root";
$pw = "";
$db = "TheBliss";

$connection = mysqli_connect($servername, $user, $pw, $db);			/*connecting the database*/

if(!$connection)
{
	die("Connection failed: " .mysqli_connect_error());
}

if(isset($_POST['update']))										/*if update button is clicked*/
{				
	$qty = $_POST["quantity"];
	$cid =$_POST["cartid"];
	$pprice = $_POST["productprice"];

	$totalprice = $pprice * $qty;

	$updatequery = "UPDATE cart SET qty=$qty, totalprice=$totalprice WHERE cid=$cid";
	$output = mysqli_query($connection,$updatequery);

	if($output)
	{
		echo "<center>
				<div>
					<img src='Images/WEB logo.png' width='250px' height='250px'>
				</div>
		
				<div style='background-color:black; 
				font-family:trebuchet ms; 
				font-size:40px;
				color:#f1f1f1;
				padding:5px;
				margin-top:20px;
				border-radius:30px;
				width:65%;'>
					Your cart has been updated successfully!
				</div>
			</center>";
	}
}

else if(isset($_POST['delete']))
{
	$cid =$_POST["cartid"];
	
	$deletequery = "DELETE FROM cart WHERE cid=$cid";

	if(mysqli_query($connection, $deletequery))
	{
		echo "<center>
				<div>
					<img src='Images/WEB logo.png' width='250px' height='250px'>
				</div>
		
				<div style='background-color:black; 
				font-family:trebuchet ms; 
				font-size:40px;
				color:#f1f1f1;
				padding:5px;
				margin-top:20px;
				border-radius:30px;
				width:65%;'>
					Item has been removed from your cart
				</div>
			</center>";
	}
}

?>

<center>
	<div>
		<input type="button" name="redirect" value="Back to cart" id="submitButton" class="bothButtons" onclick="Payment()" style="font-size:35px; margin-top:50px; border-radius:5px;">
	</div>
</center>


</body>

</head>