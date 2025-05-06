

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Loan Registration</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f4f4f4;
    }
    .container {
      max-width: 600px;
      margin: 50px auto;
      background-color: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    h1 {
      text-align: center;
      color: #333;
    }
    .form-group {
      margin-bottom: 20px;
    }
    label {
      display: block;
      margin-bottom: 5px;
      color: #666;
    }
    input[type="text"], input[type="number"], select {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    input[type="submit"] {
      width: 100%;
      padding: 10px;
      border: none;
      border-radius: 5px;
      background-color: #007bff;
      color: #fff;
      cursor: pointer;
    }
    input[type="submit"]:hover {
      background-color: #0056b3;
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
<h3><a href="loan_app.php">Back</a></h3>
  <div class="container">
    <h1>Loan Registration</h1>
    <form action="#" method="post" id="loanForm">
      <div class="form-group">
        <label for="id">Customer ID</label>
        <input type="text" id="id" name="search" required>
      </div>
      <div class="form-group">
        <label for="amount">Loan Amount </label>
        <input type="number" id="amount" name="amount" min="1000" step="100" required>
      </div>
      <div class="form-group">
        <label for="interest_rate">Interest Rate (%)</label>
        <input type="number" id="interest_rate" name="interest_rate" min="0" step="0.01" required>
      </div>
      <div class="form-group">
        <label for="duration">Loan Duration (months)</label>
        <input type="number" id="duration" name="duration" min="6" step="1" required>
      </div>
      <div class="form-group">
        <label for="total_amount">Total Payable Amount</label>
        <input type="text" id="total_amount" name="total_amount" readonly>
      </div>
      <div class="form-group">
        <label for="monthly_emi">Monthly EMI</label>
        <input type="text" id="monthly_emi" name="monthly_emi" readonly>
      </div>
      <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" id="start_date" name="start_date">
            </div>
      <div class="form-group">
        <input type="submit" value="Calculate" onclick="calculateTotalAndEMI();">
        <!-- Add the "Insert" button -->
        <input type="button" value="Insert" onclick="insertData();">
      </div>
    </form>
  </div>

  <script>
    document.getElementById('loanForm').addEventListener('submit', function(event) {
  event.preventDefault();
  calculateTotalAndEMI();
});

function calculateTotalAndEMI() {
  var loanAmount = parseFloat(document.getElementById('amount').value);
  var interestRate = parseFloat(document.getElementById('interest_rate').value);
  var loanDuration = parseInt(document.getElementById('duration').value);

  var monthlyInterestRate = interestRate / (100 * 12) ;
  var totalPayableAmount = loanAmount * (1 + monthlyInterestRate) ** loanDuration;
  var monthlyEMI = totalPayableAmount / loanDuration;

  document.getElementById('total_amount').value = totalPayableAmount.toFixed(2);
  document.getElementById('monthly_emi').value = monthlyEMI.toFixed(2);
}

// Function to insert data into the database
function insertData() {
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function() {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        alert(xhr.responseText);
        clearForm(); // Clear the form after successful insertion
      } else {
        alert('Error: ' + xhr.status);
      }
    }
  };
  xhr.open('POST', 'insert_loan.php', true);
  xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
  xhr.send(new URLSearchParams(new FormData(document.getElementById('loanForm'))));
}

// Function to clear the form fields
function clearForm() {
  document.getElementById('loanForm').reset(); // Reset the form
  document.getElementById('total_amount').value = ''; // Clear total payable amount
  document.getElementById('monthly_emi').value = ''; // Clear monthly EMI
}

  </script>

</body>
</html>
