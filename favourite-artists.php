<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT a.name AS artist_name, t.name AS track_name, t.trackID, a.artistID FROM tracks t INNER JOIN artist a ON t.artistID = a.artistID INNER JOIN favourites f ON a.artistID = f.artistID WHERE f.customerID = $ID and t.composed_date<=NOW()";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favourite Artists</title>
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
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            
        }
        .add-to-cart-btn:hover {
            transform: scale(1.05);
            background-color: #45a049;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
        }
        .remove-artist-btn {
            background-color: #f44336;
        }
        .remove-artist-btn:hover {
            transform: scale(1.05);
            background-color: #d32f2f;
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.3);
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
    </style>
</head>
<body>
<div class="container">
    <h1>My Favourite Artists</h1>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php 
        $currentArtist = null;
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)): 
            $artistName = htmlspecialchars($row['artist_name'], ENT_QUOTES, 'UTF-8');
            $trackName = htmlspecialchars($row['track_name'], ENT_QUOTES, 'UTF-8');
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            $artistID = htmlspecialchars($row['artistID'], ENT_QUOTES, 'UTF-8');

            if ($artistName !== $currentArtist):
                if ($currentArtist !== null):
                    echo '</ul></div></div>';
                endif;
        ?>
                <div class="artist-section">
                    <h2>
                        <?= $artistName ?>
                        <form action="confirming-removal.php" method="POST" style="display: inline;">
                            <input type="hidden" name="artistID" value="<?= $artistID ?>">
                            <button type="submit" class="remove-artist-btn">Remove Artist</button>
                        </form>
                    </h2>
                    <div class="track-list">
                        <ul>
                <?php $currentArtist = $artistName; ?>
            <?php endif; ?>

            <li>
                <?= $trackName ?>
                <form action="cart.php" method="POST" style="display: inline;">
                    <input type="hidden" name="trackID" value="<?= $trackID ?>">
                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                </form>
            </li>
        <?php endwhile; ?>
            </ul>
        </div>
    <?php else: ?>
        <p>You have no favorite artists yet!</p>
    <?php endif; ?>
    <div class="btn-container">
        <form action="home.php" method="POST">
            <button class="back-button" type="submit">Back to home</button>
        </form>
    </div>
</div>
</body>
</html>