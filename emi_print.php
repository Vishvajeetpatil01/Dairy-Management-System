<!DOCTYPE html>
<html>
<head>
    <title>EMI Report</title>
    <style>
        /* Your CSS for styling */
        /* Example styles, modify as needed */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        .loan-details {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap; /* Allow wrapping */
        }
        .loan-details p {
            flex-basis: calc(50% - 10px); /* Adjust the width as needed */
            margin-bottom: 10px; /* Add some margin for spacing */
        }
        .print-button {
        display: block;
        margin: 20px auto;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        text-align: center;
    }
    .print-button:hover {
        background-color: #555;
    }
    
    @media print {
        body {
            margin: 0;
            padding: 20px;
        }
        h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }
        p {
            font-size: 16px;
            margin-bottom: 5px;
        }
        .no-print {
            display: none; /* Hide elements with class 'no-print' when printing */
        }
    </style>
</head>
<body>
<div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
<h1>Loan Report</h1>

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

// Retrieve loan_id from URL parameter
$loan_id = $_GET['loan_id'];

// Fetch data from loan table
$sql_loan = "SELECT * FROM loan WHERE id = $loan_id";
$result_loan = $conn->query($sql_loan);
$row_loan = $result_loan->fetch_assoc();

// Fetch data from run_loan table
$sql_run_loan = "SELECT * FROM run_loan WHERE id = $loan_id";
$result_run_loan = $conn->query($sql_run_loan);
$rows_run_loan = [];

while ($row_run_loan = $result_run_loan->fetch_assoc()) {
    $rows_run_loan[] = $row_run_loan;
}

// Fetch data from emi table
$sql_emi = "SELECT * FROM emi WHERE id = $loan_id";
$result_emi = $conn->query($sql_emi);
$rows_emi = [];

while ($row_emi = $result_emi->fetch_assoc()) {
    $rows_emi[] = $row_emi;
}

// Fetch customer name based on the loan's customer_id (assuming you have a customer_id field in the loan table)
$customer_id = $row_loan['id']; // Adjust this based on your actual field name
$sql_customer = "SELECT name FROM customer WHERE id = $customer_id";
$result_customer = $conn->query($sql_customer);
$row_customer = $result_customer->fetch_assoc();
$customer_name = $row_customer['name'];

?>


<!-- Display customer name -->
<div class="loan-details">
    <p><strong>Customer Name:</strong> <?php echo $customer_name; ?></p>
    <p><strong>Loan ID:</strong> <?php echo $row_loan['id']; ?></p>
    <p><strong>Loan Amount:</strong> <?php echo $row_loan['loan_amount']; ?></p>
    <p><strong>Interest Rate:</strong> <?php echo $row_loan['interest']; ?></p>
    <p><strong>Loan Term:</strong> <?php echo $row_loan['loan_duration']; ?></p>
    <p><strong>Payable Amount:</strong> <?php echo $row_loan['total_payable_amount']; ?></p>
    <p><strong>EMI:</strong> <?php echo $row_loan['emi']; ?></p>
    <p><strong>Start Date:</strong> <?php echo $row_loan['start_date']; ?></p>
</div>
<h2>Run Loan Details</h2>
<table>
    <tr>
        <th>Remain Amount</th>
        <th>Remain EMI</th>
    </tr>
    <?php foreach ($rows_run_loan as $row): ?>
        <tr>
            <td><?php echo $row['remain_amount']; ?></td>
            <td><?php echo $row['remain_duration']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<h2>EMI Details</h2>
<table>
    <tr>
        <th>Date</th>
        <th>EMI Amount</th>
        <th>Status</th>
    </tr>
    <?php foreach ($rows_emi as $row): ?>
        <tr>
            <td><?php echo $row['payment_date']; ?></td>
            <td><?php echo $row['emi_amount']; ?></td>
            <td><?php echo $row['payment_status']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<a href="#" class="print-button" onclick="window.print();">Print</a>
</body>
</html>

<?php
// Close the database connection
$conn->close();
?>
