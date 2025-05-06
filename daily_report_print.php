<!DOCTYPE html>
<html>
<head>
    <style>
        /* Reset default margins and paddings */
        body {
            margin: 0;
            padding: 0;
            font-family: 'Times New Roman', Times, serif;
        }

        /* Page layout */
        @media print {
            /* Set page margins */
            @page {
                margin: 1cm;
            }

            /* Hide unnecessary elements */
            nav, footer, aside {
                display: none;
            }
        }

        /* Typography */
        h1, h2, h3, h4, h5, h6 {
            color: #333;
        }

        /* Data container */
        .data-container {
            padding: 20px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        /* Data table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }

        .data-table th, .data-table td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        .data-table th {
            background-color: #f2f2f2;
        }

        /* Total section */
        .total-section {
            margin-top: 20px;
            padding: 10px;
            background-color: #f2f2f2;
            text-align: right;
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
            color: black;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
            margin-top: 50px;
        }
    </style>
</head>
<body>

<?php
// Get total quantity and total amount from the query string
$total_qty = $_GET['total_qty'];
$total_amount = $_GET['total_amount'];

// Get selected dates and sessions from the query string
$from_date = urldecode($_GET['from_date']);
$to_date = urldecode($_GET['to_date']);
$from_session = urldecode($_GET['from_session']);
$to_session = urldecode($_GET['to_session']);

// Get additional fields from the query string and decode them
if(isset($_GET['additional_fields'])) {
    $additional_fields_query = urldecode($_GET['additional_fields']);
    $additional_fields = json_decode($additional_fields_query, true);
} else {
    $additional_fields = array(); // or handle it as per your requirement
}


// Get data from the query string and decode it
$data_query = urldecode($_GET['data']);
$data = json_decode($data_query, true);
?>

<div style="text-align: center; margin-bottom: 10px;">
    <img src="img/logo1.png" alt="Doodhsindhu Milks Logo" style="width: auto; max-height: 120px;">
    </div>

    <h1 align="center" style="margin-top: 0;">DOODHSINDHU MILKS</h1>

<!-- Display selected dates and sessions -->
<h2>Selected Dates and Sessions</h2>
<p>From Date: <?php echo $from_date; ?></p>
<p>To Date: <?php echo $to_date; ?></p>
<p>From Session: <?php echo $from_session; ?></p>
<p>To Session: <?php echo $to_session; ?></p>

<!-- Display fetched data in a table -->
<h2>Fetched Data</h2>
<table class="data-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Session</th>
            <th>Type</th>
            <th>Quantity</th>
            <th>Fat</th>
            <th>SNF</th>
            <th>Rate</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data as $row): ?>
            <tr>
                <td><?php echo $row['cdate']; ?></td>
                <td><?php echo $row['csession']; ?></td>
                <td><?php echo $row['mtype']; ?></td>
                <td><?php echo $row['qty']; ?></td>
                <td><?php echo $row['fat']; ?></td>
                <td><?php echo $row['snf']; ?></td>
                <td><?php echo $row['rate']; ?></td>
                <td><?php echo $row['total']; ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- Display total quantity and total amount -->
<div class="total-section">
    <p>Total Quantity: <?php echo $total_qty; ?></p>
    <p>Total Amount: <?php echo $total_amount; ?></p>
</div>

<!-- Print button -->
<a href="#" class="print-button" onclick="window.print();">Print</a>

</body>
</html>
