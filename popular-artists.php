<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}

require_once('DBconnect.php');
$sql = "SELECT a.artistID, a.name, COUNT(f.artistID) AS popularity FROM favourites f INNER JOIN artist a ON f.artistID = a.artistID GROUP BY f.artistID HAVING COUNT(f.artistID) >= 1 ORDER BY popularity DESC";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Artists</title>
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
        h1, h2 {
            text-align: center;
        }
        .artist-section {
            margin-bottom: 20px;
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
        }
        .track-item {
            margin: 10px 0;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ccc;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .add-to-cart-btn, .add-to-favorites-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 5px;
        }
        .add-to-cart-btn:hover, .add-to-favorites-btn:hover {
            background-color: #45a049;
        }
        .button-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }

        .add-to-favorites-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
            font-size: 16px;
        }

        .add-to-favorites-btn:hover {
            background-color: #45a049;
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
    <h1>Popular Artists</h1>
    <?php if (mysqli_num_rows($result) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
            $artistID = htmlspecialchars($row['artistID'], ENT_QUOTES, 'UTF-8');
            $artistName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $popularity = $row['popularity'];
            $sqlTracks = "SELECT trackID, name AS track_name, price FROM tracks WHERE artistID = $artistID";
            $resultTracks = mysqli_query($conn, $sqlTracks);
            ?>
            <div class="artist-section">
                <h2><?= $artistName ?> (Favorited <?= $popularity ?> times)</h2>
                <form action="add-favourite-artist.php" method="POST" >
                    <input type="hidden" name="artistID" value="<?= $artistID ?>">
                    <div class="button-container">
                        <button type="submit" class="add-to-favorites-btn">Add to Favorites</button>
                    </div>
                </form>
                <h3>Tracks</h3>
                <?php if (mysqli_num_rows($resultTracks) > 0): ?>
                    <ul>
                        <?php while ($track = mysqli_fetch_assoc($resultTracks)): ?>
                            <?php
                            $trackID = htmlspecialchars($track['trackID'], ENT_QUOTES, 'UTF-8');
                            $trackName = htmlspecialchars($track['track_name'], ENT_QUOTES, 'UTF-8');
                            $trackPrice = htmlspecialchars($track['price'], ENT_QUOTES, 'UTF-8');
                            ?>
                            <li class="track-item">
                                <?= $trackName ?> - BDT <?= $trackPrice ?>
                                <form action="cart.php" method="POST">
                                    <input type="hidden" name="trackID" value="<?= $trackID ?>">
                                    <button type="submit" class="add-to-cart-btn">Add to Cart</button>
                                </form>
                            </li>
                        <?php endwhile; ?>
                    </ul>
                <?php else: ?>
                    <p>No tracks available for this artist.</p>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <p>No popular artists yet.</p>
    <?php endif; ?>
</div>
<div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>
</body>
</html>