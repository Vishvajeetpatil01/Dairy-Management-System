<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Customer</title>

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

    </style>
</head>
<body class="a">
                      
    <h3><a href="index.php">HOME</a></h3>
    <h3><a href="collection.php">Collection</a></h3>
    <div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
    <h1 id="17">New Customer</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <table>
            <tr>
                <th id="10">Customer No.</th>
                <th id="11"> Name</th>
                <th id="12">Address</th>
                <th id="13">Mobile</th>
                <th id="301">Password</th>
                <th id="14">Milk Type</th>
            </tr>
            <tr>
                <td align="center"><input type="text" name="id" id="id" size="20" maxlength="20" readonly/></td>
                <td><input type="text" name="name" id="name" size="20" /></td>
                <td><input type="text" name="address" id="address" size="20" /></td>
                <td><input type="text" name="mobile" id="mobile" size="10" /></td>
                <td><input type="text" name="password" id="password" size="10" /></td>
                <td>
                    <select name="mtype">
                        <option id="15">Buffalo</option>
                        <option id="16">Cow</option>
                    </select>
                </td>
            </tr>
            <tr align="center">
                <td colspan="5">
                    <input type="submit" value="Insert" size="5"/>
                    <input type="reset" value="Cancel" size="5"/>
                </td>
            </tr>
        </table>
    </form>


    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Connect to database
        $mysql = mysqli_connect("localhost", "root", ""); // host, user, password
    
        // Select database
        mysqli_select_db($mysql, 'db');
    
        // Collect post data
        $id = $_POST["id"];
        $name = $_POST["name"];
        $address = $_POST["address"];
        $mobile = $_POST["mobile"];
        $password = $_POST["password"];
        $mtype = $_POST["mtype"];
    
        // Insert to database
        if ($id && $name && $address && $mobile && $password && $mtype) {
            $sql = "INSERT INTO customer (id, name, address, mobile,password, mtype) VALUES ('$id', '$name', '$address', '$mobile','$password', '$mtype')";
            mysqli_query($mysql, $sql);
    
            // Create a new table with the mobile number as the table name
            $tableName = "customer_$id";
            $createTableSql = "CREATE TABLE IF NOT EXISTS $tableName (
                id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                cdate DATE NOT NULL,
                csession VARCHAR(10) NOT NULL,
                mtype VARCHAR(10) NOT NULL,
                qty INT(6) NOT NULL,
                fat FLOAT NOT NULL,
                snf FLOAT NOT NULL,
                rate FLOAT NOT NULL,
                total FLOAT NOT NULL
            )";
            mysqli_query($mysql, $createTableSql);
        }

        // Get next customer No
        $result2 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY id DESC");
        $num = mysqli_num_rows($result2);

        // Set to customer no input box
        $array = mysqli_fetch_row($result2);
        if ($num == 0) {
            print"<script>document.getElementById('id').value=1;</script>";
            print"<script>document.getElementById('name').focus();</script>";
        } else {
            $num = $array[0] + 1;
            print"<script>document.getElementById('id').value=$num;</script>";
            print"<script>document.getElementById('name').focus();</script>";
        }

        // Free result set
        mysqli_free_result($result2);
        $message = [
            "secret" => "", // your API secret from (Tools -> API Keys) page
            "mode" => "devices",
            "device" => "00000000-0000-0000-8eaa-b10d44c3e4e3",
            "sim" => 1,
            "priority" => 1,
            "phone" => "+91$mobile", // Specify the phone number to which you want to send the SMS
            "message" => "Hello $name your registration is successfully done in DOODHSINDHU MILKS. Your Customer ID - $id and Password - $password." // Your SMS message content
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
        }
        // } else {
        //     echo "<p>Error: " . $result['message'] . "</p>";
        // }
    
        ?>
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <caption><strong>CUSTOMER-DETAILS</strong></caption>
            <tr><th>Customer No.</th><th>Name</th><th>Address</th><th>Mobile</th><th>Milk Type</th></tr>
        <?php
        $result3 = mysqli_query($mysql, "SELECT * FROM customer ORDER BY id DESC");
        while ($array = mysqli_fetch_row($result3)) {
            print"<tr align='center'>";
            print"<td> $array[0]</td>";
            print"<td> $array[1]</td>";
            print"<td> $array[2]</td>";
            print"<td> $array[3]</td>";
            print"<td> $array[4]</td>";
            print"</tr>";
        }
        mysqli_free_result($result3);
        mysqli_close($mysql);
    }
?>

</body>
<script src="js
