<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

if (isset($_POST['trackID']) && isset($_POST['password'])) {
    $trackID = ($_POST['trackID']);
    $password = ($_POST['password']);
    $sql3 = "SELECT * FROM playlist WHERE trackID = '$trackID' AND customerID = '$ID'";
    $result3 = mysqli_query($conn, $sql3);
    echo '<form action="home.php" method="POST"><button type="submit">Back to Home</button></form><br>';



    if ($result3 && mysqli_num_rows($result3) == 0) {
            $sql2 = "INSERT INTO playlist VALUES ('','$trackID', '$ID')";
            $result2 = mysqli_query($conn, $sql2);


            if ($result2) {
                echo "<script>alert('Congratulations! This track has been successfully added to your playlist.');</script>";
            } else {
                echo "<p>Failed to add the song to the playlist. Please try again later.</p>";
            }
    } else {
            echo "<p>This track is already in your playlist.</p>";
        }
} else {
        echo "<p>Invalid password. Please try again.</p>";
}

?>