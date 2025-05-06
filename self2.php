<?php
session_start();
if (!isset($_SESSION['User'])) {
    header("location:self.php");
}

$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_password'])) {
    $newPassword = $_POST['new_password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($newPassword === $confirmPassword) {
        $id = $_SESSION['User'];
        $mysql = mysqli_connect("localhost", "root", "");
        mysqli_select_db($mysql, "db");
        $updateQuery = "UPDATE customer SET password = '$newPassword' WHERE id = $id";
        mysqli_query($mysql, $updateQuery);
        $message = "Password updated successfully!";
    } else {
        $message = "Your passwords do not match!";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Index Page</title>

     <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
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

        h1 {
            text-align: center;
            margin: 20px 0;
        }

        form {
            text-align: center;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
            background-color: #fff;
        }

        table, th, td {
            border: 1px solid #333;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 3px;
            border: 1px solid #ccc;
            border-radius: 100px;
            margin: 5px 0;
        }

        input[type="submit"], input[type="reset"] {
            background-color: orange;
            color: #fff;
            padding: 5px 15px;
            border: none;
            cursor: pointer;
            border-radius: 100px;
        }

        input[type="submit"]:hover, input[type="reset"]:hover {
            background-color: #ff9933;
        }

        caption {
            background-color: #333;
            color: #fff;
            font-weight: bold;
            padding: 10px;
        }
        .languageSelect {
            position: fixed;
            top: 10px;
            right: 10px;
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
    

<h3><a href="login.php">BACK</a></h3>
<div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
</div>


    <h1>Welcome to the Dudhsindhu Milks</h1>
    <form action="loan.php" method="post">
    <input type="submit" name="loan" value="Loan">
</form>


<p><h3>Your Details</h3></p>

<?php
$id = $_SESSION['User'];
$tableName = "customer_$id";
$mysql = mysqli_connect("localhost", "root", "");
mysqli_select_db($mysql, "db");
$result = mysqli_query($mysql, "SELECT name, address, mobile, mtype, balance, password FROM customer WHERE id = $id");

if (mysqli_num_rows($result) > 0) {
    echo "<table border='1'>";
    echo "<tr><th>Name</th><th>Address</th><th>Mobile</th><th>Milk Type</th><th>Balance</th><th>Password</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['name']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['mobile']."</td>";
        echo "<td>".$row['mtype']."</td>";
        echo "<td>".$row['balance']."</td>";
        echo "<td>".$row['password']."</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No data found.";
}
?>
<form action="" method="post">
    <h3>Update Password</h3>
    <label for="new_password">New Password:</label>
    <input type="password" placeholder="Enter New Password" name="new_password" required>
    <label for="confirm_password">Confirm Password:</label>
    <input type="password" placeholder="Confirm New Password" name="confirm_password" required>
    <input type="submit" name="update_password" value="Update Password">
</form>
    <p><h3>Your Milk Collection Report</h3></p>

    <!-- Display the table with customer data -->
    <?php
    $id = $_SESSION['User'];
    $tableName = "customer_$id";
    $mysql = mysqli_connect("localhost", "root", "");
    mysqli_select_db($mysql, "db");
    $result = mysqli_query($mysql, "SELECT * FROM $tableName");

    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>ID</th><th>cdate</th><th>csession</th><th>mtype</th><th>qty</th><th>fat</th><th>snf</th><th>rate</th><th>total</th></tr>";
        
        $totalQty = 0;
        $totalTotal = 0;
        $totalFat = 0;
        $totalSnf = 0;
        $rowCount = 0;

        while ($row = mysqli_fetch_assoc($result)) {
            $rowCount++;
            $totalQty += $row['qty'];
            $totalTotal += $row['total'];
            $totalFat += $row['fat'];
            $totalSnf += $row['snf'];

            echo "<tr>";
            echo "<td>".$row['id']."</td>";
            echo "<td>".$row['cdate']."</td>";
            echo "<td>".$row['csession']."</td>";
            echo "<td>".$row['mtype']."</td>";
            echo "<td>".$row['qty']."</td>";
            echo "<td>".$row['fat']."</td>";
            echo "<td>".$row['snf']."</td>";
            echo "<td>".$row['rate']."</td>";
            echo "<td>".$row['total']."</td>";
            echo "</tr>";
        }

        $avgFat = $totalFat / $rowCount;
        $avgSnf = $totalSnf / $rowCount;
        

        echo "<tr>";
        echo "<td colspan='4'>Total</td>";
        echo "<td>$totalQty</td>";
        echo "<td colspan='2'></td>";
        echo "<td colspan='2'>$totalTotal</td>";
        echo "</tr>";

        echo "<tr>";
        echo "<td colspan='4'>Average</td>";
        echo "<td></td>";
        echo "<td>$avgFat</td>";
        echo "<td>$avgSnf</td>";
        echo "<td colspan='2'></td>";
        echo "</tr>";

        echo "</table>";
    } else {
        echo "No data found.";
    }
    ?>
    
</body>
</html>
