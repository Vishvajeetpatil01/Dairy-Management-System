<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Collection Time</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
            margin: 50px;
            background-image: url("img/5.jpg");
            background-size: cover;
            background-attachment: fixed;
            color: #fff;
        }

        h3 a {
            color: #333 ;
            text-decoration: navy ;
        }

        h3 a:hover {
            text-decoration: underline;
        }

        h2 {
            margin-bottom: 20px;
            color: black;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
        }

        input,
        select {
            width: 50%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        button {
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button.clear {
            background-color: #f44336;
        }

        button:hover,
        button.clear:hover {
            background-color: #45a049;
        }
         .a{
                 background-image: url(img/5.jpg);
                 background-size: cover;
            }
            h1 {
            text-align: center;
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
        input[type="date" i] {
            width: 80%;
            padding: 6px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
}
    </style>
</head>

<body>
    <h3><a href="index.php">HOME</a></h3>
    <div style="text-align: center; margin-bottom: 10px; margin-top: 0;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>
    <h2 id="26">Collection Time</h2>
    <form id="collectionForm" action="save_time.php" method="post">
        <label id="27" for="date">Select Date:</label>
        <input type="date" id="date" name="date" required>

        <label id="28" for="session">Select Session:</label>
        <select id="session" name="session">
            <option value="1-Morning">Morning</option>
            <option value="2-Evening">Evening</option>
        </select>

        <button type="submit">Continue</button>
        <button type="button" class="clear" onclick="clearForm()">Clear</button>
    </form>

    <script>
        function clearForm() {
            // Handle clear button click
            document.getElementById("date").value = "";
            document.getElementById("session").value = "morning";
        }
    </script>
</body>
<!-- <script src="js/ct.js" defer></script> -->
</html>
