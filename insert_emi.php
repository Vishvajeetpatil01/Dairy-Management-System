<?php
if (isset($_POST['id'], $_POST['name'], $_POST['mobile'], $_POST['balance'], $_POST['emi'], $_POST['remain_emi'], $_POST['payment_date'], $_POST['payment_status'], $_POST['remains_amount'], $_POST['remains_duration'])) {
    // Retrieve form data
    $id = $_POST['id'];
    $emi = $_POST['emi'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $remain_emi = $_POST['remain_emi'];
    $balance = $_POST['balance'];
    $payment_date = $_POST['payment_date'];
    $payment_status = $_POST['payment_status'];
    $remains_amount = $_POST['remains_amount'];
    $remains_duration = $_POST['remains_duration'];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "db";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement for inserting into the emi table
    $sql_insert_emi = "INSERT INTO emi (id, emi_amount, payment_date, payment_status, remain_amount) VALUES (?, ?, ?, ?, ?)";
    $stmt_insert_emi = $conn->prepare($sql_insert_emi);
    $stmt_insert_emi->bind_param("idsss", $id, $emi, $payment_date, $payment_status, $remains_amount);

    // Execute SQL statement for inserting into the emi table
    if ($stmt_insert_emi->execute()) {
        echo "EMI Payment Done successfully...";
    } else {
        echo "Error: " . $sql_insert_emi . "<br>" . $stmt_insert_emi->error;
    }
    $stmt_insert_emi->close();

    // Prepare SQL statement for updating the run_loan table
    $sql_update_run_loan = "UPDATE run_loan SET remain_amount = ?, remain_duration = ? WHERE id = ?";
    $stmt_update_run_loan = $conn->prepare($sql_update_run_loan);
    $stmt_update_run_loan->bind_param("dds", $remains_amount, $remains_duration, $id);

    // Execute SQL statement for updating the run_loan table
    if ($stmt_update_run_loan->execute()) {
        // Update customer balance
        $sql_update_customer = "UPDATE customer SET balance = balance - ? WHERE id = ?";
        $stmt_update_customer = $conn->prepare($sql_update_customer);
        $stmt_update_customer->bind_param("ds", $emi, $id);
        $stmt_update_customer->execute();
        $stmt_update_customer->close();
        
        echo "Balance updated successfully";
    } else {
        echo "Error: " . $sql_update_run_loan . "<br>" . $stmt_update_run_loan->error;
    }
    $stmt_update_run_loan->close();

    $message = [
        "secret" => "013f68c4bc65af3258e89bad88b67eb9ca85f338", // your API secret from (Tools -> API Keys) page
        "mode" => "devices",
        "device" => "00000000-0000-0000-8eaa-b10d44c3e4e3",
        "sim" => 1,
        "priority" => 1,
        "phone" => "+91$mobile", // Specify the phone number to which you want to send the SMS
        "message" => "Hello $name (ID:$id) Your $remain_emi EMI Payment (RS $emi) is successfully done in DOODHSINDHU MILKS. With Remaining Amount: $remains_amount, Remain EMI:$remains_duration(Month)" // Your SMS message content
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
    echo "Error: Data not received.";
}
?>
