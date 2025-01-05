<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Songs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
        .container {
            background-color: #45a049;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 8px;
        }
        .container_again {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(2, 128, 52, 0.76);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #f4f4f4;
        }

        ul {
            list-style-type: none;
            padding-left: 0;
        }

        li {
            background-color: #f9f9f9;
            padding: 10px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ddd;
        }

        a {
            color: #4CAF50;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        form {
            margin-top: 10px;
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            font-size: 14px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        input[type="hidden"] {
            display: none;
        }

        .no-result {
            text-align: center;
            font-size: 18px;
            color: #888;
        }

        .search-results {
            margin-top: 20px;
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
    <h1>We guess you were looking for...</h1>
</div>

<div class="container_again">

<?php
require_once('DBconnect.php');
if(isset($_POST['search_term'])) {
    $u = $_POST['search_term'];
    $sql = "SELECT t.name AS trackName, t.link AS trackLink, t.trackID AS trackID, t.price AS trackPrice, a.name AS artistName FROM tracks t JOIN artist a ON t.artistID = a.artistID WHERE t.name LIKE '%$u%' ORDER BY t.name";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) != 0) {
        echo "<ul class='search-results'>"; 

        while ($row = mysqli_fetch_assoc($result)) {
            $trackName = htmlspecialchars($row['trackName'], ENT_QUOTES, 'UTF-8');
            $artistName = htmlspecialchars($row['artistName'], ENT_QUOTES, 'UTF-8');
            $ytLink = htmlspecialchars($row['trackLink'], ENT_QUOTES, 'UTF-8');
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            $trackPrice = htmlspecialchars($row['trackPrice'], ENT_QUOTES, 'UTF-8');
            
            echo "<li>";
            echo "<h3> $trackName by $artistName - <a href='$ytLink' target='_blank'>Watch preview</a></h3>";
            echo "<p>Price: BDT $trackPrice</p>";

            echo "<form action='cart.php' method='POST'>
                    <input type='hidden' name='trackID' value='$trackID'>
                    <button type='submit'>Add to cart</button>
                </form>";
            echo "</li><br>";
        }

        echo "</ul>";
    } else {
        echo "<div class='no-result'>Song doesn't exist</div>";
    }
}
?>

<div class="btn-container">
        <form action="home.php" method="POST">
            <button class="back-button" type="submit">Back to home</button>
        </form>
</div>


</div>
</body>
</html>