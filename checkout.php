<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['trackIDs'], $_POST['paymentMethod'])) {
        $trackIDs = $_POST['trackIDs']; // Comma-separated track IDs
        $paymentMethod = $_POST['paymentMethod']; // Selected payment method
    } else {
        echo "Missing data. Please try again.";
        exit;
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Track</title>
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
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }
        input[type="password"] {
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
            color: white;
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
    <form action="invoice.php" method="POST">
        <!--password confirm-->
        <label for="password">To confirm your purchase please fill in your password</label><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>

        <input type="hidden" name="trackIDs" value="<?php echo htmlspecialchars($trackIDs); ?>">
        <input type="hidden" name="paymentMethod" value="<?php echo htmlspecialchars($paymentMethod); ?>">
        <button type="submit">Submit</button>
    </form></div>
</body>
</html>