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
$query = "select * from cargo";
$query_run = mysqli_query($con,$query);

if(mysqli_num_rows($query_run)>0){
    echo "<table border = '1'>";
	echo "<tr><td>Cargo ID</td><td>Description</td><td>Quantity</td><td>Weight</td><td>Size</td><td>Shipping Code</td><tr>";
    while($row = $query_run->fetch_assoc()) {
        echo "<tr><td>{$row['CargoID']}</td><td>{$row['Description']}</td><td>{$row['Quantity']}</td><td>{$row["Weight"]}</td><td>{$row['Size']}</td><td>{$row['ShippingCode']}</td><tr>";
    }
    echo "</table>";
	
} else {
    echo "No cargo currently.";
}
?>
</center>
</div>
</body>
</html>