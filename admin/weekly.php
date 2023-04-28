Sure, here is an example of a transaction log for an ordering system and cashiering:

Date: March 29th, 2023
Time: 12:30 PM
Location: XYZ Restaurant

Order Details:

Table Number: 7
Order Taker: John
Order Items:
Cheeseburger (1) - $9.99
Fries (1) - $3.99
Soft Drink (1) - $1.99
Payment Details:

Payment Method: Credit Card
Credit Card Number: **** **** **** 1234
Total Amount: $15.97
Cashier Details:

Cashier Name: Sarah
Cashier ID: 1234
Transaction ID: TRX1234567890

Note: The transaction was processed successfully, and the customer was satisfied with their order.





<?php

// Set the date and time
$date = date("Y-m-d");
$time = date("h:i:s A");

// Define the order details
$tableNumber = 7;
$orderTaker = "John";
$orderItems = array(
    "Cheeseburger" => 9.99,
    "Fries" => 3.99,
    "Soft Drink" => 1.99
);

// Calculate the total amount
$totalAmount = array_sum($orderItems);

// Define the payment details
$paymentMethod = "Credit Card";
$creditCardNumber = "**** **** **** 1234";

// Define the cashier details
$cashierName = "Sarah";
$cashierID = 1234;

// Generate a transaction ID
$transactionID = "TRX" . rand(1000000000, 9999999999);

// Write the transaction log to a file
$log = "$date $time - Table $tableNumber ordered by $orderTaker:\n";
foreach ($orderItems as $item => $price) {
    $log .= "    $item - $$price\n";
}
$log .= "    Total - $$totalAmount\n";
$log .= "    Payment Method - $paymentMethod\n";
$log .= "    Credit Card Number - $creditCardNumber\n";
$log .= "    Cashier - $cashierName (ID: $cashierID)\n";
$log .= "    Transaction ID - $transactionID\n";
$log .= "\n";

$file = fopen("transaction_log.txt", "a");
fwrite($file, $log);
fclose($file);

?>




































<!DOCTYPE html>
<html>
<head>
	<title>Transaction Log</title>
</head>
<body>
	<h1>Transaction Log</h1>
	<table>
		<tr>
			<th>Date</th>
			<th>Time</th>
			<th>Order Number</th>
			<th>Item</th>
			<th>Price</th>
			<th>Quantity</th>
			<th>Total</th>
		</tr>
		<?php include('transaction_log.php'); ?>
	</table>
</body>
</html>






















<?php

// Connect to the database
$servername = "localhost";
$username = "username";
$password = "password";
$dbname = "myDB";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Retrieve transaction data from database
$sql = "SELECT * FROM transactions";
$result = $conn->query($sql);

// Output transaction data as table rows
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<tr>";
    echo "<td>" . $row["date"] . "</td>";
    echo "<td>" . $row["time"] . "</td>";
    echo "<td>"
