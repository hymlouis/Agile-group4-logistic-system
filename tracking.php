<?php

require 'dbconfig/config.php';
	@$ShippingCode="";
	@$ShippingStatus="";
	@$SenderAddress="";
	@$ShippingAddress="";
	@$RecipientName="";

?>
<!DOCTYPE html>
<?php include('header.php');?>
<?php include('menu.php');?>
<html>
<head>
<title>Tracking Products</title>
<link rel="stylesheet" href="css/style.css">
</head>

	<br><br><br><br>
	<font size="5" face="Calibri">
	Track your order(s):
	<br><br>
	</font>
	
	<?php
		if(isset($_POST['search'])){
		
			$ShippingCode = $_POST['ShippingCode'];
			
			if($ShippingCode=="")
			{
				echo '<script type="text/javascript">alert("Please enter a Shipping Code.")</script>';
			}
			else
			{
				$query = "select ShippingCode,ShippingStatus,SenderAddress,ShippingAddress,RecipientName from shipping where ShippingCode=$ShippingCode";
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
						$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
						@$ShippingCode=$row['ShippingCode'];
						@$ShippingStatus=$row['ShippingStatus'];
						@$SenderAddress=$row['SenderAddress'];
						@$ShippingAddress=$row['ShippingAddress'];
						@$RecipientName=$row['RecipientName'];
					}
					else{
						echo '<script type="text/javascript">alert("Please enter a valid Shipping Code.")</script>';
					}
				}
				else{
					echo '<script type="text/javascript">alert("Error!")</script>';
				}
				
			}
			
		}
	?>

	<form action="tracking.php" method="post">
		
		<label><b>Search by Shipping Code: </b><br> 
		<input type="number" placeholder="Enter Shipping Code" name="ShippingCode" value="<?php echo @$_POST['ShippingCode'];?>">
		</label><button id="search_button" name="search" type="submit">Search</button><br><br>
		<label><b>Shipping Status: </b></label><br>
		<input type="text" name="ShippingStatus" value="<?php echo $ShippingStatus; ?>"><br><br>
		<label><b>Receiving from: </b></label><br>
		<input type="text" name="SenderAddress" value="<?php echo $SenderAddress; ?>"><br><br>
		<label><b>Destination: </b></label><br>
		<input type="text" name="ShippingAddress"value="<?php echo $ShippingAddress; ?>" ><br><br>
		<label><b>Recipient Name: </b></label><br>
		<input type="text" name="RecipientName" value="<?php echo $RecipientName; ?>">
		
	</form>

		
		</div>
	</div>
</body>
</html>