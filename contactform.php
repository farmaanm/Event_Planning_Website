<html>

<head>
	<title>The Bliss - We Got Your Event</title>
	<link rel="icon" href="Images/WEB logo.png" type="image/gif">
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
	$email = $_POST["email"];
	$subject = $_POST["subject"];
	$message = $_POST["message"];

if($fname=="" || $email=="" || $subject=="" || $message=="")			/*validating the contact form*/
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
			You have not entered all required fields<br>Please enter all fields and resubmit the form
		</div>
	</center>
		
	<center>
		<div>
			<input type="button" name="redirect" value="Back to Contact" id="submitButton" class="bothButtons" onclick="Contact()" style="font-size:35px; margin-top:50px; border-radius:5px;">
		</div>
	</center>
<?php
}

else
{
													/*Inserting data to CONTACT form*/
							
	$insertsql = "INSERT INTO contactform (name, email, subject, message) VALUES ('$fname', '$email', '$subject', '$message')";

	if(mysqli_query($connection,$insertsql))		/*if data is entered successfully*/
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
				Your message has been sent successfully!
			</div>
		</center>";
	}
	else											/*if data is NOT entered successfully*/
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
				Your message has not been sent :(<br>Please try resending the message
			</div>
		</center>";
	}

	mysqli_close($connection);
?>

	<center>
		<div>
			<input type="button" name="redirect" value="Back to Home" id="submitButton" class="bothButtons" onclick="Home()" style="font-size:35px; margin-top:50px; border-radius:5px;">
		</div>
	</center>

<?php
}
?>

</body>
</html>