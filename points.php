<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');


$sql = "SELECT trackID, name, price FROM tracks";
$result = $conn->query($sql);
$tracks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $tracks[] = $row;
    }
}

// Handle purchase request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ID'])) {
    $userId = $_POST['ID']; 
    $trackId = (int)$_POST['track_id'];

    // Fetch user points
    $userSql = "SELECT points FROM customers WHERE id = $userId";
    $userResult = $conn->query($userSql);
    $user = $userResult->fetch_assoc();

    // Fetch track price
    $trackSql = "SELECT price FROM tracks WHERE id = $trackId";
    $trackResult = $conn->query($trackSql);
    $track = $trackResult->fetch_assoc();

    if ($user && $track && $user['points'] >= $track['price']) {
        // Deduct points
        $newPoints = $user['points'] - $track['price'];
        $updateUserSql = "UPDATE customer SET points = $newPoints WHERE id = $userId";
        $conn->query($updateUserSql);

        // Log purchase
        //$insertPurchaseSql = "INSERT INTO purchases (user_id, trackID) VALUES ($userId, $trackId)";
        //$conn->query($insertPurchaseSql);

        $message = "Track purchased successfully!";
    } else {
        $message = "Not enough points to buy this track.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buy Tracks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .track {
            display: flex;
            justify-content: space-between;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background: #f9f9f9;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 3px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .message {
            text-align: center;
            color: #28a745;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Buy Tracks</h1>

    <?php if (isset($message)): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <?php foreach ($tracks as $track): ?>
        <div class="track">
            <span><?php echo htmlspecialchars($track['name']); ?></span>
            <span><?php echo $track['price']; ?> points</span>
            <form action="invoice.php" method="POST" style="margin: 0;">
                <input type="hidden" name="trackID" value="<?php echo $track['trackID']; ?>">
                <button type="submit">Buy</button>
            </form>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
