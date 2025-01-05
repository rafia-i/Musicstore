<?php
// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "musicstore";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture form data
    $name = $_POST['name'];
    $mediatype = $_POST['mediatype'];
    $genreID = $_POST['genreID'];
    $artistID = $_POST['artistID'];
    $length = $_POST['length'];
    $price = $_POST['price'];
    $size = $_POST['size'];
    $composed_date = $_POST['composed_date'];
    $link = $_POST['link'];
    $audio_path = $_POST['audio_path'];

    // Insert data into the database
    $sql = "INSERT INTO tracks (name, mediatype, genreID, artistID, length, price, size, composed_date, link, audio_path) 
            VALUES ('$name', '$mediatype', '$genreID', '$artistID', '$length', '$price', '$size', '$composed_date', '$link', '$audio_path')";

    if ($conn->query($sql) === TRUE) {
        echo "New track added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Track</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 400px;
        }
        .form-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }
        .form-container label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        .form-container input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        .form-container button:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Add New Track</h1>
        <form method="POST" action="">
            <label for="name">Track Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="mediatype">Media Type:</label>
            <select id="type" name="type" required>
                <option value="MP3">MP3</option>
                <option value="WAV">WAV</option>
                <option value="3GP">3GP</option>
            </select><br><br>

            <label for="genreID">Genre ID:</label>
            <select id="genreID" name="genreID" required>
                <option value="1">Pop</option>
                <option value="2">Rock</option>
                <option value="3">r&b</option>
                <option value="4">Country</option>
                <option value="5">Jazz</option>
                <option value="6">Classical</option>
            </select><br><br>

            <label for="artistID">Artist ID:</label>
            <input type="number" id="artistID" name="artistID" required>

            <label for="length">Length:</label>
            <input type="text" id="length" name="length" required>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" required>

            <label for="size">Size:</label>
            <input type="text" id="size" name="size" required>

            <label for="composed_date">Composed Date:</label>
            <input type="date" id="composed_date" name="composed_date" required>

            <label for="link">Link:</label>
            <input type="url" id="link" name="link">

            <label for="audio_path">Audio Path:</label>
            <input type="text" id="audio_path" name="audio_path">

            <button type="submit">Add Track</button>
        </form>
    </div>
</body>
</html>
