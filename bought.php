<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT t.trackID, t.name, t.audio_path FROM tracks t 
        JOIN invoice i ON i.trackID = t.trackID 
        JOIN customer c ON i.customerID = c.ID 
        WHERE c.ID = $ID 
        ORDER BY t.name";
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
        .track-list {
            list-style-type: none;
            padding-left: 0;
        }
        .track-list li {
            background-color: #f9f9f9;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
            display: flex;
            flex-direction: column;
        }
        .audio-comment {
            display: flex;
            flex-direction: row;
            align-items: flex-start;
            justify-content: space-between;
        }
        .audio-player {
            height: 30px; 
            margin-right: 10px;
        }
        .comment-section {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            margin-top: -40px;
            margin-right: 140px;
        }
        .comment-form {
            display: flex;
            flex-direction: row;
            align-items: bottom;
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
                    echo "<div class='audio-comment'>";
                    echo "<div>";
                    echo "<span>" . htmlspecialchars($row['name']) . "</span><br><br>";
                    echo "<span> 🎶 </span>";
                    echo "<audio class='audio-player' controls>
                            <source src='" . htmlspecialchars($row['audio_path']) . "' type='audio/mpeg'>
                          </audio>";
                    echo "</div>";
                    echo "<form class='comment-form' action='add-comment.php' method='POST'>";
                    echo "<input type='hidden' name='trackID' value='" . $row['trackID'] . "'>";
                    echo "<textarea name='comment' placeholder='Add a comment...' required></textarea>";
                    echo "<button type='submit' class='comment-button'>Comment</button>";
                    echo "</form>";
                    echo "</div>";

                    echo "<div class='comment-section'>";
                    echo "<a class='view-comments' href='comment.php?trackID=" . $row['trackID'] . "'>View Comments</a>";
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
    </script>

    <div class='btn-container'>
        <form action='home.php' method='POST'>
            <button class='back-button' type='submit'>Back to home</button>
        </form>
    </div>

</body>
</html>
