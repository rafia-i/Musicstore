<?php

$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'musicstore'; 

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch tracks added in the last month
$sql = "SELECT trackID, name, price, composed_date
        FROM tracks 
        WHERE composed_date BETWEEN DATE_FORMAT(CURDATE() - INTERVAL 1 MONTH, '%Y-%m-01') 
                                AND CURDATE()";

$result = $conn->query($sql);
$recentTracks = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $recentTracks[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recent Tracks</title>
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
        .track span {
            margin-right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Tracks Added in the Last Month</h1>

    <?php if (!empty($recentTracks)): ?>
        <?php foreach ($recentTracks as $track): ?>
            <div class="track">
                <span><strong><?php echo htmlspecialchars($track['name']); ?></strong></span>
                <span><?php echo $track['price']; ?> tk</span>
                <span>Added on: <?php echo $track['composed_date']; ?></span>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No tracks have been added in the last month.</p>
    <?php endif; ?>
</div>
</body>
</html>
