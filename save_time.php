<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming you have a database connection
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

    // Retrieve selected date and session from the form
    $selectedDate = $_POST['date'];
    $selectedSession = $_POST['session'];

    // Check if the entry already exists in the database
    $query = "SELECT * FROM ctime WHERE cdate = '$selectedDate' AND csession = '$selectedSession'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Entry already exists, update the data for the existing row
        $updateQuery = "UPDATE ctime SET cdate = '$selectedDate', csession = '$selectedSession' WHERE cdate = '$selectedDate' AND csession = '$selectedSession'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect user to the collection.php page
            header("Location: collection1.php");
            exit(); // Ensure script stops here to prevent further execution
        } else {
            echo "Error updating record: " . $conn->error;
        }
    } else {
        // No entry exists, do nothing or update the data with the new date and session
        $updateQuery = "UPDATE ctime SET cdate = '$selectedDate', csession = '$selectedSession'";
        if ($conn->query($updateQuery) === TRUE) {
            // Redirect user to the collection.php page
            header("Location: collection1.php");
            exit(); // Ensure script stops here to prevent further execution
        } else {
            echo "Error updating record: " . $conn->error;
        }
    }

    // Close the database connection
    $conn->close();
}
?>
