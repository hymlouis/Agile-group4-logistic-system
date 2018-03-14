<?php
require 'dbconfig/config.php';
@$ShippingStatus="";

?>

<!doctype html>
<?php include('header.php');?>
<?php include('menu2.php');?>
<html>
<head>
<meta charset="utf-8">
<title>Cargo</title>
<link rel="stylesheet" href="css/style.css">
</head>

<br><br><br><br>
<body>
<div id="shippingtext">
<center>
<?php
$query = "select * from shipping";
$query_run = mysqli_query($con,$query);

if(mysqli_num_rows($query_run)>0){
    echo "<table border = '1'>";
	echo "<tr><td>Shipping Code</td><td>Shipping Status</td><td>Sender Address</td><td>Shipping Address</td><td>Recipient Name</td><td>Customer ID</td><tr>";
    while($row = $query_run->fetch_assoc()) {
        echo "<tr><td>{$row['ShippingCode']}</td><td>{$row['ShippingStatus']}</td><td>{$row['SenderAddress']}</td><td>{$row["ShippingAddress"]}</td><td>{$row['RecipientName']}</td><td>{$row['Customer_CustomerID']}</td><tr>";
    }
    echo "</table>";
	
} else {
    echo "No shipping details currently..";
}
?>
	<?php


	if(isset($_POST['UpdateButton']))
	{
		
		if($_POST['ShippingStatus']=="")
		{
			echo '<script type="text/javascript">alert("Please enter a Shipping Status.")</script>';
		}
		else
		{
			@$ShippingCode=$_POST['ShippingCode'];
			@$ShippingStatus=$_POST['ShippingStatus'];
			@$SenderAddress=$_POST['SenderAddress'];
			@$ShippingAddress=$_POST['ShippingAddress'];
			@$RecipientName=$_POST['RecipientName'];

			$query = "update shipping SET ShippingStatus='$ShippingStatus' WHERE ShippingCode=$ShippingCode";

			$query_run = mysqli_query($con,$query);

				if($query_run)
				{
					echo '<script type="text/javascript">alert("Shipping Status updated.")</script>';
				}
				else{
					echo '<script type="text/javascript">alert("Error!")</script>';
				}

		}
	}
	?>
	
	<form action="shipping.php" method="post">
	<br><br><br>
	Would you like to update the Shipping Status of a customer?<br>
	<br>
	<input type="number" placeholder="Enter Shipping Code" name="ShippingCode" value="<?php echo $ShippingCode;?>">
	<br>
	<input type="text" placeholder="Enter Status" name="ShippingStatus" value="<?php echo $ShippingStatus; ?>">
	<br>
	<button id="update" name="UpdateButton" type ="submit">Update Status</button>
	</form>
		
</center>
</div>
</body>
</html>