<?php
require_once('DBconnect.php');

$sql = "SELECT i.trackID, t.name AS track_name, a.name AS artist_name, COUNT(i.trackID) AS purchase_count FROM invoice i INNER JOIN artist a ON i.artistID = a.artistID INNER JOIN tracks t ON t.trackID = i.trackID GROUP BY t.trackID HAVING purchase_count > 0 ORDER BY purchase_count DESC;";
$result = mysqli_query($conn, $sql)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Tracks</title>
    <link rel="stylesheet" href="styles.css">
    <style>    
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        .artist-section {
            margin-bottom: 20px;
        }
        .track-list ul {
            list-style: none;
            padding: 0;
        }
        .track-list li {
            background: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-to-cart-btn, .remove-artist-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-to-cart-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Popular Tracks</h1>
    <div class="track-list">
        <ul>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<span><strong>" . $row['track_name'] . "</strong> by " . $row['artist_name'] . " (Purchased: " . $row['purchase_count'] . " times)</span>";
                    ?>
                    <form action="cart.php" method="post">
                        <input type="hidden" name="trackID" value="<?php echo $row['trackID']; ?>">
                        <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                    </form>
                    <?php
                    echo "</li>";
                }
            } else {
                echo "<li>No tracks found.</li>";
            }
            ?>
        </ul>
    </div>
</div>

</body>
</html>