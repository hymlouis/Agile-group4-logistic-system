<?php
require 'dbconfig/config.php';

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
<div id="cargotext">
<center>
<?php
$query = "select * from invoice";
$query_run = mysqli_query($con,$query);

if(mysqli_num_rows($query_run)>0){
    echo "<table border = '1'>";
	echo "<tr><td>Invoice Number</td><td>Shipping Code</td><td>Fee</td><td>Status</td><td>Customer ID</td><tr>";
    while($row = $query_run->fetch_assoc()) {
        echo "<tr><td>{$row['InvoiceID']}</td><td>{$row['ShippingCode']}</td><td>{$row['Fee']}</td><td>{$row["Status"]}</td><td>{$row['CustomerID']}</td><tr>";
    }
    echo "</table>";
	
} else {
    echo "No Customers currently.";
}
?>
<form action="invoice.php" method="post" target_"blank">
		<br><br>
		<label><b>Which customer would you like to generate an invoice for?: </b><br> 
		<input type="number" placeholder="Enter Customer ID" name="CustomerID" value="<?php echo @$_POST['CustomerID'];?>">
		</label><button id="invoice_button" name="generate" type="submit">Generate</button><br><br>
	</form>
	
<?php
		if(isset($_POST['CustomerID'])){
		
			$CustomerID = $_POST['CustomerID'];
			
			if($CustomerID=="")
			{
				echo '<script type="text/javascript">alert("Please enter a Customer ID.")</script>';
			}
			else
			{
				$query = "select InvoiceID, CustomerID, ShippingCode, Fee, Status from invoice where CustomerID=$CustomerID";
				$query_run = mysqli_query($con,$query);
				
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0){
					echo "<table border = '1'>";
					echo "<tr><td>Invoice ID:</td><td>Customer ID:</td><td>Shipping Code:</td><td>Fee:</td><td>Status:</td><tr>";
					while($row = $query_run->fetch_assoc()) {
						echo "<tr><td>{$row['InvoiceID']}</td><td>{$row['CustomerID']}</td><td>{$row['ShippingCode']}</td><td>{$row["Fee"]}</td><td>{$row['Status']}</td><tr>";
					}
					echo "</table>";

					}
					else{
						echo '<script type="text/javascript">alert("Please enter a valid Customer Code.")</script>';
					}
				}
				else{
					echo '<script type="text/javascript">alert("Error!")</script>';
				}
				
			}
			
		}
	?>
	
</center>
</div>
</body>
</html>