<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT t.trackID, t.name, t.audio_path, IFNULL(AVG(r.rating), 10) AS average_rating FROM tracks t JOIN invoice i ON i.trackID = t.trackID JOIN customer c ON i.customerID = c.ID LEFT JOIN ratings r ON r.trackID = t.trackID WHERE c.ID = $ID GROUP BY t.trackID ORDER BY t.name";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchased Tracks</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1000px;
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
        .track-list {
            list-style-type: none;
            padding-left: 0;
        }
        .track-list li {
            background-color: #f9f9f9;
            padding: 15px;
            margin: 12px 0;
            border-radius: 8px;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: row;
            align-items: center;
            justify-content: space-between;
        }
        .track-info {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            width: 60%;
        }
        .track-info h3 {
            margin: 0;
            font-size: 1.2em;
            color: #333;
        }
        .audio-player {
            width: 100%;
            margin-top: 10px;
        }
        .rating-form {
            display: none;
            width: 100%;
        }
        .rating-comment-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            width: 35%;
        }
        .average-rating {
            font-size: 1em;
            color: #777;
            margin-bottom: 15px;
        }
        .rating-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: 15px;
        }
        .rate-trigger {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            font-size: 14px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
            box-sizing: border-box;
        }
        .rate-trigger:hover {
            background-color: #45a049;
        }
        .rating-options {
            display: flex;
            gap: 8px;
            margin-top: 10px;
            flex-wrap: wrap;
        }
        .rating-options label {
            font-size: 1.1em;
        }
        .comment-section {
            margin-top: 20px;
        }
        .comment-form {
            display: flex;
            flex-direction: row;
            align-items: right;
            gap: 10px;
        }
        .comment-form textarea {
            width: 100%;
            resize: none;
        }
        .comment-button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .comment-button:hover {
            background-color: #45a049;
        }
        .view-comments {
            text-decoration: none;
            color: #4CAF50;
            margin-top: 10px;
        }
        .view-comments:hover {
            text-decoration: underline;
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
        .report-section {
            margin-top: 15px;
        }
        .report-button {
            background-color: #ff4d4d;
            color: white;
            padding: 5px 10px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .report-button:hover {
            background-color: #e04343;
        }

    </style>
</head>
<body>

    <div class="container">
        <h1>Your Purchased Tracks</h1>
        <ul class="track-list">
            <?php
            if (mysqli_num_rows($result) > 0) {
                // Loop through the result and display track names
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<li>";
                    echo "<div class='track-info'>";
                    echo "<h3>" . htmlspecialchars($row['name']) . "</h3>";
                    echo "<span> 🎶 </span>";
                    echo "<audio class='audio-player' controls>
                            <source src='" . htmlspecialchars($row['audio_path']) . "' type='audio/mpeg'>
                          </audio>";
                          echo "<form action='confirming.php' method='POST'>
            <input type='hidden' name='trackID' value='" . $row['trackID'] . "'>
            <button type='submit'>Add to your playlist</button>
            </form>";

            echo "<br>";
                    echo "</div>";

                    echo "<div class='rating-comment-container'>";
                    echo "<div class='average-rating'>Average Rating: " . round($row['average_rating'], 2) . "</div>";

                    // Rating Section
                    echo "<div class='rating-section'>";
                    echo "<button class='rate-trigger' onclick='showRatingForm(\"rate-form-" . $row['trackID'] . "\")'>Rate this Track</button>";

                    echo "<form id='rate-form-" . $row['trackID'] . "' class='rating-form' action='add-rating.php' method='POST'>";
                    echo "<input type='hidden' name='trackID' value='" . $row['trackID'] . "'>";
                    echo "<div class='rating-options'>";
                    for ($i = 1; $i <= 10; $i++) {
                        echo "<label>";
                        echo "<input type='radio' name='rating' value='$i' required> $i";
                        echo "</label>";
                    }
                    echo "</div class='rating-section'>";
                    echo "<button type='submit' class='rating-button'>Submit Rating</button>";
                    echo "</form>";
                    echo "</div>";

                    // Comment Section
                    echo "<div class='comment-section'>";
                    echo "<form class='comment-form' action='add-comment.php' method='POST'>";
                    echo "<input type='hidden' name='trackID' value='" . $row['trackID'] . "'>";
                    echo "<textarea name='comment' placeholder='Add a comment...' required></textarea>";
                    echo "<button type='submit' class='comment-button'>Comment</button>";
                    echo "</form>";
                    echo "<a class='view-comments' href='comment.php?trackID=" . $row['trackID'] . "'>View Comments</a>";
                    echo "</div>";
                    // Report Button Section
                    echo "<div class='report-section'>";
                    echo "<form class='report-form' action='submit_report.php' method='POST'>";
                    echo "<input type='hidden' name='trackID' value='" . $row['trackID'] . "'>";
                    echo "<textarea name='Report' placeholder='Description...' required></textarea>";
                    echo "<button type='submit' class='report-button'>Report Track</button>";
                    echo "</form>";
                    echo "</div>";

                    echo "</div>";
                    echo "</li>";
                }
            } else {
                echo "<li>No tracks found for your account.</li>";
            }
            ?>
        </ul>
    </div>

    <script>
    document.querySelectorAll('.audio-player').forEach(player => {
        player.addEventListener('play', function() {
            document.querySelectorAll('.audio-player').forEach(otherPlayer => {
                if (otherPlayer !== player) {
                    otherPlayer.pause();
                    otherPlayer.currentTime = 0; 
                }
            });
        });
    });

    function showRatingForm(formId) {
        document.querySelectorAll('.rating-form').forEach(form => {
            form.style.display = 'none';
        });
        document.getElementById(formId).style.display = 'block';
    }
    </script>

    <div class="btn-container">
        <form action="home.php" method="POST">
            <button class="back-button" type="submit">Back to home</button>
        </form>
    </div>

</body>
</html>