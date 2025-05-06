<?php
// Include your database connection file
include 'connection.php';

// Check if customer ID is provided in the request
if(isset($_GET['customerId'])) {
    $customerId = $_GET['customerId'];

    // Prepare and execute SQL query to fetch name and milk type based on customer ID
    $stmt = $conn->prepare("SELECT name, mtype FROM customer WHERE id = ?");
    $stmt->bind_param("i", $customerId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if a row is returned
    if($result->num_rows > 0) {
        // Fetch the data
        $row = $result->fetch_assoc();

        // Return data as JSON
        echo json_encode($row);
    } else {
        // If no matching customer found, return an empty response
        echo json_encode(array('name' => '', 'mtype' => ''));
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
} else {
    // If customer ID is not provided, return an empty response
    echo json_encode(array('name' => '', 'mtype' => ''));
}
?>
