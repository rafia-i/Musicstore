<!--yakub-->
<?php
session_start();
require_once('DBconnect.php');

if (isset($_GET['trackID'])) {
    $trackID = intval($_GET['trackID']);

    $sql = "SELECT t.name, a.name AS artist_name FROM tracks t INNER JOIN artist a ON t.artistID = a.artistID WHERE t.trackID = $trackID";
    $result = mysqli_query($conn, $sql);
    $track = mysqli_fetch_assoc($result);
    
    $commentSql = "SELECT c.comment, cu.name, c.date FROM comment c JOIN customer cu ON c.customerID = cu.ID WHERE c.trackID = $trackID ORDER BY c.commentID DESC";
    $commentsResult = mysqli_query($conn, $commentSql);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Comments</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #4CAF50;
        }
        h2 {
            text-align: center;
            color: #4CAF50;
        }
        .comment-list {
            list-style-type: none;
            padding-left: 0;
        }
        .comment-list li {
            background-color: #f9f9f9;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }
        .comment-details {
            font-size: 14px;
            color: #555;
        }
        .comment-text {
            font-size: 16px;
            color: #333;
            margin-top: 5px;
        }
        .back-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-align: center;
            display: block;
            margin: 20px auto;
        }
        .back-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Comments for Track: <?php echo htmlspecialchars($track['name']); ?></h1>
    <h2>Artist: <?php echo htmlspecialchars($track['artist_name']); ?></h2>

    <ul class="comment-list">
        <?php
        if (mysqli_num_rows($commentsResult) > 0) {
            while ($comment = mysqli_fetch_assoc($commentsResult)) {
                $formattedDate = date("F j, Y, g:i a", strtotime($comment['date']));               
                echo "<li>";
                echo "<div class='comment-details'>";
                echo "<strong>" . htmlspecialchars($comment['name']) . "</strong><br>";
                echo "<span>" . $formattedDate . "</span>";
                echo "</div>";
                echo "<div class='comment-text'>" . htmlspecialchars($comment['comment']) . "</div>";
                echo "</li>";
            }
        } else {
            echo "<li>No comments yet for this track.</li>";
        }
        ?>
    </ul>

    <form action="bought.php" method="POST">
        <button class="back-button" type="submit">Back to Purchased Tracks</button>
    </form>
</div>

</body>
</html>

<?php
mysqli_close($conn);
?>