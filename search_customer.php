<?php
// Establish a connection to the database
$servername = "localhost"; // Change this to your MySQL server name if different
$username = "username"; // Change this to your MySQL username
$password = "password"; // Change this to your MySQL password
$database = "your_database"; // Change this to your MySQL database name

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the customer ID from the request
$customerId = $_GET['id'];

// Prepare a SQL query to select customer data
$sql = "SELECT id, name, loan_amt FROM customer WHERE id = $customerId";

// Execute the query
$result = $conn->query($sql);

// Check if any rows were returned
if ($result->num_rows > 0) {
    // Fetch data from each row
    $customerData = array();
    while ($row = $result->fetch_assoc()) {
        $customerData[] = $row;
    }
    // Return the data as JSON
    echo json_encode($customerData);
} else {
    // No matching customer found
    echo json_encode([]);
}

// Close the database connection
$conn->close();
?>
