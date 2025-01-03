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
        .view-favourites-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 15px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
            display: inline-block;
            text-align: center;
        }
        .view-favourites-btn:hover {
            background-color: #45a049;
        }
        p {
            font-size: 16px;
            margin: 15px 0;
        }
        p.success {
            color: green;
        }
        p.error {
            color: red;
        }
    </style>
</head>
<body>

<div class="container">
    <?php
    session_start();
    require_once('DBconnect.php');

    if (isset($_SESSION['ID']) && isset($_POST['artistID'])) {
        $customerID = $_SESSION['ID'];
        $artistID = $_POST['artistID'];
        $sql = "SELECT * FROM favourites WHERE customerID = $customerID AND artistID = $artistID";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) === 0) {
            $val = "INSERT INTO favourites (customerID, artistID) VALUES ($customerID, $artistID)";
            if (mysqli_query($conn, $val)) {
                echo "<p class='success'>Artist successfully added to your favourites!</p>";
            } else {
                echo "<p class='error'>Error: Could not add artist to favourites. Please try again later.</p>";
            }
        } else {
            echo "<p class='error'>This artist is already in your favourites.</p>";
        }
    } else {
        echo "<p class='error'>Invalid request. Please make sure you are logged in and have selected an artist.</p>";
    }
    ?>

    <form action="favourite-artists.php" method="get">
        <button type="submit" class="view-favourites-btn">View your favourite artists list</button>
    </form>
</div>

</body>
</html>