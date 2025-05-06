<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Step 1: Execute a query to fetch date and session from the ctime table
$query = "SELECT cdate, csession FROM ctime";
$result = mysqli_query($conn, $query);

// Step 2: Check if the query was successful
if($result) {
    // Step 3: Retrieve the data
    $row = mysqli_fetch_assoc($result);
    $date = $row['cdate'];
    $session = $row['csession'];
} else {
    // Handle the case where the query fails
    $date = ""; // Set default value for date
    $session = ""; // Set default value for session
}

// Close the result set
mysqli_free_result($result);
?>

<?php

// Step 1: Execute a query to fetch the name from the dname table
$queryName = "SELECT dname FROM division";
$resultName = mysqli_query($conn, $queryName);

// Step 2: Check if the query was successful
if($resultName) {
    // Step 3: Retrieve the data
    $rowName = mysqli_fetch_assoc($resultName);
    $name = $rowName['dname'];
} else {
    // Handle the case where the query fails
    $name = ""; // Set default value for name
}

// Close the result set
mysqli_free_result($resultName);
?>

<?php
// Get FAT and SNF values from user input
$fat = isset($_POST['fat']) ? $_POST['fat'] : 0;
$snf = isset($_POST['snf']) ? $_POST['snf'] : 0;
$animal_type = isset($_POST['mtype']) ? $_POST['mtype'] : ''; // Assuming you have a field for animal type in your form

// Determine which table to select based on animal type
$table_name = ($animal_type == 'Buffalo') ? 'brate' : 'crate';

// Prepare and execute SQL query
$sql = "SELECT rate FROM $table_name WHERE fat = ? AND snf = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("dd", $fat, $snf); // Assuming FAT and SNF are decimal values
$stmt->execute();
$result1 = $stmt->get_result();

// Check if any rows were returned
if ($result1->num_rows > 0) {
    // Fetch rate from the result
    $row = $result1->fetch_assoc();
    $rate = $row['rate'];
    
    
} 

?>
<?php
// Your existing database connection code

// Check if the "Fetch Qty" button is clicked
if(isset($_POST['fetch_qty'])) {
    // Retrieve values from the form
    $cdate = $_POST['date'];
    $csession = $_POST['session'];
    $mtype = $_POST['mtype'];

    // Execute a query to fetch quantity from the collection table
    $queryQty = "SELECT SUM(qty) AS total_qty FROM collection WHERE cdate = '$cdate' AND csession = '$csession' AND mtype = '$mtype'";
    $resultQty = mysqli_query($conn, $queryQty);

    // Check if the query was successful
    if($resultQty) {
        // Retrieve the quantity
        $rowQty = mysqli_fetch_assoc($resultQty);
        $qty = $rowQty['total_qty'];

        // Close the result set
        mysqli_free_result($resultQty);
        
        // Calculate total after fetching the quantity
        echo '<script>calculateTotal();</script>';
    } else {
        // Handle the case where the query fails
        $qty = "Not found"; // Set default value for quantity
    }
}
?>



<html>
    <head>

    <style>
        
        /* General styles */
body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background-color: #f5f5f5;
    color: #333;
    margin: 0;
    padding: 0;
}

h1, h3 {
    text-align: center;
    margin: 20px 0;
}

/* Table styles */
table {
    width: 80%;
    margin: 0 auto;
    border-collapse: collapse;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    animation: tableAnimation 1s ease;
}


th, td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #f2f2f2;
    font-weight: bold;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e6e6e6;
}

/* Input styles */
input[type="text"], input[type="submit"], input[type="reset"], input[type="button"] {
    padding: 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
    font-size: 14px;
    text-align: center;
}

input[type="submit"], input[type="reset"] {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover, input[type="reset"]:hover {
    background-color: #45a049;
}

/* Link styles */
a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}


.table1, .table2 {
    animation: fadeIn 1s ease;
}

/* Style for buttons */
button {
    background-color: #4CAF50; /* Green background */
    border: none;
    color: white; /* White text */
    padding: 15px 32px; /* Padding */
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;
    border-radius: 5px; /* Rounded corners */
}

/* Hover effect */
button:hover {
    background-color: #45a049; /* Darker green */
}

/* Active effect */
button:active {
    background-color: #3e8e41;
}

</style>
    </head>
    <script>
        // Function to calculate total dynamically
        function calculateTotal() {
            // Get the quantity and rate from the input fields
            var qty = parseFloat(document.getElementById("qty").value);
            var rate = parseFloat(document.getElementById("rate").value);

            // Calculate the total
            var total = qty * rate;

            // Display the total in the total input field
            document.getElementById("total").value = isNaN(total) ? '' : total.toFixed(2);
        }
    </script>
    <body>


<h3><a href="collection.php">Back</a></h3>
        <div class="table1">
        <h1 id="31" align="center">DAILY MILK COLLECTION REPORT</h1>
        
        <form action="#" method="POST">
            <table border="1" cellspacing="6" cellpadding="6" align="center" class="table0" >
                <tr align="center">
                    <th id="33" colspan="2">DIVISION NAME</th>
                    <th id="34" >MILK TYPE</th>
                    <th id="42">DATE</th>
                    <th  id="43">Session</th>
                </tr>
                <tr align="center">
                   <td colspan="2"><input type="text" name="name" id="name" value="<?php echo $name; ?>"></td>
                   <td>
                <select name="mtype" id="mtype">
                <option value="Buffalo" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Buffalo') echo 'selected'; ?>>Buffalo</option>
            <option value="Cow" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Cow') echo 'selected'; ?>>Cow</option>
                </select>
                </td>


                   <td><input type="text" value="<?php echo $date; ?>" name="date"></td>
                   <td><input type="text" value="<?php echo $session; ?>" name="session"></td>
                </tr>
                <tr align="center"><th id="36">FAT</th><th id="37" >SNF</th><th id="35" >QTY (LTR)</th><th id="38">RATE</th><th id="39" >TOTAL</th></tr>
                <tr align="centre">
                
                <td><input type="text" name="fat" id="fat" value="<?php echo isset($_POST['fat']) ? $_POST['fat'] : ''; ?>"></td>
                <td><input type="text" name="snf" id="snf" value="<?php echo isset($_POST['snf']) ? $_POST['snf'] : ''; ?>"></td>
                <td><input type="text" name="qty" id="qty" value="<?php echo isset($qty) ? $qty : ''; ?>" oninput="calculateTotal()" ></td>
                <td><input type="text" name="rate" id="rate" value="<?php echo isset($rate) ? $rate : ''; ?>" oninput="calculateTotal()" ></td>

                <td><input type="text" name="total" id="total" placeholder="Total" value="<?php echo isset($total) ? $total : ''; ?>" readonly required></td>
                
                    
                    
                    
                </tr>
                <tr align="center"> <td colspan="6">
                

                <input class="btn" style="background-color: orange" type="submit" value="Insert" name="insert" size="5"/>

                <input class="btn" style="background-color: orange" type="reset" value="Clear" name="clear" size="5"/>
                <input class="btn" style="background-color: orange" type="submit" value="Fetch Qty" name="fetch_qty" size="9"/>
                <input class="btn" style="background-color: orange" type="button" value="calculate" name="searchdata" size="5" onclick="calculateTotal()" />

            </td></tr>
            </table>

            <?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if(isset($_POST['insert'])) {
    // Retrieve values from the form
    $cdate = $_POST['date'];
    $csession = $_POST['session'];
    $mtype = $_POST['mtype'];
    $fat = $_POST['fat'];
    $snf = $_POST['snf'];
    $qty = $_POST['qty'];
    $rate = $_POST['rate'];
    $total = $_POST['total'];

 
     // Insert data into the collection_report table
     $sql = "INSERT IGNORE INTO collection_report (cdate, csession, mtype, fat, snf, qty, rate, total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
     $stmt = $conn->prepare($sql);
     $stmt->bind_param("ssssssss", $cdate, $csession, $mtype, $fat, $snf, $qty, $rate, $total);
     
     if ($stmt->execute() === TRUE) {
        echo '<div style="text-align: center;">';
        if ($stmt->affected_rows > 0) {
            echo "New record created successfully";
        } else {
            echo "Record already exists for this date, session, and milk type.";
        }
        echo '</div>';
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
 }

$conn->close();
?>
