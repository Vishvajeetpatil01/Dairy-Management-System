<style>
body {
    font-family: Arial, sans-serif;
    background-color: #f2f2f2;
    margin: 0;
    padding: 0;
}

h3 {
    text-align: center;
    margin-top: 20px;
}

a {
    text-decoration: none;
    color: #333;
    transition: color 0.3s ease;
}

a:hover {
    color: #ff6f00;
}

.success-message {
    background-color: #d4edda;
    color: #155724;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    animation: fadeIn 0.5s;
}

.error-message {
    background-color: #f8d7da;
    color: #721c24;
    padding: 10px;
    text-align: center;
    border-radius: 5px;
    animation: fadeIn 0.5s;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
</style>
<h3><a href="allcustomer.php">Back</a></h3>
<?php
// Database connection details
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

// Check if the customer ID is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // SQL query to delete the customer record
    $sql = "DELETE FROM customer WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Deletion successful
        echo "Customer record deleted successfully.";
    } else {
        echo "Error deleting customer record: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}

$conn->close();
?>