<?php
// Database connection
$host = 'localhost';
$dbname = 'db';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the loan ID is provided
    if (isset($_GET['id'])) {
        $loanId = $_GET['id'];

        // Fetch loan details based on the loan ID
        $stmt = $conn->prepare("SELECT l.id, c.name, c.balance, l.loan_amount, l.interest, l.loan_duration, l.total_payable_amount, l.emi, l.start_date, r.remain_amount, r.remain_duration FROM loan l JOIN customer c ON l.id = c.id JOIN run_loan r ON l.id = r.id WHERE l.id = :id");
        $stmt->bindParam(':id', $loanId);
        $stmt->execute();

        $loan = $stmt->fetch(PDO::FETCH_ASSOC);
    } else {
        // Redirect back to the loan list if no ID is provided
        header("Location: index.php");
        exit();
    }

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Loan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
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

        form {
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .button-group {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        button {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <h3><a href="loan_management.php">BACK</a></h3>

    <h2 align="center">Loan Management</h2>

    <form action="" method="post" id="loanForm">
        <input type="hidden" name="id" value="<?php echo $loan['id']; ?>">
        
        <label for="name">Customer Name:</label>
        <input type="text" id="name" name="name" value="<?php echo $loan['name']; ?>">
        
        <label for="balance">Balance:</label>
        <input type="text" id="balance" name="balance" value="<?php echo number_format($loan['balance'], 2); ?>">
        
        <label for="loan_amount">Loan Amount:</label>
        <input type="text" id="loan_amount" name="loan_amount" value="<?php echo number_format($loan['loan_amount'], 2); ?>">
        
        <label for="interest">Interest Rate (%):</label>
        <input type="text" id="interest" name="interest" value="<?php echo $loan['interest']; ?>">
        
        <label for="loan_duration">Loan Term (months):</label>
        <input type="text" id="loan_duration" name="loan_duration" value="<?php echo $loan['loan_duration']; ?>">
        
        <label for="total_payable_amount">Total Payable Amount:</label>
        <input type="text" id="total_payable_amount" name="total_payable_amount" value="<?php echo number_format($loan['total_payable_amount'], 2); ?>">
        
        <label for="emi">EMI:</label>
        <input type="text" id="emi" name="emi" value="<?php echo number_format($loan['emi'], 2); ?>">
        
        <label for="start_date">Start Date:</label>
        <input type="text" id="start_date" name="start_date" value="<?php echo $loan['start_date']; ?>">
        
        <label for="remain_amount">Remaining Amount:</label>
        <input type="text" id="remain_amount" name="remain_amount" value="<?php echo number_format($loan['remain_amount'], 2); ?>">
        
        <label for="remain_duration">Remaining EMI:</label>
        <input type="text" id="remain_duration" name="remain_duration" value="<?php echo $loan['remain_duration']; ?>">
        
        <div class="button-group">
        <button type="submit" name="action" value="update">Update</button>
        <button type="submit" name="action" value="delete">Delete</button>
        
    </div>
    </form>
</div>

</body>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('loanForm');
        const buttons = document.querySelectorAll('.button-group button');

        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                const action = e.target.getAttribute('value');
                if (action === 'emi') {
                    form.action = 'emi.php';
                } else {
                    form.action = 'update_loan.php';
                }
            });
        });
    });
</script>

</html>
