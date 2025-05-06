<?php
if (isset($_POST['search'], $_POST['amount'], $_POST['interest_rate'], $_POST['duration'], $_POST['total_amount'], $_POST['monthly_emi'], $_POST['start_date'])) {
    // Retrieve form data
    $customer_id = $_POST['search'];
    $loan_amount = $_POST['amount'];
    $interest_rate = $_POST['interest_rate'];
    $loan_duration = $_POST['duration'];
    $total_amount = $_POST['total_amount'];
    $monthly_emi = $_POST['monthly_emi'];
    $start_date = $_POST['start_date'];

    // Connect to your database (replace placeholders)
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

    // Fetch mobile number associated with customer ID
    $mobile_query = "SELECT mobile FROM customer WHERE id = '$customer_id'";
    $result = $conn->query($mobile_query);
    
    if ($result->num_rows > 0) {
        // Mobile number found, fetch and store it
        $row = $result->fetch_assoc();
        $mobile = $row['mobile'];
        
        // Prepare SQL statement for loan table insertion
        $sql = "INSERT INTO loan (id, loan_amount, interest, loan_duration, total_payable_amount, emi, start_date)
                VALUES ('$customer_id', '$loan_amount', '$interest_rate', '$loan_duration', '$total_amount', '$monthly_emi', '$start_date')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo "New Registration created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        // Prepare SQL statement for run_loan table insertion
        $sql1 = "INSERT INTO run_loan (id, remain_amount, remain_duration)
                VALUES ('$customer_id', '$total_amount', '$loan_duration')";

        // Execute SQL statement
        if ($conn->query($sql1) === TRUE) {
            echo "";
        } else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
        }
        
        $message = [
            "secret" => "", // your API secret from (Tools -> API Keys) page
            "mode" => "devices",
            "device" => "00000000-0000-0000-8eaa-b10d44c3e4e3",
            "sim" => 1,
            "priority" => 1,
            "phone" => "+91$mobile", // Specify the phone number to which you want to send the SMS
            "message" => "Hello...! ID:$customer_id your Loan Registration is successfully done in DOODHSINDHU MILKS. With Loan Amount: $loan_amount, Payable:$total_amount EMI Duration:$loan_duration(Month) EMI :$monthly_emi" // Your SMS message content
        ];

        $cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
        $response = curl_exec($cURL);
        curl_close($cURL);

        $result = json_decode($response, true);

        // Check the status and message in the response
        if ($result['status'] == 200) {
            echo "<p>Message has been queued for sending!</p>";
        } else {
            echo "<p>Error: " . $result['message'] . "</p>";
        }

        // Close connection
        $conn->close();
    } else {
        echo "Error: Customer ID not found.";
    }
} else {
    echo "Error: Data not received.";
}
?>
