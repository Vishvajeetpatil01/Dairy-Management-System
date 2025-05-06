<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dairy System</title>
</head>

<body bgcolor="#FFFF66">
    <div id="header">
        <h1 id="heading">DOODHSINDHU MILKS</h1>
    </div>
    <div id="main">
        <link href="css/public.css" media="all" rel="stylesheet" type="text/css" />
        <table id="structure">
            <tr>
                <td id="navigation">
                    <ul>
                        <li id="1" class="last"><a href="newcustomer.php">Add New Customer</a></li><br />
                        <li id="2" class="last"><a href="bf.php">Buffalo Rate Chart</a></li><br />
                        <li id="3" class="last"><a href="cf.php">Cow Rate Chart</a></li><br />
                        <li id="200"  class="last"><a href="collectiontime.php">Daily Milk Collection</a></li><br />
                        <li id="201" class="last"><a href="#" onclick="promptPassword1()"> Get All Customer Information</a></li><br />
                        <li id="202" class="last"><a href="report_category.php">Report</a></li><br />
                        <li id="203" class="last"><a href="#" onclick="promptPassword()">Billing</a></li><br />
                        <li id="204" class="last"><a href="loan_app.php"> Loan </a></li><br />
                        <li id="205" class="last"><a href="login.php"> Logout</a></li><br />


                        <!-- <li class="last">
                            <select id="languageSelect" onchange="changeLanguage()">
                                <option value="en">English</option>
                                <option value="mr">Marathi</option>
                                <option value="kn">Kannada</option>
                            </select>
                        </li> -->
                    </ul>
                </td>
                <td id="page">
                    <h2 id="welcomeText">Welcome to Dairy Milk Collection</h2>
                    <img src="img/23.jpg" alt="" width="100%" height="100%" />
                </td>
            </tr>
        </table>
    </div>
    <div id="footer" title="Designed & Developed by PVJ"></div>
    <script>
        function promptPassword() {
            var password = prompt("Please enter the password:");
            if (password !== null && password === "1234") {
                window.location.href = "customerbill.php";
            } else {
                alert("Incorrect password. Please try again.");
            }
            // Prevent default link behavior
            return false;
        }

        function promptPassword1() {
            var password = prompt("Please enter the password:");
            if (password !== null && password === "1234") {
                window.location.href = "allcustomer.php";
            } else {
                alert("Incorrect password. Please try again.");
            }
            // Prevent default link behavior
            return false;
        }
    </script>
    
</body>

</html>
