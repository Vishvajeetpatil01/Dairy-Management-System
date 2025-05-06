<?php
// Replace these with your actual database credentials
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch customer IDs from the 'customer' table
$sql = "SELECT id FROM customer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output customer IDs as JSON
    $customer_ids = array();
    while ($row = $result->fetch_assoc()) {
        $customer_ids[] = $row['id'];
    }
    echo json_encode($customer_ids);
} else {
    echo "0 results";
}

$conn->close();
?>
