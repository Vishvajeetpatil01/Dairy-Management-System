<?php
session_start();
if (isset($_SESSION['User'])) {
    header("location:self2.php");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST["id"];
    $password = $_POST["password"];

    $mysql = mysqli_connect("localhost", "root", "");
    mysqli_select_db($mysql, "db");

    $result = mysqli_query($mysql, "SELECT * FROM customer WHERE id='$id' and password='$password'");
    $count = mysqli_num_rows($result);

    if ($count == 1) {
        $_SESSION['User'] = $id;
        header("location:self2.php");
    } else {
        echo "<script>alert('Wrong username or password');</script>";
    }
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>User Login</title>
    <!-- Your CSS styles here -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: white;
            color: white;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            padding: 20px 0;
        }

        form {
            width: 300px;
            margin: 0 auto;
            background-color: #444;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: white;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: none;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #00cc66;
            color: white;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #00994d;
        }
        h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top:0px;
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
        h2{
            color: black;
            text-align: center;
        }
    </style>
    
    
</head>
<body>
<h3><a href="login.php">BACK</a></h3>
<div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
</div>


    <h1>Doodhsindhu Milks</h1>
    <h2>Login Page</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="id">ID:</label>
        <input type="text" name="id" id="id" required/><br/><br/>
        <label for="password">Password:</label>
        <input type="password" name="password" id="password" required/><br/><br/>
        <input type="submit" value="Login"/>
    </form>
</body>
</html>