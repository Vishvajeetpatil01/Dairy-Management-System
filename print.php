<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Print Page</title>
<style>
    body {
        font-family: Arial, sans-serif;
        max-width: 400px;
        margin: 0 auto;
    }
    .bill {
        border: 2px solid #333;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }
    h2 {
        text-align: center;
        margin-bottom: 20px;
    }
    p {
        margin: 5px 0;
    }
    .item {
        display: flex;
        justify-content: space-between;
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
    }
    h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
</style>
</head>
<body>
<h3 class="no-print"><a href="customerbill.php">Back</a></h3>
<div class="bill">
<div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
    <h2>Bill</h2>
    <?php
// Start a new session
session_start();

// Establish connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve customer information from database
$customer_info = array();
if (isset($_SESSION['successful_payments']) && is_array($_SESSION['successful_payments'])) {
    $payment = end($_SESSION['successful_payments']); // Get the last payment from the array
    if (is_array($payment) && isset($payment['customer_info'])) {
        $row = $payment['customer_info'];
        echo "<div class='item'><p>Customer ID:</p><p>" . $payment['customer_id'] . "</p></div>";
        echo "<div class='item'><p>Name:</p><p>" . $row["name"] . "</p></div>";
        echo "<div class='item'><p>Mobile Number:</p><p>" . $row["mobile"] . "</p></div>";
        echo "<div class='item'><p>Milk Type:</p><p>" . $row["mtype"] . "</p></div>";
        echo "<div class='item'><p>Balance:</p><p>" . $row["balance"] . "</p></div>";

        // Get billing amount from the URL query parameters
        $billing_amount = $_GET['billing_amount'] ?? ''; // Using the null coalescing operator to handle cases where the parameter is not set
        echo "<div class='item'><p>Billing Amount:</p><p>" . $billing_amount . "</p></div>";

        // Message sending functionality
        $mobile = $row["mobile"];
        $name = $row["name"];
        $id = $payment['customer_id'];
        $balance = $row["balance"];

        $message = [
            "secret" => "", // your API secret from (Tools -> API Keys) page
            "mode" => "devices",
            "device" => "00000000-0000-0000-8eaa-b10d44c3e4e3",
            "sim" => 1,
            "priority" => 1,
            "phone" => "+91$mobile", // Specify the phone number to which you want to send the SMS
            "message" => "Hello $name your bill payment is successfully done in DOODHSINDHU MILKS. Your Customer ID - $id Billing Amount:$billing_amount, Remaining Balance:$balance" // Your SMS message content
        ];

        $cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        $response = curl_exec($cURL);
        curl_close($cURL);

        $result = json_decode($response, true);

        // Check the status and message in the response
        if ($result['status'] == 200) {
            // echo "<p align=\"center\">Message has been queued for sending!</p>";
        } else {
            echo "<p>Error: " . $result['message'] . "</p>";
        }
    } else {
        echo "<p>No valid payment information found.</p>";
    }
} else {
    echo "<p>No successful payments yet.</p>";
}

// Close connection
$conn->close();
?>

    <h3>Payment Done Successfully...</h3>
</div>
<a href="#" class="print-button" onclick="window.print();">Print</a>
</body>
</html>
