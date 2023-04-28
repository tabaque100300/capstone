<!DOCTYPE html>
<html>
<head>
	<title>Order Receipt</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			margin: 0;
			padding: 0;
		}
		h1 {
			font-size: 28px;
			margin-bottom: 10px;
		}
		p {
			margin: 0;
			padding: 0;
			line-height: 1.5;
		}
		.container {
			max-width: 500px;
			margin: 0 auto;
			padding: 20px;
			border: 1px solid #ccc;
		}
		.row {
			display: flex;
			justify-content: space-between;
			align-items: center;
			margin-bottom: 10px;
		}
		.title {
			flex-basis: 50%;
			font-weight: bold;
		}
		.amount {
			flex-basis: 50%;
			text-align: right;
		}
		.total {
			font-weight: bold;
			margin-top: 20px;
		}
	</style>
</head>
<body>
	<div class="container">
		<h1> Order Receipt</h1>

		<?php
		
		$sql = "SELECT * FROM `order_details` WHERE `id`=$id"
		$res=mysqli_query($conn, $sql);
		while($row=mysqli_fetch_assoc($res))
		{
			?>

					<p>Thank you for your order!</p>
					<div class="row">
						<div class="title">Order Number:</div>
						<div class="amount">123456</div>
					</div>
					<div class="row">
						<div class="title">Order Date:</div>
						<div class="amount">March 30, 2023</div>
					</div>
					<div class="row">
						<div class="title">Customer Name:<?php echo $row['cus_name']; ?></div>
						<div class="amount">John Doe</div>
					</div>
					<div class="row">
						<div class="title">Items:</div>
						<div class="amount"></div>
					</div>
					<div class="row">
						<div class="title">Item 1:</div>
						<div class="amount">$10.00</div>
					</div>
					<div class="row">
						<div class="title">Item 2:</div>
						<div class="amount">$20.00</div>
					</div>
					<div class="total row">
						<div class="title">Total:</div>
						<div class="amount">$30.00</div>
					</div>
					<p>Thank you for your business!</p>

			<?php
		}

		
		?>

        

	</div>
</body>
</html>