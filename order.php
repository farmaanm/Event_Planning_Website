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

$fname = $_POST["fname"];
$lname = $_POST["lname"];
$add = $_POST["address"];
$mail = $_POST["mail"];
$phone = $_POST["phone"];
$desc = $_POST["description"];

if($fname=="" || $lname=="" || $add=="" || $mail=="" || $phone=="")			/*validating the shipping details*/
{
?>
	<center>
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
			You have not entered all required fields<br>Please enter all fields and place the order
		</div>
	</center>
		
	<center>
		<div>
			<input type="button" name="redirect" value="Back" id="submitButton" class="bothButtons" onclick="window.location.href ='http://localhost/TheBliss/checkout.php';" style="font-size:35px; margin-top:50px; border-radius:5px;">
		</div>
	</center>

<?php
}

else if(strlen($phone)!=10 || !is_numeric($phone))		/*validating the phone number*/
{
?>
		<center>
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
			Incorrect phone number format<br>Please re-enter and place the order again
		</div>
	</center>
		
	<center>
		<div>
			<input type="button" name="redirect" value="Back" id="submitButton" class="bothButtons" onclick="window.location.href ='http://localhost/TheBliss/checkout.php';" style="font-size:35px; margin-top:50px; border-radius:5px;">
		</div>
	</center>
		
<?php		
}

else			/*entering details to the database*/
	
{

	$selectqry = "SELECT * from cart";
	$result=mysqli_query($connection,$selectqry);
					
	if(mysqli_num_rows($result)>0)		/*checking if the cart has 1 or more rows*/
	{
		$selectallorder = "SELECT * FROM orderproducts";
		$orderresult = mysqli_query($connection,$selectallorder);
		
		if(mysqli_num_rows($orderresult)==0)		/*checking if order table is empty, if tru, oid=1*/
		{
			$oid=1;
		}
		else
		{
			$selectmaxOID = "SELECT MAX(orderid) AS maxoid FROM orderproducts";		/*if order table not empty, selecting MAX value from orderid column*/
			$maxoidresult = mysqli_query($connection,$selectmaxOID);
			
			$oidrow = mysqli_fetch_array($maxoidresult);		/*fetching the row with MAX orderid*/
			
			
			$oid=$oidrow['maxoid'];		/*assigning max order id to a variable*/
			$oid++;
		}
		
		
		
		while($row=mysqli_fetch_assoc($result))		/*iterating the rows in the cart*/
		{
			$pid = $row["productid"];
			$qty = $row["qty"];
							
			$insertquery = "INSERT INTO orderproducts (orderid,fname,lname,address,email,phone,description, productid, qty) VALUES ('$oid','$fname', '$lname', '$add', '$mail', '$phone', '$desc', '$pid', '$qty')";
			$insertresult = mysqli_query($connection, $insertquery);
			
		}
	}
	
	if($insertresult)
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
						Order placed successfully!<br>
						Your order will be delivered within 3-4 days :)
				</div>
			</center>";
					
		$emptycart = "DELETE FROM cart";			/*emptying the cart after placing the order*/
		$deleteresult = mysqli_query($connection,$emptycart);
					
	}		

?>

	<center>
		<div>
			<input type="button" name="redirect" value="Continue Shopping" id="submitButton" class="bothButtons" onclick="Home()" style="font-size:35px; margin-top:50px; border-radius:5px;">
		</div>
	</center>

<?php
}
?>

</body>

</html>