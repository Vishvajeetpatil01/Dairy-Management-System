<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Report</title>
    <style>
         .a {
            background-image: url(img/5.jpg);
            background-size: cover;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            width: 60%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
        }
        .report-options {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }
        .report-options li {
            margin-bottom: 10px;
        }
        .report-options li button {
            padding: 10px 20px;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .report-options li button:hover {
            background-color: #0056b3;
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
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
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
    <h2>Select Type Of Report</h2>

    <div class="container">
        
        <ul class="report-options">
            <li><button onclick="location.href='daily_report.php'">Daily Report</button></li>
            <li><button onclick="location.href='customer_wise_report.php'">Customer Wise Report</button></li>
        </ul>
    </div>
</body>
</html>
