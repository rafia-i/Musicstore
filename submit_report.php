<?php
session_start();

// Check if session ID is set
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
    //echo "Session ID: $ID"; // Debugging output
}


require_once('DBConnect.php');
if (isset($_POST['report_type'])) {
    $report = $_POST['report_type'];
    $currentDateTime = date('Y-m-d H:i:s'); // Correct datetime format
    $description = mysqli_real_escape_string($conn, $_POST['report_description']);

    if ($report == "Bug") {
        $sql = "INSERT INTO report VALUES ('', $ID, '$description', '$currentDateTime', 'Bug')";
        if (mysqli_query($conn, $sql)) {
            echo "Bug report submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif ($report == "Violation") {
        $sql = "INSERT INTO report VALUES ('', $ID, '$description', '$currentDateTime', 'Violation')";
        if (mysqli_query($conn, $sql)) {
            echo "Violation report submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
?>