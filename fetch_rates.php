<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$table_name = $_GET['table_name'];

$sql = "SELECT fat_rate, snf_rate FROM $table_name LIMIT 1";
$result = $conn->query($sql);

$response = [];

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $response['fat_rate'] = $row['fat_rate'];
    $response['snf_rate'] = $row['snf_rate'];
} else {
    $response['fat_rate'] = 0;
    $response['snf_rate'] = 0;
}

echo json_encode($response);

$conn->close();
?>
