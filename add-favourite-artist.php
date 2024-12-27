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
            echo "<p>Artist successfully added to your favourites!</p>";
        } else {
            echo "<p>Error: Could not add artist to favourites. Please try again later.</p>";
        }
    } else {
        echo "<p>This artist is already in your favourites.</p>";
    }   
} else {
    echo "<p>Invalid request. Please make sure you are logged in and have selected an artist.</p>";
}
?>
