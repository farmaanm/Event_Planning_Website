<html>

<head>
	<title>The Bliss - We Got Your Event</title>
	<link rel="icon" href="Images/WEB logo.png" type="image/gif"> 		<!--icon next to the title-->
	<link rel="stylesheet" type="text/css" href="The Bliss.css">
	<script language="javascript" type="text/javascript" src="The Bliss.js"></script>
</head>

<body>

	<div class="fixedHead">
	<table>
        <tr>
			<td align="center" width="500px">
				<img src="Images/delivery.png" width="40px" height="40px">
			</td>
			<td width=300px align="right">
			    <h2 style="font-family:papyrus; color:#68118a; font-weight:bold; font-size:35px;"> The Bliss </h2>
			</td>
			<td align="center" width="500px">
				<img src="Images/WEB logo.png" id="logo">
			</td>
			<td width=500px>
			   <h2 style="font-family:papyrus; color:#68118a; font-weight:bold; font-size:35px;"> We Got Your Event </h2>
			
			<td align="center" width="350px">
				<input type="button" name="payments" id="cart" style="background:url('Images/after cart.png');
																		height:40px;
																		width:40px;
																		border:0px;
																		cursor:pointer;
																		background-color:transparent;
																		background-size:cover;"onclick="Payment()">
			</td>
		</tr>
	</table>
	
	
		<div id="navigationBar">
			<button class="navButtons" onclick="Home()">Home</button>
			<button class="navButtons" onclick="Cakes()">Cakes</button>
			<button class="navButtons" onclick="FlowersDeco()">Flowers & Decoration</button>
			<button class="navButtons" onclick="PhotographyMusic()">Photography & Music</button>
			<button class="navButtons" onclick="CostumesMakeup()">Costumes & Makeup</button>
			<button class="navButtons" onclick="Gifts()">Gift Items</button>
			<button class="navButtons" onclick="Contact()">Contact us</button>
			<button class="navButtons" style="border-right:none;" onclick="About()">About</button>
		</div>
	</div>
	
	
	<div style="padding:30px;">
		
		<table border=0 width="100%" id="paymentTable">
			<tr style="height:130px;"></tr>
			<tr>
				<td colspan=6 class="cartHeads" style="font-size:30px; text-align:left;">My Cart</td>
			</tr>
			
			<tr>
				<td></td>
				<td class="cartHeads" style="text-align:left;" width="40%">Product</td>
				<td class="cartHeads" width="15%">Unit Price</td>
				<td class="cartHeads" width="15%">Remove</td>
				<td class="cartHeads" width="15%">Qty</td>
				<td class="cartHeads" width="15%">Price</td>
			</tr>
			
			<tr>
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
					
					
					
					/*****************************************************Adding to cart************************************************************************/
					
					$pcode = $_POST['sendpcode'];
	
					if(isset($pcode))
					{
						
						$inserttocart = "INSERT INTO Cart (pname,pimage,pprice,productid,qty,totalprice) SELECT pname,pimage,pprice,$pcode,1,pprice FROM Products Where pid=$pcode";	
						$final = mysqli_query($connection,$inserttocart);
					}
	
	
					/***********************************************************displaying the cart************************************************************/
					
					$selectqry = "SELECT * from cart";
					$result=mysqli_query($connection,$selectqry);
					
					$grandtotal=0;
					
					if(mysqli_num_rows($result)>0)
					{
						while($row=mysqli_fetch_assoc($result))
						{
				?>
							
						<form action="http://localhost/TheBliss/updateanddelete.php" method="post">
							<tr>
								<input type="hidden" name="cartid" value="<?php echo $row["cid"]; ?>">
								<input type="hidden" name="productprice" value="<?php echo $row["pprice"]; ?>">
								
								<td style="padding:10px;">
									<img src="<?php echo $row["pimage"]; ?>" width="180px" height="180px">
								</td>
						
								<td style="font-size:25px; font-family:trebuchet ms;">
									<?php echo $row["pname"]; ?>
								</td>
						
								<td align="center" style="font-size:25px; font-family:trebuchet ms;">
									<?php echo "Rs.".$row["pprice"]; ?>
								</td>
					
								<td align="center" width="100px">
									<button type="submit" name="delete" style="background-color:transparent; border-style:none; cursor:pointer;">
										<img src="Images/delete.png" height="35px" width="35px">
									</button>
								</td>
					
								<td align="center" style="font-size:25px; font-family:trebuchet ms;">
										<input type="number" name="quantity" value="<?php echo $row["qty"]?>" style="width:40px; font-size:20px;" min="1">
										<button type="submit" name="update" style="font-family:trebuchet ms; font-size:20px; border-style:none; border-radius:4px; background-color:#89a4e8; color:black; cursor:pointer; padding:5px;">UPDATE CART</button>
								</td>
						
								<td align="center" style="font-size:25px; font-family:trebuchet ms;">
									<?php echo "Rs." .$row["totalprice"]?>
								</td>
					
							</tr>
						</form>
				<?php
				
							$grandtotal = $grandtotal + $row["totalprice"];
						
						}	/*end of while loop*/
					}	/*end of if condition*/
					
				?>

							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td align="center" style="font-weight:bold; font-size:25px; font-family:trebuchet ms;">Sub-Total</td>
								<td align="center" style="font-weight:bold; font-size:25px; font-family:trebuchet ms;">Rs. <?php echo $grandtotal; ?></td>
							</tr>
						
							<tr>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<td></td>
								<form name="checkout" method="POST" action="http://localhost/TheBliss/checkout.php">
									
									<td align="center"><button type="submit" name="checkout" style="border-style:none; border-radius:4px; background-color:#1964b0; font-size:30px; font-family:trebuchet ms; font-weight:bold; padding:8px; cursor:pointer; margin-top:13px;">Checkout</button></td>
								</form>
							</tr>
						
						
						
				<?php
				
					mysqli_close($connection);
					
				?>
			</tr>
		
		</table>
	
	</div>
	
	<br>
	
	<div id="footerContainer">
	
		<div id="footerLink" style="width:18%; margin-left:40px; margin-bottom:-90px; padding-top:55px;">
			26, 15 St Anthoney's Rd,<br>Negombo 11500<br><br>+94 75 916 8916
		</div>
	
		<center>
			<div>
				<img src="Images/WEB logo.png" id="footerLogo">
			</div>
			<a id="footerLink" href="Contact.html">Contact us |</a>
			<a id="footerLink" href="About.html"> About</a>
		</center>
		
		<div style="width:10%; margin-left:82%; margin-top:-80px;">
			<a href="https://web.facebook.com/The-Bliss-103466258740385/"><button class="socialmedia" style="background-image:url('Images/facebook.png');"></button></a>
			<a href="https://www.instagram.com/the_bliss60/"><button class="socialmedia" style="background-image:url('Images/instagram.png');"></button></a>
			<a href="https://twitter.com/_The_Bliss_"><button class="socialmedia" style="background-image:url('Images/twitter.png');"></button></a>
			<a href="mailto: thebliss60@gmail.com"><button class="socialmedia" style="background-image:url('Images/gmail.png');"></button></a>
		</div>
		
	</div>
	
</body>
</html>