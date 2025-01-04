<?php
session_start();
require_once('DBconnect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $trackID = $_POST['trackID'];
    $rating = $_POST['rating'];
    $customerID = $_SESSION['ID'];

    $checkSql = "SELECT * FROM ratings WHERE trackID = $trackID AND customerID = $customerID";
    $checkResult = mysqli_query($conn, $checkSql);

    if (mysqli_num_rows($checkResult) > 0) {
        echo "You have already rated this track.";
    } else {
        $sql = "INSERT INTO ratings (trackID, customerID, rating) VALUES ($trackID, $customerID, $rating)";
        
        if (mysqli_query($conn, $sql)) {
            echo "Rating submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
}
?>

<form action="bought.php" method="get">
    <button type="submit">Back to Purchased Tracks</button>
</form>
