<!DOCTYPE html>
<html>
<head>
    <title>Printable Report</title>
    <style>
        /* Your CSS for styling the printable version */
        /* Example styles, modify as needed */
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        /* Print button */
        .print-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #333;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
            text-align: center;
        }

        .print-button:hover {
            background-color: #555;
        }

        h1 {
            text-align: center;
        }

        .totals {
  text-align: right;
  margin-bottom: 20px;
  margin-right: 20px;
}

        .customer-info {
  display: flex;
  flex-wrap: wrap;
  justify-content: space-between;
  margin-bottom: 20px;
}

.customer-info div {
  flex-basis: 25%;
  margin-bottom: 10px;
}

.customer-info div p {
  margin: 5px 0;
  line-height: 1.4;
}

@media print {
  .customer-info {
    border: 1px solid #ccc;
    padding: 10px;
  }

  .customer-info div {
    flex-basis: 33.33%;
  }

  .customer-info div p {
    margin: 8px 0;
  }
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
    <div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>

    <?php
    // Retrieve parameters passed from the form submission
    $data_query = urldecode($_GET['data_query']);
    $total_qty = $_GET['total_qty'];
    $total_amount = $_GET['total_amount'];
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];
    $from_session = $_GET['from_session'];
    $to_session = $_GET['to_session'];
    $id = $_GET['id'];
    $mtype = $_GET['mtype'];
    $address = $_GET['address'];
    $name = $_GET['name'];
    $mobile = $_GET['mobile'];
    $balance = $_GET['balance'];
    ?>

<div class="customer-info">
  <div>
   <p><strong>Customer ID:</strong> <?php echo $id; ?></p>
    <p><strong>Customer Name:</strong> <?php echo $name; ?></p>
    <p><strong>Address:</strong> <?php echo $address; ?></p>
  </div>
  <div>
    <p><strong>Mobile Number:</strong> <?php echo $mobile; ?></p>
    <p><strong>Milk Type:</strong> <?php echo $mtype; ?></p>
    
  </div>
  <div>
    <p><strong>From :</strong> <?php echo $from_date; ?></p>
    <p><strong></strong> <?php echo $from_session; ?></p>
    <p><strong>To:</strong> <?php echo $to_date; ?></p>
    <p><strong></strong> <?php echo $to_session; ?></p>
  </div>
</div>

    <p><strong>Collection Details</strong></p>
    <table>
        <tr>
            <th>Date</th>
            <th>Session</th>
            <!-- <th>Milk Type</th> -->
            <th>Fat</th>
            <th>SNF</th>
            <th>Quantity</th>
            <th>Rate</th>
            <th>Total</th>
        </tr>
        <?php
        // Split the $data_query string by the <br> tag
        $rows = explode("<br>", $data_query);

        // Loop through each row and extract the data
        foreach ($rows as $row) {
            if (!empty($row)) {
                $data = explode(" - ", $row);
                echo "<tr>";
                echo "<td>" . substr($data[0], 6) . "</td>"; // Date
                echo "<td>" . substr($data[1], 9) . "</td>"; // Session
                // echo "<td>" . $data[2] . "</td>"; // Milk Type
                echo "<td>" . $data[3] . "</td>"; // Fat
                echo "<td>" . $data[4] . "</td>"; // SNF
                echo "<td>" . $data[5] . "</td>"; // Quantity
                echo "<td>" . $data[6] . "</td>"; // Rate
                echo "<td>" . $data[7] . "</td>"; // Total
                echo "</tr>";
            }
        }
        ?>
    </table>

    <div class="totals">
  <p><strong>Total Quantity :</strong> <?php echo $total_qty; ?> Litre</p>
  <p><strong>Total Amount : ₹</strong> <?php echo $total_amount; ?></p>
  <p><strong>Balance:₹</strong> <?php echo $balance; ?></p>
   </div>

    <!-- Button to print the page -->
    <a href="#" class="print-button" onclick="window.print();">Print</a>
</body>
</html>