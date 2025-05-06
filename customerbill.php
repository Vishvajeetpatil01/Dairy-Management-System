<?php
// Start a new session
session_start();

// Initialize the successful_payments variable if it doesn't exist
if (!isset($_SESSION['successful_payments'])) {
    $_SESSION['successful_payments'] = array();
} else {
    // If it exists, ensure it's an array
    $_SESSION['successful_payments'] = (array) $_SESSION['successful_payments'];
}

// Establish connection to database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process payment
    if (isset($_POST["billing_amount"])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $customer_id = $_POST["customer_id"];
        $billing_amount = $_POST["billing_amount"];

        $sql = "UPDATE customer SET balance = balance - $billing_amount WHERE id = $customer_id";
        if ($conn->query($sql) === TRUE) {
            // Fetch complete customer information
            $sql = "SELECT name, mobile, mtype, balance FROM customer WHERE id = $customer_id";
            $result = $conn->query($sql);
        
            if ($result->num_rows > 0) {
                $customer_info = $result->fetch_assoc();
        
                // Store the customer information and billing amount in the session
                $payment = array(
                    'customer_id' => $customer_id,
                    'billing_amount' => $billing_amount,
                    'customer_info' => $customer_info
                );
                $_SESSION['successful_payments'][] = $payment;
        
                // Redirect to print.php after successful payment
                header("Location: print.php?customer_id=$customer_id&billing_amount=$billing_amount");
                exit();
            } else {
                echo "Error retrieving customer information: " . $conn->error;
            }
        } else {
            echo "Error updating record: " . $conn->error;
        }

        // Close connection
        $conn->close();
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Bill Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7; /* Background color */
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
        h2 {
            margin-bottom: 20px;
        }
        table {
            width: 50%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            margin-bottom: 20px;
        }
        input[type="text"], input[type="submit"] {
            padding: 8px;
            width: calc(50% - 16px); /* Adjusted width */
            box-sizing: content-box;
            margin-bottom: 10px;
            border: 1px solid #ddd; /* Border color */
            align-items: center;
        }
        input[type="submit"] {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #555;
        }
        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        .container {
            text-align: center;
            margin-bottom: 10px;
            margin-top: 0;
        }
        .logo {
            width: auto;
            max-height: 120px;
        }
        .header {
            margin-top: 0;
        }

    </style>
</head>
<body align = center>
    <h3><a href="index.php">HOME</a></h3>
    <h3><a href="collection1.php">Collection</a></h3>
    <div class="container">
        <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" class="logo">
    </div>

    <h1 class="header">DOODHSINDHU MILKS</h1>
    
    <h2 >Bill Page</h2>
    <form method="post" action="">
        <table align = center>
            <tr>
                <th>Search Customer ID:</th>
                <td><input type="text" name="customer_id"></td>
            </tr>
        </table>
        <input type="submit" value="Search">
    
    </form>
    <?php
    // Retrieve customer information from database
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["customer_id"])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $customer_id = $_POST["customer_id"];
        $sql = "SELECT name, mobile, mtype, balance FROM customer WHERE id = $customer_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display customer information
            while ($row = $result->fetch_assoc()) {
                echo "<p>Name: " . $row["name"] . "</p>";
                echo "<p>Mobile Number: " . $row["mobile"] . "</p>";
                echo "<p>Milk Type: " . $row["mtype"] . "</p>";
                echo "<p>Balance: " . $row["balance"] . "</p>";
            }
            ?>
             <form method="post" action="">
                <input type="text" placeholder="Enter Billing Amount Here" name="billing_amount" <?php if(isset($_POST['billing_amount'])) echo 'value="' . $_POST['billing_amount'] . '"'; ?>>
                <input type="hidden" name="customer_id" value="<?php echo $customer_id; ?>">
                <input type="submit" value="Pay">
            </form>

            <?php
        } else {
            echo "No customer found with ID: $customer_id";
        }

        // Close connection
        $conn->close();
    }
    ?>
</body>
</html>
