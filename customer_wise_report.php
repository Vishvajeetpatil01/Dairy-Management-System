<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Prepare statement to fetch data based on selected criteria
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $from_session = $_POST['from_session'];
    $to_session = $_POST['to_session'];
    $id = $_POST['customer_id'];
    $balance = $_POST['balance'];

    // Fetch data from collection table
    $sql = "SELECT * FROM collection WHERE cdate BETWEEN '$from_date' AND '$to_date' AND csession BETWEEN '$from_session' AND '$to_session' AND id = '$id'";
    $result = $conn->query($sql);

    // Initialize variables for calculating totals and storing fetched data
    $total_qty = 0;
    $total = 0;
    $data_query = "";

    if ($result->num_rows > 0) {
        // Construct data query string and calculate totals
        while ($row = $result->fetch_assoc()) {
            $data_query .= "Date: " . $row["cdate"]. " - Session: " . $row["csession"]. " - Milk Type: " . $row["mtype"]. " - Fat: " . $row["fat"]. " - SNF: " . $row["snf"]. " - Quantity: " . $row["qty"]. " - Rate: " . $row["rate"]. " - Total: " . $row["total"]. "<br>";

            // Calculate total quantity and total amount
            $total_qty += $row["qty"];
            $total += $row["total"];
        }
    } else {
        $data_query = "No results found";
    }

    // Fetch additional customer parameters from the customer table
    $sql_customer = "SELECT mtype, address, name, mobile, balance FROM customer WHERE id = '$id'";
    $result_customer = $conn->query($sql_customer);

    if ($result_customer->num_rows > 0) {
        // Fetch additional customer parameters
        $row_customer = $result_customer->fetch_assoc();
        $mtype = $row_customer["mtype"];
        $address = $row_customer["address"];
        $name = $row_customer["name"];
        $mobile = $row_customer["mobile"];
        $balance = $row_customer["balance"];
    } else {
        // Handle case where customer details are not found
        $mtype = "N/A";
        $address = "N/A";
        $name = "N/A";
        $mobile = "N/A";
        $balance = "N/A";
    }

    // Close database connection
    $conn->close();

    // Redirect to the print page with necessary parameters
    $redirect_url = "print_report.php?data_query=" . urlencode($data_query) . "&total_qty=" . $total_qty . "&total_amount=" . $total . "&from_date=" . $from_date . "&to_date=" . $to_date . "&from_session=" . $from_session . "&to_session=" . $to_session . "&mtype=" . urlencode($mtype) . "&address=" . urlencode($address) . "&name=" . urlencode($name) . "&mobile=" . urlencode($mobile) . "&id=" . urlencode($id) . "&balance=" . urlencode($balance);
    header("Location: " . $redirect_url);
    exit(); // Make sure that subsequent code is not executed after redirection
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }

        /* Reset styles */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Body styles */
body {
    font-family: Arial, sans-serif;
    line-height: 1.6;
    background-color: #f4f4f4;
    font-size: 16px;
}

/* Header styles */
h3 {
    text-align: center;
    margin: 20px 0;
}

a {
    color: #333;
    text-decoration: none;
}

a:hover {
    color: #666;
}

/* Form styles */
form {
    max-width: 500px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="date"],
select {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
    margin-bottom: 15px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: #fff;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
   
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Center alignment */
center {
    text-align: center;
}

/* Responsive styles */
@media (max-width: 600px) {
    form {
        padding: 10px;
    }
}
    </style>
</head>
<body class="a">
<h3><a href="report_category.php">Back</a></h3>
<h3><a href="collection1.php">Collection</a></h3>
<center>
    <h2>Customer Wise Report</h2>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="from_date">From Date:</label>
    <input type="date" id="from_date" name="from_date" required>
    <label for="from_session">Session:</label>
    <select id="session" name="from_session" required>
        <option value="1-Morning">Morning</option>
        <option value="2-Evening">Evening</option>
    </select>
    <label for="to_date">To Date:</label>
    <input type="date" id="to_date" name="to_date" required>

    <label for="to_session">Session:</label>
    <select id="session" name="to_session" required>
        <option value="1-Morning">Morning</option>
        <option value="2-Evening">Evening</option>
    </select>

    <label for="customer_id">Customer ID:</label>
    <select id="customer_id" name="customer_id" required>
        <?php
        // Connect to your database
        $servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        // Fetch customer IDs from the database table
        $sql = "SELECT id FROM customer";
        $result = mysqli_query($conn, $sql);

        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "<option value='". $row['id'] ."'>". $row['id'] ."</option>";
        }

        // Close the database connection
        mysqli_close($conn);
        ?>
    </select>
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <input type="hidden" name="mtype" value="<?php echo $mtype; ?>"> <!-- Add hidden field for milk type -->
    <input type="hidden" name="address" value="<?php echo $address; ?>"> <!-- Add hidden field for address -->
    <input type="hidden" name="name" value="<?php echo $name; ?>"> <!-- Add hidden field for name -->
    <input type="hidden" name="mobile" value="<?php echo $mobile; ?>"> <!-- Add hidden field for mobile -->
    <input type="hidden" name="balance" value="<?php echo $balance; ?>">
   
    <input id="generate_report" style="background-color: orange" type="submit" name="submit" value="Generate"/>
</form>

</body>
</html>

