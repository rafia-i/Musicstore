<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

if (isset($_GET['tracks'])) {
    $trackIDs = explode(',', $_GET['tracks']); // Retrieve track IDs from query string
} else {
    echo "No tracks selected for payment.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            display: block;
            width: 100%;
            padding: 10px;
            font-size: 16px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-transform: uppercase;
        }
        button:hover {
            background-color: #45a049;
        }
        .hidden-input {
            display: none;
        }
    </style>
</head>
<body>
<div class="container">
    <label for="paymentMethod">Choose your payment method</label>
    <form id="paymentMethod" action="checkout.php" method="POST">
        <select id="paymentMethod", name="paymentMethod">
            <option value="Mastercard">Mastercard</option>
            <option value="Bkash">Bkash</option>
            <option vallue="Nagad">Nagad</option>           
        </select>
        <input type="hidden" name="trackIDs" value="<?php echo htmlspecialchars(implode(',', $trackIDs)); ?>">
        <button type="submit">Submit</button>
        </form></div>
    
</body>
</html>