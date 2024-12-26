<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT t.name from tracks t join invoice i on i.trackID=t.trackID join customer c on i.customerID=c.ID  WHERE c.ID = $ID";
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
        }
        .track-list li:hover {
            background-color: #e9e9e9;
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
                            
        }
        .back-button {
            background-color: #4CAF50; /* Green */
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
            background-color: #45a049; /* Darker green */
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
                    echo "<li>" . htmlspecialchars($row['name']) . "</li>";
                }
            } else {
                echo "<li>No tracks found for your account.</li>";
            }
            ?>
        </ul>
    </div>
    <div class='btn-container'>
            <form action='home.php' method='POST'>
            <button class='back-button' type='submit'>Back to home</button>
    </form></div>

</body>
</html>