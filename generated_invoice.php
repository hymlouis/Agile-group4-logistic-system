<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
</head>

<body>

<?php
		if(isset($_POST['CustomerID'])){
		
			$CustomerID = $_POST['CustomerID'];
			
			if($CustomerID=="")
			{
				echo '<script type="text/javascript">alert("Please enter a Shipping Code.")</script>';
			}
			else
			{
				$query = "select a.*, b.CustomerName from invoice a, customer b where b.CustomerID=$a.CustomerID";
				$query_run = mysqli_query($con,$query);
				if($query_run)
				{
					if(mysqli_num_rows($query_run)>0)
					{
						$row = mysqli_fetch_array($query_run,MYSQLI_ASSOC);
						@$InvoiceID=$row['InvoiceID'];
						@$ShippingStatus=$row['ShippingCode'];
						@$SenderAddress=$row['Fee'];
						@$Status=$row['Status'];
						@$CustomerID=$row['CustomerID'];
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

</body>
</html>