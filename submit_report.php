<?php
session_start();

if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];

}


require_once('DBConnect.php');
if (isset($_POST['report'])) {
    $report = $_POST['report'];
    $currentDateTime = date('Y-m-d H:i:s'); 
    $description = mysqli_real_escape_string($conn, $_POST['report_description']);
    echo '<form action="home.php" method="POST"><button type="submit">Back to Home</button></form><br>';


    if ($report == "Bug") {
        $sql = "INSERT INTO report VALUES ('', $ID, '$description', '$currentDateTime', 'Bug',NUll)";
        if (mysqli_query($conn, $sql)) {
            echo "Bug report submitted successfully!";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}
if (isset($_POST['trackID'])) {
    $track_id=$_POST['trackID'];
    $currentDateTime = date('Y-m-d H:i:s'); 
    $description = mysqli_real_escape_string($conn, $_POST['Report']);
    $sql = "INSERT INTO report VALUES ('', $ID, '$description', '$currentDateTime', 'Inappropriate_content',$track_id)";
    echo '<form action="home.php" method="POST"><button type="submit">Back to Home</button></form><br>';


    if (mysqli_query($conn, $sql)) {
            echo "Report submitted successfully!";

     } else {
            echo "Error: " . mysqli_error($conn);
     }


}


?>


