<!--NAFEE-->
<?php 

session_start();
if (isset($_SESSION['ID'])) {
  $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

//RAFIA
//update in session table remove id
$sql="DELETE FROM session WHERE customerID='$ID'";
$result = mysqli_query($conn, $sql);

session_unset();
header('location: index.php');

?>