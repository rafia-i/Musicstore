<?php
require_once('DBconnect.php');
$query = "SELECT * FROM invoice";
$result = mysqli_query($conn, $query);
function displayTransactions($result, $title) {
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<h2>$title</h2>";
        echo "<table>
                <tr>
                    <th>Invoice ID</th>
                    <th>Customer ID</th>
                    <th>Amount</th>
                    <th>Transaction Date</th>
                </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . htmlspecialchars($row['invoiceID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['customerID'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['totalprice'], ENT_QUOTES, 'UTF-8') . "</td>
                    <td>" . htmlspecialchars($row['date'], ENT_QUOTES, 'UTF-8') . "</td>
                </tr>";
        }
        echo "</table>";
    } else {
        echo "<h2>$title</h2><p>No transactions found.</p>";
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaction Overview</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f9f9f9;
            color: #333;
        }

        h2 {
            color: #4CAF50;
            margin-top: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            background: #fff;
        }

        table th, table td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }

        table th {
            background-color: #f4f4f4;
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        p {
            font-size: 1rem;
            color: #555;
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
    </style>
</head>
<body>
    <h1>Transaction Overview</h1>
    <?php
        displayTransactions($result, "Transactions in the Last Month");
    ?>
    <div class='btn-container'>
    <form action='Home-admin.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>
</body>
</html>