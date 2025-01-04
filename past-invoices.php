<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT i.invoiceID, t.name AS track_name, a.name AS artist_name, i.date, i.paymentmethod, i.totalprice FROM invoice i JOIN tracks t ON i.trackID = t.trackID JOIN artist a ON i.artistID = a.artistID WHERE i.customerID = $ID ORDER BY i.invoiceID, i.date";

$result = mysqli_query($conn, $sql);

$invoices = [];
$totalPrice = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $invoiceID = $row['invoiceID'];
    if (!isset($invoices[$invoiceID])) {
        $invoices[$invoiceID] = [
            'date' => $row['date'],
            'paymentMethod' => $row['paymentmethod'],
            'Price' => $row['price'],
            'tracks' => []
        ];
        $totalPrice += $row['price'];
    }
    $invoices[$invoiceID]['tracks'][] = $row['track_name'] . " by " . $row['artist_name'];
}

mysqli_free_result($result);
mysqli_close($conn);

?>
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .invoice-container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            text-align: center;
            color: #4CAF50;
        }
        .invoice-section {
            margin-bottom: 20px;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
        }
        .invoice-details, .tracks-list {
            margin-top: 10px;
        }
        .invoice-details p {
            margin: 5px 0;
        }
        .tracks-list ul {
            list-style: none;
            padding-left: 0;
        }
        .tracks-list li {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .total-price {
            font-size: 1.1em;
            font-weight: bold;
            color: #e53935;
            margin-top: 10px;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 0.9em;
            color: #888;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            text-decoration: none;
        }
        .back-button:hover {
            background-color: #45a049;
        }
        .all-invoices-total {
            font-size: 1.2em;
            font-weight: bold;
            color: #000;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class='invoice-container'>
        <h1>Invoices</h1>
        <?php foreach ($invoices as $invoiceID => $invoice): ?>
            <div class='invoice-section'>
                <h2>Invoice ID: <?php echo htmlspecialchars($invoiceID); ?></h2>
                <div class='invoice-details'>
                    <p><strong>Date:</strong> <?php echo htmlspecialchars($invoice['date']); ?></p>
                    <p><strong>Payment Method:</strong> <?php echo htmlspecialchars($invoice['paymentMethod']); ?></p>
                </div>
                <div class='tracks-list'>
                    <h3>Tracks:</h3>
                    <ul>
                        <?php foreach ($invoice['tracks'] as $track): ?>
                            <li><?php echo htmlspecialchars($track); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class='total-price'>
                    <p>Price: <?php echo number_format($invoice['Price'], 2); ?> BDT</p>
                </div>
            </div>
        <?php endforeach; ?>

        <div class='all-invoices-total'>
            <p>Total Spent: <?php echo number_format($totalPrice, 2); ?> BDT</p>
        </div>

        <div class='btn-container'>
            <form action='home.php' method='POST'>
                <button class='back-button' type='submit'>Back to Home</button>
            </form>
        </div>
    </div>
</body>
</html>
