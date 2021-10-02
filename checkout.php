<html>

<head>
	<title>The Bliss - We Got Your Event</title>
	<link rel="icon" href="Images/WEB logo.png" type="image/gif"> 		<!--icon next to the title-->
	<link rel="stylesheet" type="text/css" href="The Bliss.css">
	<script language="javascript" type="text/javascript" src="The Bliss.js"></script>
	
	<style>
	
		#labels					/*1st columns*/
		{
			height:60px;
			color:black;
			font-size:22px;
			font-family:trebuchet ms;
			font-weight:bold;
			padding-left:8px;
		}

		#textboxes				/*2nd columns*/
		{
			font-size:17px;
			width:260px;
			font-family:trebuchet ms;
			padding:8px;
		}
	</style>
</head>

<body>

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

$selectqry = "SELECT * from cart";
$result=mysqli_query($connection,$selectqry);
					
if(mysqli_num_rows($result)==0)
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
					Your cart is empty!
				</div>
			</center>";
?>
			<center>
				<div>
					<input type="button" name="redirect" value="Continue Shopping" id="submitButton" class="bothButtons" onclick="Home()" style="font-size:35px; margin-top:50px; border-radius:5px;">
				</div>
			</center>
<?php
}

else
{
?>
<table width="100%">
	<tr>
		<td><img src="Images/WEB logo.png" width="130px" height="130px" style="padding:10px;"></td>
		<td width="80%"><font style="margin-left:280px; background-color:black; color:white; border-radius:40px; padding:15px; font-family:trebuchet ms; font-size:30px; font-weight:bold;">Enter shipping details!</font></td>
	</tr>
</table>

<center>
	<div>

		<form name="checkout" method = "POST" action = "http://localhost/TheBliss/order.php">			<!--COLLECTING SHIPPING DETAILS-->
			<table>
					
				<tr>
					<td width="280px" id="labels">First Name</td>												<!--First name-->
					<td><input type="text" name="fname" placeholder="Enter First Name" id="textboxes"></td>
				</tr>
				<tr>
					<td id="labels">Last Name</td>																<!--User name-->
					<td><input type="text" name="lname" placeholder="Enter Last Name" id="textboxes"></td>
				</tr>
				<tr>
					<td id="labels">Address</td>																<!--address-->
					<td><input type="text" name="address" placeholder="Enter address" id="textboxes"></td>
				</tr>
				<tr>
					<td id="labels">E-mail</td>																	<!--email-->
					<td><input type="email" name="mail" placeholder="Enter E-mail" id="textboxes"></td>
				</tr>
				<tr>
					<td id="labels">Phone</td>																	<!--phone number-->
					<td><input type="text" name="phone" placeholder="Enter Phone" id="textboxes"></td>
				</tr>
				<tr>
					<td id="labels">Description</td>															<!--description-->
					<td><textarea name="description" rows=5 placeholder="Description if any (eg:- number candles for age 12)" id="textboxes"></textarea></td>
				</tr>
							
				<tr>
					<td colspan=2 align="center">
						<input type="submit" name="submit" value="Place Order" id="submitButton" class="bothButtons">
						<input type="reset" name="cancel" value="Cancel" id="cancelButton" class="bothButtons">
					</td>
				</tr>
			</table>
		</form>
		
		
			<table>
					<tr>
						<?php	
							if(mysqli_num_rows($result)>0)
							{
								while($row=mysqli_fetch_assoc($result))
								{
						?>
									<td style="padding:10px;">
										<img src="<?php echo $row["pimage"]; ?>" width="180px" height="180px">
									</td>
						<?php
								}
							}
						?>
					</tr>
							
			</table>
		

	</div>
</center>

<?php
}
?>

</body>

</html>