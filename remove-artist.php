<?php
session_start();
if (isset($_SESSION['ID'])) {
    $customerID = $_SESSION['ID'];
}
require_once('DBconnect.php');

if (isset($_POST['artistID'])) {
    $artistID = $_POST['artistID'];
    $sql = "DELETE FROM favourites WHERE customerID = $customerID AND artistID = $artistID";
    $message = "";
    $messageClass = "";

    if (mysqli_query($conn, $sql)) {
        $message = "Artist removed from your favourites successfully.";
        $messageClass = "success";
    } else {
        $message = "Error removing artist: " . mysqli_error($conn);
        $messageClass = "error";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Artist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .message {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
            font-size: 16px;
        }
        .message.success {
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .message.error {
            background-color: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
        }
        a:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        if (!empty($message)) {
        ?>
            <div class="message <?= $messageClass ?>">
                <?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?>
            </div>
        <?php
        }
        ?>
        <a href="favourite-artists.php">Go Back to Your Favourite Artists</a>
    </div>
</body>
</html>
