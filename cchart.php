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
        max-height: 200px; /* Set maximum height */
        overflow-y: auto; /* Add vertical scroll if content exceeds the height */
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
    </style>
</head>
<body>

    <h3><a href="index.php">HOME</a></h3>
    <h3><a href="collection.php">Collection</a></h3>

    <?php
    $mysql = mysqli_connect("localhost", "root", "");
    mysqli_select_db($mysql, "db");
    ?>
    <div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
    <h2 id="22" align="center">ADD COW RATE CHART</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <table border="1" cellspacing="5" cellpadding="5" align="center">
            <tr><th>No</th><th id="23">Cow Fat</th><th id="24">S.N.F</th><th id="25">Cow Rate</th><th>Action</th></tr>
            <tr>
                <td><input type="text" name="no" id="no" size="20" maxlength="20"/></td>
                <td><input type="text" name="cfat" id="cfat" size="20" maxlength="20"/></td>
                <td><input type="text" name="csnf" id="csnf" size="20" maxlength="20"/></td>
                <td><input type="text" name="crate" id="crate" size="20"/></td>
                <td><input type="submit" style="background-color: red" name="delete_btn" value="Delete"/></td>
            </tr>
            <tr align="center">
                <td colspan="5">
                    <input style="background-color: orange" type="submit" value="Insert" size="5"/>
                    <input style="background-color: orange" type="reset" value="Cancel" size="5"/>
                </td>
            </tr>
        </table>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if(isset($_POST["delete_btn"])) {
            $delete_no = $_POST["no"];
            mysqli_query($mysql, "DELETE FROM crate WHERE no='$delete_no'");
        } else {
            if (isset($_POST["no"])) {
                $no = $_POST["no"];
            } else {
                $no = "";
            }
            if (isset($_POST["cfat"])) {
                $fat = $_POST["cfat"];
            } else {
                $cfat = "";
            }
            if (isset($_POST["csnf"])) {
                $snf = $_POST["csnf"];
            } else {
                $csnf = "";
            }
            if (isset($_POST["crate"])) {
                $rate = $_POST["crate"];
            } else {
                $crate = "";
            }
            if ($no && $fat && $snf && $rate) {
                mysqli_query($mysql, "INSERT INTO crate VALUES('$no','$fat','$snf','$rate')");
            }
        }
    ?>
    <table border="1" cellspacing="5" cellpadding="5" align="center">
        <h3 align="center"><strong>COW-FAT-n-RATE-CHART-DETAILS</strong></h3>
        <tr><th>No</th><th>COW FAT</th><th>COW SNF</th><th>COW RATE</th><th>Action</th></tr>

        <?php
        $result3 = mysqli_query($mysql, "SELECT * FROM crate ORDER BY no ");
        while ($array = mysqli_fetch_row($result3)) {
            echo "<tr align='center'>";
            echo "<td>$array[0]</td>";
            echo "<td>$array[1]</td>";
            echo "<td>$array[2]</td>";
            echo "<td>$array[3]</td>";
            echo "<td><form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='POST'><input type='hidden' name='no' value='$array[0]'/><input type='submit' style='background-color: red' name='delete_btn' value='Delete'/></form></td>";
            echo "</tr>";
        }
        mysqli_free_result($result3);
        mysqli_close($mysql);
    }
    ?>
    </table>
</body>
<script src="js/cc.js" defer></script>
</html>