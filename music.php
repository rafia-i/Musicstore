<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');


if (isset($_POST['trackID']) && isset($_POST['password'])) {
    $trackID = $_POST['trackID'];
    $password = $_POST['password'];
    $sql1="SELECT ID FROM customer where password like'%$password%'";
    $result1=mysqli_query($conn,$sql1);
    if (mysqli_num_rows($result1) != 0) {
        echo '<form action="home.php" method="POST"><button type="submit">Back to Home</button></form><br>';

        while ($row = mysqli_fetch_assoc($result1)) {
            $customer_id = htmlspecialchars($row['ID'], ENT_QUOTES, 'UTF-8');

        }



    $sql2 = "INSERT INTO playlist VALUES('','$trackID','$ID')";
    $result2 = mysqli_query($conn, $sql2);

    if (mysqli_affected_rows($conn)) {
        echo " <script>alert('Congratulations!This track is successfully added to your playlist');</script>";
    } else {
            echo "<p>Failed to add song to playlist.</p>";
    }
    }
}
?>