<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application</title>
    <style>
        .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 16px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
        }
        .menu {
            text-align: center;
            margin-top: 20px;
        }
        .menu a {
            display: inline-block;
            padding: 10px 20px;
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            background-color: #f0f0f0;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .menu a:hover {
            background-color: #ddd;
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
</head>
<body class="a" >
<h3 ><a href="index.php">HOME</a></h3>
<h3><a href="collection1.php">Collection</a></h3>
<div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
    <h2>Loan Application Home Page</h2>
    <div class="container">
        
        <div class="menu">
            <a href="loan_registration.php">Loan Registration</a>
            <a href="emi_payment.php">EMI Payment</a>
            <a href="loan_management.php">Loan Management</a>
            <a href="loan_report.php">Loan Report</a>
        </div>
    </div>
</body>
</html>
