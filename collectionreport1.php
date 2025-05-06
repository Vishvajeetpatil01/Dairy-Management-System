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
// Fetch default fat_rate and snf_rate
$default_milk_type = "Buffalo"; // Default milk type
$default_table_name = "bfr"; // Default table name for Buffalo milk
$queryDefaultRates = "SELECT fat_rate, snf_rate FROM $default_table_name LIMIT 1";
$resultDefaultRates = $conn->query($queryDefaultRates);

if ($resultDefaultRates && $resultDefaultRates->num_rows > 0) {
    $rowDefaultRates = $resultDefaultRates->fetch_assoc();
    $fat_rate = $rowDefaultRates["fat_rate"];
    $snf_rate = $rowDefaultRates["snf_rate"];
} else {
    $fat_rate = 0; // Set default value for fat_rate
    $snf_rate = 0; // Set default value for snf_rate
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

// Function to update rates based on milk type
function updateRates() {
    var milk_type = document.getElementById("mtype").value;

    var table_name;
    if (milk_type === "Buffalo") {
        table_name = "bfr";
    } else if (milk_type === "Cow") {
        table_name = "cfr";
    } else {
        console.error("Invalid milk type");
        return;
    }

    // Fetch rates using AJAX
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "fetch_rates.php?table_name=" + table_name, true);
    xhr.onreadystatechange = function() {
        if (xhr.readyState === 4 && xhr.status === 200) {
            var rates = JSON.parse(xhr.responseText);
            document.getElementById("fat_rate").value = rates.fat_rate;
            document.getElementById("snf_rate").value = rates.snf_rate;
            calculateRate(); // Recalculate total rate
        }
    };
    xhr.send();
}

// Function to calculate rate
function calculateRate() {
    // Get input values
    var fatPercentage = parseFloat(document.getElementById("fat").value);
    var snfPercentage = parseFloat(document.getElementById("snf").value);
    var fatPrice = parseFloat(document.getElementById("fat_rate").value);
    var snfPrice = parseFloat(document.getElementById("snf_rate").value);

    // Fixed quantity
    var quantity = 1;  // Fixed at 1 litre

    // Calculate the price of milk
    var fatPricePortion = (fatPercentage / 100) * quantity * fatPrice;
    var snfPricePortion = (snfPercentage / 100) * quantity * snfPrice;

    var totalPrice = fatPricePortion + snfPricePortion;

    // Display the total price
    document.getElementById("rate").value = totalPrice.toFixed(1);
}
</script>

    <body>


<h3><a href="collection1.php">Back</a></h3>
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
                   <select name="mtype" id="mtype" onchange="updateRates()">
        <option value="Buffalo" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Buffalo') echo 'selected'; ?>>Buffalo</option>
    <option value="Cow" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Cow') echo 'selected'; ?>>Cow</option>
</select>

                </td>


                   <td><input type="text" value="<?php echo $date; ?>" name="date"></td>
                   <td><input type="text" value="<?php echo $session; ?>" name="session"></td>
                </tr>
                <tr align="center"><th id="36">FAT</th><th id="37" >SNF</th><th id="35" >QTY (LTR)</th><th id="38">RATE</th><th id="39" >TOTAL</th></tr>
                <tr align="centre">
                
                <td><input type="text" name="fat" id="fat" value="<?php echo isset($_POST['fat']) ? $_POST['fat'] : ''; ?>" oninput="calculateRate()"></td>
                <td><input type="text" name="snf" id="snf" value="<?php echo isset($_POST['snf']) ? $_POST['snf'] : ''; ?>" oninput="calculateRate()"></td>
                <td><input type="text" name="qty" id="qty" value="<?php echo isset($qty) ? $qty : ''; ?>" oninput="calculateTotal()" ></td>
                <td><input type="text" name="rate" id="rate" value="<?php echo isset($_POST['rate']) ? $_POST['rate'] : ''; ?>" oninput="calculateTotal()"></td>



                <td><input type="text" name="total" id="total" placeholder="Total" value="<?php echo isset($total) ? $total : ''; ?>" readonly></td>
                
                <input type="hidden" name="fat_rate" id="fat_rate"  value="<?php echo $fat_rate; ?>" oninput="calculateRate()">
                <input type="hidden" name="snf_rate" id="snf_rate"  value="<?php echo $snf_rate; ?>" oninput="calculateRate()">
                    
                    
                </tr>
                <tr align="center"> <td colspan="6">
                

                <input class="btn" style="background-color: orange" type="submit" value="Insert" name="insert" size="5"/>

                <input class="btn" style="background-color: orange" type="reset" value="Clear" name="clear" size="5"/>
                <input class="btn" style="background-color: orange" type="submit" value="Fetch Qty" name="fetch_qty" size="9"/>
                <input class="btn" style="background-color: orange" type="button" value="calculate" name="searchdata" size="5" onclick="calculateTotal()" />

            </td></tr>
            </table>


            <div class="table1">
    <table border="1" cellspacing="3" cellpadding="3" align="center">
        <caption id="51"><strong>DAILY-MILK-COLLECTION-DETAILS</strong></caption>
        <tr>
            <th id="42">DATE</th>
            <th>SESSION</th>
            <th id="53">MILK TYPE</th>  
            <th id="55">FAT</th>
            <th id="56">SNF</th>
            <th id="54">QTY/LTR</th>
            <th id="57">RATE</th>
            <th id="58">TOTAL</th>
            <th>DELETE</th>
        </tr>

        <?php
            
$query = "SELECT * FROM collection_report";
            
$result = mysqli_query($conn, $query);

while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr align='center'>";
    echo "<td>{$row['cdate']}</td>";
    echo "<td>{$row['csession']}</td>";
    echo "<td>{$row['mtype']}</td>";
    echo "<td>{$row['fat']}</td>";
    echo "<td>{$row['snf']}</td>";
    echo "<td>{$row['qty']}</td>";
    echo "<td>{$row['rate']}</td>";
    echo "<td>{$row['total']}</td>";
    echo "<td>";
    echo "<form method='POST' action=''>";
    echo "<input type='hidden' name='delete_id' value='{$row['cdate']}'>";
    echo "<input type='hidden' name='csession' value='{$row['csession']}'>"; // Hidden field for csession
    echo "<input type='hidden' name='mtype' value='{$row['mtype']}'>";       // Hidden field for mtype
    echo "<button type='submit' name='delete' style='background-color: transparent; border: none; color: red; cursor: pointer;'>Delete</button>";
    echo "</form>";
    echo "</td>";
    echo "</tr>";
}
mysqli_free_result($result);

if (isset($_POST['delete'])) {
    $delete_id = $_POST['delete_id'];

    // Delete the rows from the database based on cdate, csession, and mtype
    $query = "DELETE FROM collection_report WHERE cdate = ? AND csession = ? AND mtype = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sss", $delete_id, $_POST['csession'], $_POST['mtype']); // Change "i" to "s" and bind additional parameters
    $stmt->execute();
    
}
?>

    </table>
</div>


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
