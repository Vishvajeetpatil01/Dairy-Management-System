<!DOCTYPE html>
<html>
<head>
    <title>Report</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }
        /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
}

/* Form Styles */
form {
    background-color: #fff;
    padding: 20px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    margin: 0 auto;
}

h2 {
    text-align: center;
    margin-bottom: 20px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input[type="date"],
select {
    padding: 8px;
    border-radius: 3px;
    border: 1px solid #ccc;
    width: 100%;
    box-sizing: border-box;
    margin-bottom: 10px;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

input[type="submit"]:hover {
    background-color: #45a049;
}

/* Link Styles */
a {
    color: #4CAF50;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Styles */
@media (max-width: 600px) {
    form {
        padding: 10px;
    }

    input[type="date"],
    select {
        width: 100%;
    }
    
}
h3 {
    text-align: center;
}
    </style>
</head>
<body class="a">
<h3><a href="report_category.php">Back</a></h3>
<center>
    <h2> Daily Report</h2>
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
    <label >Milk Type:</label>
    <select name="mtype" id="mtype">
        <option value="Buffalo" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Buffalo') echo 'selected'; ?>>Buffalo</option>
        <option value="Cow" <?php if(isset($_POST['mtype']) && $_POST['mtype'] === 'Cow') echo 'selected'; ?>>Cow</option>
    </select>
   
    <input style="background-color: orange" type="submit" name="submit" value="Generate"/>
</form>

</body>
</html>


<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $from_date = $_POST['from_date'];
    $to_date = $_POST['to_date'];
    $from_session = $_POST['from_session'];
    $to_session = $_POST['to_session'];
    $mtype = $_POST['mtype'];

    // Fetch data from the database based on the selected criteria
    $sql = "SELECT * FROM collection_report WHERE cdate BETWEEN '$from_date' AND '$to_date' AND csession BETWEEN '$from_session' AND '$to_session' AND mtype = '$mtype'";
    $result = mysqli_query($conn, $sql);

    // Initialize total quantity and total amount variables
    $total_qty = 0;
    $total_amount = 0;

    // Store fetched data in an array
    $data = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
        
        // Calculate total quantity
        $total_qty += $row['qty'];

        // Calculate total amount
        $total_amount += $row['total'];
    }

    // Redirect to a new page for printing
$data_query = urlencode(json_encode($data));
$from_date = urlencode($from_date);
$to_date = urlencode($to_date);
$from_session = urlencode($from_session);
$to_session = urlencode($to_session);

// Additional fields
$additional_fields = array(
    'fat' => $fat,
    'snf' => $snf,
    'rate' => $rate,
    'total' => $total
);
$additional_fields_query = urlencode(json_encode($additional_fields));

header("Location: daily_report_print.php?data=$data_query&total_qty=$total_qty&total_amount=$total_amount&from_date=$from_date&to_date=$to_date&from_session=$from_session&to_session=$to_session&additional_fields=$additional_fields_query");
exit();


}
?>
