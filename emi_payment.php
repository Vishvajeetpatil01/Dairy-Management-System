<?php
$id = "";
$customer_name = ""; // Initialize variable to store fetched customer name
$emi = ""; // Initialize variable to store fetched amount
$payable_loan_amount = "";
$remain_amount = "";
$remain_duration = "";
$loan_amount = "";
$interest_rate = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to your database (replace these variables with your actual database credentials)
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

    
    $id = $_POST['id'];
    $stmt_customer = $conn->prepare("SELECT name, mobile, balance FROM customer WHERE id = ?");
    $stmt_customer->bind_param("s", $id);

    $stmt_customer->execute();
    $stmt_customer->bind_result($customer_name, $mobile, $balance);
    $stmt_customer->fetch();
    $stmt_customer->close();


    $stmt_loan = $conn->prepare("SELECT loan_amount, interest, total_payable_amount, emi FROM loan WHERE id = ?");
    $stmt_loan->bind_param("s", $id);

    $stmt_loan->execute();
    $stmt_loan->bind_result($loan_amount, $interest_rate, $payable_loan_amount, $emi);
    $stmt_loan->fetch();
    $stmt_loan->close();


    $stmt_run_loan = $conn->prepare("SELECT remain_amount, remain_duration FROM run_loan WHERE id = ?");
    $stmt_run_loan->bind_param("s", $id);

    $stmt_run_loan->execute();
    $stmt_run_loan->bind_result($remain_amount, $remain_duration);
    $stmt_run_loan->fetch();
    $stmt_run_loan->close();

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EMI Payment</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        form {
            margin-top: 20px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        .form-group input[type="text"],
        .form-group input[type="number"],
        .form-group input[type="date"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        .form-group input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .form-group input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .emi-info {
            margin-top: 30px;
            border-top: 1px solid #ccc;
            padding-top: 20px;
        }
        .emi-info p {
            margin: 0;
        }
        h3 {
            text-align: center;
            margin: 20px 0;
        }

        h3 a {
            color: #333;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        h3 a:hover {
            color: #ff6f00;
        }
    </style>
</head>
<body>
<h3><a href="loan_app.php">BACK</a></h3>
    <div class="container">
        <h1>EMI Payment</h1>
        <form id="loan_form" action="#" method="POST">
            <div class="form-group">
                <label for="loan_id">ID:</label>
                <input type="text" id="id" name="id" value="<?php echo $id; ?>" required>
            </div>
            <div class="form-group">
            <label for="customer_name">Customer Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $customer_name; ?>">
            </div>
            <input type="hidden" id="mobile" name="mobile" value="<?php echo $mobile; ?>">
            <div class="form-group">
                <label for="amount">Balance:</label>
                <input type="number" id="balance" name="balance" value="<?php echo $balance; ?>" >
            </div>

            <div class="form-group">
                <label for="amount">Loan Amount:</label>
                <input type="number" id="loan_amount" name="loan_amount" value="<?php echo $loan_amount; ?>" >
            </div>
            <div class="form-group">
            <label for="interest_rate">Interest Rate (%)</label>
            <input type="number" id="interest_rate" name="interest_rate" value="<?php echo $interest_rate; ?>">
            </div>

            <div class="form-group">
                <label for="amount">Payable Loan Amount:</label>
                <input type="number" id="payable_loan_amount" name="payable_loan_amount" value="<?php echo $payable_loan_amount; ?>">
            </div>
            
            <div class="form-group">
                <label for="amount">EMI:</label>
                <input type="number" id="emi" name="emi" value="<?php echo $emi; ?>" >
            </div>
            
            <div class="form-group">
                <label for="amount">Remain Amount:</label>
                <input type="number" id="remain_amount" name="remain_amount" value="<?php echo $remain_amount; ?>" >
            </div>
            <div class="form-group">
                <label for="amount">Remain EMI:</label>
                <input type="number" id="remain_emi" name="remain_emi" value="<?php echo $remain_duration; ?>" >
            </div>
            <div class="form-group">
                <label for="payment_date">Payment Date:</label>
                <input type="date" id="payment_date" name="payment_date">
            </div>
            <div class="form-group">
                <label for="payment_status">Payment Status:</label>
                <select id="payment_status" name="payment_status">         
    <option value="Not_Done">Not Done</option>
    <option value="Payment_Done">Done</option>
</select>

            </div>
            <div id="doneFields" style="display: none;">
                <div class="form-group">
                <h2>Remaining EMIs:<h4>After payment Done...</h4></h2>
                    <label for="remain_amount">Remain Amount:</label>
                    <input type="text" id="remains_amount" name="remains_amount">
                </div>
                <div class="form-group">
                    <label for="remain_duration">Remain EMI:</label>
                    <input type="number" id="remains_duration" name="remains_duration" >
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Search" name="search"> 
            </div>
            <input type="button" value="Payment Done" onclick="insertData(), clearForm();">
        </form>
        <script>
    document.getElementById('payment_status').addEventListener('change', function() {
    var paymentStatus = this.value;
    var doneFields = document.getElementById('doneFields');
    if (paymentStatus === 'Payment_Done') { // Corrected the value check here
        doneFields.style.display = 'block';
        // Calculate remains_amount and update input field
        var remainAmount = parseFloat(document.getElementById('remain_amount').value);
        var emi = parseFloat(document.getElementById('emi').value);
        var remainsAmountInput = document.getElementById('remains_amount');
        remainsAmountInput.value = (remainAmount - emi).toFixed(2); // Round to 2 decimal places
        // Calculate remains_duration and update input field
        var remainDuration = parseInt(document.getElementById('remain_emi').value);
        var remainsDurationInput = document.getElementById('remains_duration');
        remainsDurationInput.value = (remainDuration - 1);
    } else {
        doneFields.style.display = 'none';
    }
});

    function insertData() {
    var paymentStatus = document.getElementById('payment_status').value;
    var remainsDuration = parseInt(document.getElementById('remains_duration').value);

    if (paymentStatus !== 'Payment_Done') {
        alert('Please Do The Payment & Then Click.');
        return; // Exit the function if the payment status is not "done"
    }

    var formData = new FormData(document.getElementById('loan_form'));
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'insert_emi.php', true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                alert(xhr.responseText);
                clearForm(); // Call the clearForm function after successful insertion
                if (remainsDuration === 0) {
                    alert("Congratulations! Your Loan is end.");
                }
            } else {
                alert('Error: ' + xhr.status);
            }
        }
    };
    xhr.send(formData);
}


function clearForm() {
  document.getElementById('loan_form').reset(); // Reset the form

  document.getElementById('id').value = '';
  document.getElementById('name').value = '';
  document.getElementById('loan_amount').value = '';
  document.getElementById('interest_rate').value = '';
  document.getElementById('payable_loan_amount').value = '';
  document.getElementById('emi').value = '';
  document.getElementById('remain_amount').value = '';
  document.getElementById('remain_emi').value = '';
  // Clear the calculated fields
  document.getElementById('remains_amount').value = '';
  document.getElementById('remains_duration').value = '';

  // Reset the Payment Status to 'Not Done'
  document.getElementById('payment_status').value = 'not_done';

  // Hide the 'doneFields' section
  document.getElementById('doneFields').style.display = 'none';
}
</script>

        
        <div class="emi-info">
            
            
        </div>
    </div>
</body>
</html>