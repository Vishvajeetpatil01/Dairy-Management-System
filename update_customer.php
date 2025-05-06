<!DOCTYPE HTML>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Edit Customer Information</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }
    
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url(img/5.jpg);
            background-size: cover;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        h3 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            text-align: center;
        }
        label {
            font-weight: bold;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
    
</head>
<body class="a">
    <div class="container">
    <h3><a href="allcustomer.php">Back</a></h3>

    <?php
    // Check if customer ID is provided
    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $customer_id = $_GET['id'];
        
        // Connect to database
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

        // Fetch customer information
        $sql = "SELECT * FROM customer WHERE id = $customer_id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
    ?>
            <!-- Update form -->
            <form action="update_customer.php" method="POST">
                    <input type="hidden" name="customer_id" value="<?php echo $row['id']; ?>">
                    <label for="name">Name:<input type="text" id="name" name="name" value="<?php echo $row['name']; ?>"></label>
                    
                    <label for="address">Address:<input type="text" id="address" name="address" value="<?php echo $row['address']; ?>"></label>
                    
                    <label for="mobile">Mobile:<input type="text" id="mobile" name="mobile" value="<?php echo $row['mobile']; ?>"></label>
                    
                    <label for="mtype">Milk Type:<input type="text" id="mtype" name="mtype" value="<?php echo $row['mtype']; ?>"></label>

                    <label for="balance">Balance:<input type="text" id="balance" name="balance" value="<?php echo $row['balance']; ?>"></label>
                    
                    <button type="submit">Update</button>
                </form>
    <?php
        } else {
            
        }
        $conn->close();
    } 
    ?>
    <?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all necessary fields are filled
    if(isset($_POST['customer_id']) && isset($_POST['name']) && isset($_POST['address']) && isset($_POST['mobile']) && isset($_POST['mtype']) && isset($_POST['balance'])) {
        // Collect form data
        $customer_id = $_POST['customer_id'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $mobile = $_POST['mobile'];
        $mtype = $_POST['mtype'];
        $balance = $_POST['balance'];

        // Connect to database
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

        // Update customer information in the database
        $sql = "UPDATE customer SET name='$name', address='$address', mobile='$mobile', mtype='$mtype', balance='$balance' WHERE id=$customer_id";

        if ($conn->query($sql) === TRUE) {
            echo "Customer information updated successfully.";
        } else {
            echo "Error updating customer information: " . $conn->error;
        }

        $conn->close();
    } else {
        echo "All fields are required.";
    }
} else {
    
}
?>


    <script src="js/ac.js" defer></script>
</body>
</html>
