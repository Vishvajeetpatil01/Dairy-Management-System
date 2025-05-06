<?php
    // Clear login data
    session_start();
    
    // remove all session variables
    session_unset(); 

    // destroy the session 
    session_destroy(); 
    
    // Start session again
    session_start();
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>User Login</title>
    <style>
        .a {
            background-image: url(img/24.jpg);
            background-size: cover;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .jk {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #ji {
            text-align: center;
        }

        h1 {
            color: #333;
        }

        form {
            margin-top: 20px;
        }

        p {
            margin: 10px 0;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        input[type="submit"],
        input[type="reset"] {
            background-color: orange;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover,
        input[type="reset"]:hover {
            background-color: darkorange;
        }

        #jj {
            text-align: center;
        }

        #footer {
            text-align: center;
            color: #fff;
            padding: 10px;
            font-size: 14px;
            background-color: #333;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body class="a">
    <div class="jk">
        <div id="ji">
            <h1> Dairy Login </h1>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                <p> <b> User name<br /><input type="text" placeholder="Enter Username" name="user" /></b></p>
                <p> <b>Password<br /><input type="password" placeholder="Enter Password" name="password" /></b></p>
                <p> <input style="background-color: orange" type="submit" value="Login" /> <input style="background-color: orange" type="reset" value="Clear" /></p>
            </form>
        </div>
        <div id="jj">
            <p><a href="self.php">Customer Login</a></p>
        </div>
    </div>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $user = $_POST["user"];
        $password = $_POST["password"];

        if ($user && $password) {
            $mysql = mysqli_connect("localhost", "root", "");
            mysqli_select_db($mysql, "db");

            $result1 = mysqli_query($mysql, "SELECT * FROM login WHERE user='$user' and password='$password'");
            $count = mysqli_num_rows($result1);
            mysqli_free_result($result1);
            if ($count == 1) {
                $_SESSION['User'] = $user;
                header("location:index.php");
            } else {
                echo "<script>alert('Wrong username or password');</script>";
            }
        }
    }
    ?>

    <div id="footer" >
    Developed by Visvajeet Patil, Pruthviraj Gharage, Pranav Kamble, Jivan Kamble under guidance of Miss Jadhav
    </div>
    
</body>
</html>