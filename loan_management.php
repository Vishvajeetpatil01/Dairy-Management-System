<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Loan Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 8px 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        button {
            padding: 5px 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            cursor: pointer;
            margin-right: 5px;
        }

        button:hover {
            background-color: #0056b3;
        }

        .search-container {
            margin-bottom: 20px;
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .search-container input[type=text] {
            padding: 5px;
            margin-right: 10px;
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

<h3 ><a href="loan_app.php">BACK</a></h3>
<div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
</div>

<h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
<h2 align="center">Loan Management</h2>

<!-- Search Bar -->
<div class="search-container">
    <label for="search">Search:</label>
    <input type="text" id="search" name="search" placeholder="Search..." onkeyup="filterTable()">
    <button type="button" onclick="searchLoan()">Search</button>
</div>

<!-- Loan List -->
<div>
    <h3>Loan List</h3>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer Name</th>
                <th>Balance</th>
                <th>Loan Amount</th>
                <th>Interest Rate (%)</th>
                <th>Loan Term (months)</th>
                <th>Total Payable Amount</th>
                <th>EMI</th>
                <th>Start Date</th>
                <th>Remaining Amount</th>
                <th>Remaining EMI</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Database connection
            $host = 'localhost';
            $dbname = 'db';
            $username = 'root';
            $password = '';

            try {
                $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                // Fetching data from the loan table with customer details and remaining amount and emi
                $stmt = $conn->prepare("SELECT l.id, c.name, c.balance, l.loan_amount, l.interest, l.loan_duration, l.total_payable_amount, l.emi, l.start_date, r.remain_amount, r.remain_duration FROM loan l JOIN customer c ON l.id = c.id JOIN run_loan r ON l.id = r.id");
                $stmt->execute();

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . (is_numeric($row['balance']) ? number_format($row['balance'], 2) : $row['balance']) . "</td>";
                    echo "<td>" . number_format($row['loan_amount'], 2) . "</td>";
                    echo "<td>" . $row['interest'] . "%</td>";
                    echo "<td>" . $row['loan_duration'] . "</td>";
                    echo "<td>" . number_format($row['total_payable_amount'], 2) . "</td>";
                    echo "<td>" . number_format($row['emi'], 2) . "</td>";
                    echo "<td>" . $row['start_date'] . "</td>";
                    echo "<td>" . number_format($row['remain_amount'], 2) . "</td>";
                    echo "<td>" . $row['remain_duration'] . "</td>";
                    echo "<td>";
                    echo "<button onclick='editLoan(" . $row['id'] . ")'>Edit</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            ?>
        </tbody>
    </table>
</div>

<script>
    function filterTable() {
        // Declare variables
        var input, filter, table, tr, td, i, txtValue;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        table = document.querySelector("table");
        tr = table.getElementsByTagName("tr");

        // Loop through all table rows, and hide those who don't match the search query
        for (i = 0; i < tr.length; i++) {
            tdId = tr[i].getElementsByTagName("td")[0]; // ID column
            tdName = tr[i].getElementsByTagName("td")[1]; // Name column
            if (tdId || tdName) {
                txtValueId = tdId.textContent || tdId.innerText;
                txtValueName = tdName.textContent || tdName.innerText;
                if (txtValueId.toUpperCase().indexOf(filter) > -1 || txtValueName.toUpperCase().indexOf(filter) > -1) {
                    tr[i].style.display = "";
                } else {
                    tr[i].style.display = "none";
                }
            }
        }
    }

function editLoan(id) {
    // Redirect to loan_edit.php with the loan ID as a parameter
    window.location.href = "loan_edit.php?id=" + id;
}

</script>

</body>
</html>
