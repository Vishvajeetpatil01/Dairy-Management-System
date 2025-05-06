
<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>All Customer Information</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
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
    text-align: center;
    margin-bottom: 20px;
}

input[type="text"],
button {
    padding: 8px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
}

button {
    background-color: #4CAF50;
    color: white;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

button:hover {
    background-color: #45a049;
}

table {
    border-collapse: collapse;
    width: 80%;
    margin: 0 auto;
    background-color: #fff;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.5s ease;
}

caption {
    background-color: #333;
    color: #fff;
    font-weight: bold;
    padding: 10px;
}

th, td {
    padding: 12px 15px;
    text-align: center;
    border: 1px solid #ddd;
}

th {
    background-color: #333;
    color: #fff;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}

tr:hover {
    background-color: #e0e0e0;
    transition: background-color 0.3s ease;
}

a {
    color: red;
    text-decoration: none;
    transition: color 0.3s ease;
}
h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }

a:hover {
    color: #ff6f00;
}

@keyframes fadeIn {
    0% {
        opacity: 0;
    }
    100% {
        opacity: 1;
    }
}
    </style>
</head>
<body class="a">
    <h3><a href="index.php">HOME</a></h3>
    <h3><a href="collection1.php">Collection</a></h3>
    <div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>

    <!-- Search form -->
    <form action="" method="POST">
        <label for="search">Search:</label>
        <input type="text" id="search" name="search">
        <button type="submit">Search</button>
    </form>

    <table border="1" cellspacing="5" cellpadding="5" align="center">
        <caption><strong id="73">DAIRY-CUSTOMER-DETAILS</strong></caption>
        <tr align="center">
            <th id="74">CUSTOMER ID</th>
            <th id="75">CUSTOMER NAME</th>
            <th id="76">ADDRESS</th>
            <th id="77">MOBILE</th>
            <th id="78">MILK TYPE</th>
            <th>Balance</th>
            <th>Password</th>
            <th>Action</th>
        </tr>
        
        <?php
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

// Query to fetch all customer information
$sql = "SELECT * FROM customer WHERE 1=1"; // 1=1 ensures that the WHERE clause can be appended without checking if it's the first condition

if(isset($_POST['search']) && !empty($_POST['search'])){
    $search = $_POST['search'];
    // Check if search input is numeric, if yes, search by ID or mobile number, else search by name
    if(is_numeric($search)) {
        $sql .= " AND (id = $search OR mobile = $search)";
    } else {
        $sql .= " AND (name LIKE '%$search%' OR mobile LIKE '%$search%')";
    }
}

$result = $conn->query($sql);

// If there are rows in the result, display them in the table
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<tr align='center'>";
        echo "<td>" . $row["id"] . "</td>";
        echo "<td>" . $row["name"] . "</td>";
        echo "<td>" . $row["address"] . "</td>";
        echo "<td>" . $row["mobile"] . "</td>";
        echo "<td>" . $row["mtype"] . "</td>";
        echo "<td>" . $row["balance"] . "</td>";
        echo "<td>" . $row["password"] . "</td>";
        echo "<td><a href='delete_customer.php?id=" . $row["id"] . "'>Delete</a> | <a href='update_customer.php?id=" . $row["id"] . "'>Update</a></td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='6'>No records found</td></tr>";
}

$result = $conn->query($sql);
    // Get the count of searched customers
    $count = $result->num_rows;
    echo "<p style='text-align: center;'>Total customers: $count</p>";

$conn->close();
?>


    </table>
    <!-- <script src="js/ac.js" defer></script> -->
</body>
</html>
