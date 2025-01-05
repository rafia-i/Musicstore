<!--YAKUB-->
<?php
session_start();
require_once('DBconnect.php');

if (isset($_SESSION['ID']) && isset($_POST['trackID']) && isset($_POST['comment'])) {
    $customerID = $_SESSION['ID'];
    $trackID = $_POST['trackID'];
    $comment = $_POST['comment'];

    if (!empty($comment)) {
        $sql = "INSERT INTO comment (trackID, customerID, comment, date) VALUES ($trackID, $customerID, '$comment', NOW())";
        if (mysqli_query($conn, $sql)) {
            header("Location: bought.php");
            exit();
        } else {
            echo "Error: Could not execute the query.";
        }
    } else {
        echo "Comment cannot be empty.";
    }
} else {
    echo "Invalid input. Please try again.";
}

mysqli_close($conn);
?>
