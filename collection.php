<?php
include("connection.php");
?>


<!-- <?php


// Fetch date and session from the database
$query = "SELECT cdate, csession FROM ctime ORDER BY cdate DESC LIMIT 1";
$result = mysqli_query($conn, $query);

$date = 'cdate';
$session = 'csession';

// Check if there is a result
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $date = $row['cdate'];
    $session = $row['csession'];
}
?> -->



<?php
// Fetch Division
$query = "SELECT dname FROM division";
$result = mysqli_query($conn,  $query);

$dname = 'dname';

if(mysqli_num_rows($result)  > 0){ 
    $row = mysqli_fetch_assoc($result);
    $dname = $row['dname'];
}
?>

<?php
    if(isset( $_POST['searchdata']))
        {
            $search = $_POST['search'];
            

            $query = "SELECT * from customer where id = '$search' ";
            $data = mysqli_query($conn, $query);
            
            $result = mysqli_fetch_assoc($data);

            // $name = $result['name'];
        }
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



<!DOCTYPE html>
<html>
    <head>
        <title>Daily Milk Collection</title>
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
input[type="text"], input[type="submit"], input[type="reset"] {
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

/* Animation styles */

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
    <body class="a">

    <div style="text-align: right;">
    <button onclick="newcustomer()" style="background-color: green; color: white;">New Customer</button>
    <button id="customerbutton" style="background-color: red; color: white;">All Customer</button>
    <button onclick="report()" style="background-color: green; color: white;">Customer Report</button>
    <button id="loanbutton" style="background-color: red; color: white;">Loan</button>
    <button onclick="crate()" style="background-color: green; color: white;">Cow Rate</button>
    <button onclick="brate()" style="background-color: green; color: white;">Buffalo Rate</button>
    <button id="billingButton" style="background-color: red; color: white;">Billing</button>
    <button onclick="confirmCollectionReport()" style="background-color: red; color: white;">Collection Report</button>
</div>

<script>
document.getElementById("billingButton").addEventListener("click", function() {
    var password = prompt("Please enter the password:");
    if (password === "1234") {
        window.location.href = "customerbill.php";
    } else {
        alert("Incorrect password. Please try again.");
    }
});

document.getElementById("loanbutton").addEventListener("click", function() {
    var password = prompt("Please enter the password:");
    if (password === "1234") {
        window.location.href = "loan_app.php";
    } else {
        alert("Incorrect password. Please try again.");
    }
});

document.getElementById("customerbutton").addEventListener("click", function() {
    var password = prompt("Please enter the password:");
    if (password === "1234") {
        window.location.href = "allcustomer.php";
    } else {
        alert("Incorrect password. Please try again.");
    }
});
    function confirmCollectionReport() {
        var confirmation = confirm("Are you sure the collection is fully completed?");
        if (confirmation) {
            window.location.href = 'collectionreport.php'; // Redirect if user selects "Yes"
        } else {
            // Do nothing or provide feedback to the user
        }
    }
    function crate() {
        window.location.href = 'cchart.php';
    }
    function brate() {
        window.location.href = 'bchart.php';
    }
    function report() {
        window.location.href = 'customer_wise_report.php';
    }
    function newcustomer() {
        window.location.href = 'newcustomer.php';
    }
</script>


        <h3><a href="index.php">HOME</a></h3>
        <div class="table1">
        <h1 id="31" align="center">DAILY MILK COLLECTION</h1>
        
        <form action="#" method="POST">
            <table border="1" cellspacing="6" cellpadding="6" align="center" class="table0" >
                <tr align="center">
                    <th id="32">CUSTOMER ID</th>
                    <th id="33" colspan="3">NAME</th>
                    <th id="34" >MILK TYPE</th>
                    
                    <th id="42">DATE</th>
                </tr>
                <tr align="center">
                <td>
                    <input type="text" name="search" placeholder="ID" value="<?php if(isset($_POST['searchdata'])){echo $result['id'];}?>">
                   </td>
                   <td colspan="3"><input type="text" name="name" id="name" value="<?php if(isset($_POST['searchdata'])){echo $result['name'];}?>"></td>
                   <td><input type="text" name="mtype" id="mtype" value="<?php if(isset($_POST['searchdata'])){echo $result['mtype'];}?>"></td>

                   <input type="hidden" name="mobile" id="mobile" value="<?php if(isset($_POST['searchdata'])){echo $result['mobile'];}?>">
                   
                   <td><input type="text" value="<?php echo $date; ?>" name="date"></td>
                </tr>
                <tr align="center"><th id="36">FAT</th><th id="37" >SNF</th><th id="35" >QTY (LTR)</th><th id="38">RATE</th><th id="39" >TOTAL</th><th  id="43">Session</th></tr>
                <tr align="centre">
                
                <td><input type="text" name="fat" id="fat" value="<?php echo isset($_POST['fat']) ? $_POST['fat'] : ''; ?>"></td>
                <td><input type="text" name="snf" id="snf" value="<?php echo isset($_POST['snf']) ? $_POST['snf'] : ''; ?>"></td>
                <td><input type="text" name="qty" id="qty" value="<?php echo isset($_POST['qty']) ? $_POST['qty'] : ''; ?>" oninput="calculateTotal()"></td>
                <td><input type="text" name="rate" id="rate" value="<?php echo isset($rate) ? $rate : ''; ?>" oninput="calculateTotal()"></td>

                <td><input type="text" name="total" id="total" placeholder="Total" value="<?php echo isset($total) ? $total : ''; ?>" readonly></td>
                <td><input type="text" value="<?php echo $session; ?>" name="session"></td>
                    
                    
                    
                </tr>
                <tr align="center"> <td colspan="6">
                <input class="btn" style="background-color: orange" type="submit" value="Search" name="searchdata" size="5"/>

                <input class="btn" style="background-color: orange" type="submit" value="Insert" name="insert" size="5"/>

                <input class="btn" style="background-color: orange" type="reset" value="Clear" name="clear" size="5"/></td></tr>
            </table>

            <?php


if(isset($_POST['insert'])){
    // Validate form fields
    if(empty($_POST['search']) || empty($_POST['qty']) || empty($_POST['mtype']) || empty($_POST['fat']) || empty($_POST['snf']) || empty($_POST['rate']) || empty($_POST['total'])) {
        echo "<script>alert('All fields are required / Collection Details are Displayed...');</script>";
    } else {
        // Form fields are not empty, proceed with insertion
        $date = $_POST["date"];
        $session = $_POST["session"];
        $id = $_POST["search"];
        $qty = $_POST["qty"];
        $mtype = $_POST["mtype"];
        $fat = $_POST["fat"];
        $snf = $_POST["snf"];
        $rate = $_POST["rate"];
        $total = $_POST["total"];
        $mobile = $_POST["mobile"];

    
        // Check if the data for the current date, session, and customer ID already exists in the database
        $query = "SELECT * FROM collection WHERE cdate = '$date' AND csession = '$session' AND id = '$id'";
        $result = mysqli_query($conn, $query);
    
        // If the data doesn't exist, insert the new data
        if(mysqli_num_rows($result) == 0){
            mysqli_query($conn, "INSERT INTO collection(`cdate`, `csession`, `id`, `mtype`, `qty`, `fat`, `snf`, `rate`, `total`) VALUES ('$date','$session','$id','$mtype','$qty','$fat','$snf','$rate','$total')");
        }
    }

$message = [
    "secret" => "013f68c4bc65af3258e89bad88b67eb9ca85f338", // your API secret from (Tools -> API Keys) page
    "mode" => "devices",
    "device" => "00000000-0000-0000-8eaa-b10d44c3e4e3",
    "sim" => 1,
    "priority" => 1,
    "phone" => "+91$mobile", // Specify the phone number to which you want to send the SMS
    "message" => "Collected Milk TYPE:$mtype, FAT:$fat, SNF:$snf, QTY:$qty, TOTAL:$total." // Your SMS message content
];

$cURL = curl_init("https://www.cloud.smschef.com/api/send/sms");
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $message);
$response = curl_exec($cURL);
curl_close($cURL);

$result = json_decode($response, true);

// Check the status and message in the response
if ($result['status'] == 200) {
    echo "<p align=\"center\">Message has been queued for sending!</p>";
} else {
    echo "<p>Error: " . $result['message'] . "</p>";
}
}
?>

<?php
if(isset($_POST['insert'])){
    // Get the value and ID from the form
    $numberFromForm = floatval($_POST['total']); // Convert to float
    $idFromForm = $_POST['search'];

    // Fetch the existing number from the database based on the ID
    $query = "SELECT balance FROM customer WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $idFromForm);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $numberFromDatabase = floatval($row['balance']); // Convert to float

        // Add the number from the form to the number from the database
        $sum = $numberFromDatabase + $numberFromForm;

        // Update the database with the new sum
        $updateQuery = "UPDATE customer SET balance = ? WHERE id = ?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("di", $sum, $idFromForm); // Use 'd' for double/float
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo " Balance updated in the database.";
        } else {
            echo "Error updating number in the database.";
        }
    } else {
        
    }
}
?>


<?php
// Calculate total milk collected and total rate for buffaloes by date and session
$queryBuffalo = "SELECT SUM(qty) AS total_qty, SUM(total) AS total_rate FROM collection WHERE mtype = 'Buffalo' AND cdate = '$date' AND csession = '$session'";
$resultBuffalo = mysqli_query($conn, $queryBuffalo);
$rowBuffalo = mysqli_fetch_assoc($resultBuffalo);
$totalMilkBuffalo = $rowBuffalo['total_qty'];
$totalRateBuffalo = $rowBuffalo['total_rate'];
?>     

<?php
// Calculate total milk collected and total rate for cows by date and session
$queryCow = "SELECT SUM(qty) AS total_qty, SUM(total) AS total_rate FROM collection WHERE mtype = 'Cow' AND cdate = '$date' AND csession = '$session'";
$resultCow = mysqli_query($conn, $queryCow);
$rowCow = mysqli_fetch_assoc($resultCow);
$totalMilkCow = $rowCow['total_qty'];
$totalRateCow = $rowCow['total_rate'];
?>

<?php
// Calculate the total milk by summing buffaloes and cows
$totalMilk = $totalMilkBuffalo + $totalMilkCow;

// Calculate the total rate by summing buffaloes and cows
$totalRate = $totalRateBuffalo + $totalRateCow;
?>

            </div>
            <h1 align="center" id="40">LIVE</h1>
<div class="table2">
    <table border="1">
        <tr><th id="41" colspan="2">Division</th></tr>
        <tr><td colspan="2"><input type="text" value="<?php echo $dname; ?>" name="dname"></td></tr>

        <tr><th id="45" colspan="2">Buffalo</th></tr>
        <tr><th id="46" >Litre</th><th id="47" >Total Rate</th></tr>
        <tr><td><input type="text" value="<?php echo $totalMilkBuffalo; ?>" readonly></td><td><input type="text" value="<?php echo $totalRateBuffalo; ?>" readonly></td></tr>

        <tr><th id="48" colspan="2">Cow</th></tr>
        <tr><th id="49" >Litre</th><th id="50" >Total Rate</th></tr>
        <tr><td><input type="text" value="<?php echo $totalMilkCow; ?>" readonly></td><td><input type="text" value="<?php echo $totalRateCow; ?>" readonly></td></tr>

        <tr><th colspan="2">Total</th></tr>
        <tr><th>Total Milk</th><th>Total Rate</th></tr>
        <tr><td><input type="text" value="<?php echo $totalMilk; ?>" readonly></td><td><input type="text" value="<?php echo $totalRate; ?>" readonly></td></tr>
    </table>
</div>
        </form>

 <div>
 <?php
// Query the 'customer' table to get all customer data including mtype
$query = "SELECT id, name, mtype FROM customer";
$result = mysqli_query($conn, $query);
$customers = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Fetch the date and session from the form or use a default value
$selected_date = isset($_POST['date']) ? $_POST['date'] : date('Y-m-d'); // assuming the date is being posted from the form
$selected_session = isset($_POST['session']) ? $_POST['session'] : 'Morning'; // assuming the session is being posted from the form

// Query the 'collection' table to get all customer IDs for which data has been collected for the selected date and session
$query = "SELECT DISTINCT id, mtype FROM collection WHERE cdate = ? AND csession = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $selected_date, $selected_session);
$stmt->execute();
$result = $stmt->get_result();
$collected_data = $result->fetch_all(MYSQLI_ASSOC);

// Separate customers into collected and remaining lists based on mtype, date, and session
$cow_collected_customers = [];
$cow_remaining_customers = [];
$buffalo_collected_customers = [];
$buffalo_remaining_customers = [];

foreach ($customers as $customer) {
    $customer_id = $customer['id'];
    $mtype = $customer['mtype'];

    $collected = false;
    foreach ($collected_data as $data) {
        if ($customer_id == $data['id'] && $mtype == $data['mtype']) {
            $collected = true;
            break;
        }
    }

    if ($mtype == 'Cow') {
        if ($collected) {
            $cow_collected_customers[] = $customer;
        } else {
            $cow_remaining_customers[] = $customer;
        }
    } elseif ($mtype == 'Buffalo') {
        if ($collected) {
            $buffalo_collected_customers[] = $customer;
        } else {
            $buffalo_remaining_customers[] = $customer;
        }
    }
}
?>

<div style="text-align: center;">
    <button onclick="showTable('cow_collected')">Show Cow Collected Table</button>
<button onclick="showTable('cow_remaining')">Show Cow Remaining Table</button>
<button onclick="showTable('buffalo_collected')">Show Buffalo Collected Table</button>
<button onclick="showTable('buffalo_remaining')">Show Buffalo Remaining Table</button>
</div>


<div id="cow_collected" class="hidden">
    <!-- Display cow milk collected customers -->
    <h2 align="center">Cow Milk Collected Customers (Total: <?php echo count($cow_collected_customers); ?>)</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Milk Type</th>
        </tr>
        <?php foreach ($cow_collected_customers as $customer): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['mtype']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div id="cow_remaining" class="hidden">
    <!-- Display cow milk remaining customers -->
    <h2 align="center">Cow Milk Remaining Customers (Total: <?php echo count($cow_remaining_customers); ?>)</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Milk Type</th>
        </tr>
        <?php foreach ($cow_remaining_customers as $customer): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['mtype']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<div id="buffalo_collected" class="hidden">
    <!-- Display buffalo milk collected customers -->
    <h2 align="center">Buffalo Milk Collected Customers (Total: <?php echo count($buffalo_collected_customers); ?>)</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Milk Type</th>
        </tr>
        <?php foreach ($buffalo_collected_customers as $customer): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['mtype']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>


<div id="buffalo_remaining" class="hidden">
    <!-- Display buffalo milk remaining customers -->
    <h2 align="center">Buffalo Milk Remaining Customers (Total: <?php echo count($buffalo_remaining_customers); ?>)</h2>
    <table>
        <tr>
            <th>Customer ID</th>
            <th>Customer Name</th>
            <th>Milk Type</th>
        </tr>
        <?php foreach ($buffalo_remaining_customers as $customer): ?>
            <tr>
                <td><?php echo $customer['id']; ?></td>
                <td><?php echo $customer['name']; ?></td>
                <td><?php echo $customer['mtype']; ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</div>

<script>
    function showTable(id) {
        // Hide all tables
        var tables = document.querySelectorAll('div[id^="cow_"], div[id^="buffalo_"]');
        tables.forEach(function(table) {
            table.classList.add('hidden');
        });

        // Show the selected table
        document.getElementById(id).classList.remove('hidden');
    }
</script>

<style>
    .hidden {
        display: none;
    }
</style>


 </div>

<?php
ob_start(); // Start output buffering
?>


<div class="table1">
    <table border="1" cellspacing="3" cellpadding="3" align="center">
        <caption id="51"><strong>DAILY-MILK-COLLECTION-DETAILS</strong></caption>
        <tr>
            <th id="42">DATE</th>
            <th>SESSION</th>
            <th id="52">CUSTOMER ID</th>
            <th id="53">MILK TYPE</th>
            <th id="54">QTY/LTR</th>
            <th id="55">FAT</th>
            <th id="56">SNF</th>
            <th id="57">RATE</th>
            <th id="58">TOTAL</th>
            <th>DELETE</th>
        </tr>

        <?php
            $selected_date = isset($_POST['date']) ? $_POST['date'] : ''; // assuming the date is being posted from the form
            $selected_session = isset($_POST['session']) ? $_POST['session'] : ''; // assuming the session is being posted from the form
            
            $query = "SELECT id, cdate, csession, mtype, qty, fat, snf, rate, total
                      FROM collection
                      WHERE cdate = '$selected_date' AND csession = '$selected_session'";
            
            $result = mysqli_query($conn, $query);

            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr align='center'>";
                echo "<td>{$row['cdate']}</td>";
                echo "<td>{$row['csession']}</td>";
                echo "<td>{$row['id']}</td>"; // Assuming 'id' is the customer id
                echo "<td>{$row['mtype']}</td>";
                echo "<td>{$row['qty']}</td>";
                echo "<td>{$row['fat']}</td>";
                echo "<td>{$row['snf']}</td>";
                echo "<td>{$row['rate']}</td>";
                echo "<td>{$row['total']}</td>";
                echo "<td>";
                echo "<form method='POST' action=''>";
                echo "<input type='hidden' name='delete_id' value='{$row['id']}'>";
                echo "<button type='submit' name='delete' style='background-color: transparent; border: none; color: red; cursor: pointer;'>Delete</button>";
                echo "</form>";
                echo "</td>";
                echo "</tr>";
            }
            mysqli_free_result($result);

            if (isset($_POST['delete'])) {
                $delete_id = $_POST['delete_id'];

                // Delete the rows from the database
                $query = "DELETE FROM collection WHERE id = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("i", $delete_id);
                $stmt->execute();

                // Redirect back to the original page
                
                exit();
            }
        ?>
    </table>
</div>

<?php
ob_end_flush(); // End output buffering and flush the output
?>


            
</body>
    <script src="js/c.js" defer></script>
</html>
<!-- <?php
    if($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the values from the form
        $qty = $_POST['qty'];
        $rate = $_POST['rate'];
    
        // Calculate the total
        $total = $qty * $rate;
    }
?> -->