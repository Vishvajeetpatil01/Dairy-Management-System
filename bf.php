<?php
    session_start();
    if (!isset($_SESSION['User'])){
        header("location:login.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Account</title>
    <style>
        /* General Styles */
        body {
            background-image: url(img/5.jpg);
            background-size: cover;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            color: #333;
        }

        table {
            width: 60%;
            max-height: 200px;
            overflow-y: auto;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            font-size: 14px;
        }

        th {
            background-color: #333;
            color: #fff;
        }

        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
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

    <script>
        function calculateSNF() {
            // Get the fat price from the input field
            var fatPrice = parseFloat(document.getElementById("rate").value);

            // Calculate the SNF price (2/3 of fat price)
            var snfPrice = (2/3) * fatPrice;

            // Display the SNF price
            document.getElementById("snf").value = snfPrice.toFixed();

            // Return false to prevent the form from submitting automatically
            return false;
        }

        // Add event listener to calculate SNF when fat rate input changes
        document.getElementById("rate").addEventListener("input", calculateSNF);
    </script>
</head>
<body>

<h3><a href="index.php">HOME</a></h3>
<h3><a href="collection1.php">Collection</a></h3>

<?php
$mysql = mysqli_connect("localhost", "root", "");
mysqli_select_db($mysql, "db");
?>

<div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
</div>

<h1 align="center">DOODHSINDHU MILKS</h1>
<h2 align="center">UPDATE BUFFALO FAT RATE</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" >
    <table border="1" cellspacing="5" cellpadding="5" align="center">
        <tr>
            <th>Buffalo Fat Rate</th>
            <th>Buffalo SNF Rate</th>
        </tr>
        <tr>
            <td><input type="text" name="rate" id="rate" size="20" oninput="calculateSNF()"></td>
            <td><input type="text" name="snf" id="snf" size="20" oninput="calculateSNF()"></td>
        </tr>
        <tr align="center">
            <td colspan="2">
                <input style="background-color: orange" type="submit" value="Update" />
                <input style="background-color: orange" type="reset" value="Cancel" />
            </td>
        </tr>
    </table>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["rate"]) && isset($_POST["snf"])) {
    $brate = $_POST["rate"];
    $snf = $_POST["snf"];
        if (!empty($brate)) {
            $mysql = mysqli_connect("localhost", "root", "");
            mysqli_select_db($mysql, "db");

            // Check if the record exists
            $check_query = mysqli_query($mysql, "SELECT * FROM bfr WHERE id = 1");
            if (mysqli_num_rows($check_query) > 0) {
                // Update the existing record
                mysqli_query($mysql, "UPDATE bfr SET fat_rate = '$brate', snf_rate = '$snf' WHERE id = 1");
            } else {
                // Insert a new record
                mysqli_query($mysql, "INSERT INTO bfr (fat_rate, snf_rate) VALUES ('$brate', '$snf')");
            }
        }
    }

?>

<table border="1" cellspacing="5" cellpadding="5" align="center">
    <caption><strong>BUFFALO FAT RATE</strong></caption>
    <tr>
        <th>BUFFALO FAT RATE</th><th>BUFFALO SNF RATE</th>
    </tr>
    <?php
        $result3 = mysqli_query($mysql, "SELECT * FROM bfr ORDER BY id ");
        while ($array = mysqli_fetch_row($result3)) {
            echo "<tr align='center'>";
            echo "<td>$array[1]</td>";
            echo "<td>$array[2]</td>";
            echo "</tr>";
        }
        mysqli_free_result($result3);
        mysqli_close($mysql);
    ?>
</table>

</body>
</html>
