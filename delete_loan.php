<?php
// delete_loan.php

$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = '';

// Check if the ID parameter is set
if (isset($_POST['id'])) {
    $id = $_POST['id'];

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Delete the loan from the loan table
        $stmt = $conn->prepare("DELETE FROM loan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $deletedRows = $stmt->rowCount();

        // Delete the corresponding record from the run_loan table (assuming the ID exists there as well)
        $stmt = $conn->prepare("DELETE FROM run_loan WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $deletedRows += $stmt->rowCount();

        if ($deletedRows > 0) {
            echo "Loan deleted successfully.";
        } else {
            echo "No records deleted.";
        }

    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "ID parameter is not set.";
}
?>
