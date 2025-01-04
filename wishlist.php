<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');
if(isset($_POST['wishlist']) && isset($_POST['trackID'])) {
    $w=$_POST['wishlist'];
    $trackID= $_POST['trackID'];

    //query for already in wishlist
    
    $sql0 = "SELECT COUNT(*) as count FROM wishlist WHERE customerID = $ID AND trackID = $trackID";
    $r=mysqli_query($conn, $sql0);
    $row = mysqli_fetch_assoc($r);

    if ($row['count'] > 0) {  
        //checking wishlist 
        //echo"$ID, $row[count], $trackID";    
        echo"This track is already added to your wishlist";
        echo '<p><a href="viewwishlist.php">View your wishlist</a></p>';

    } 
    else{

    //inserting into wishlist
    $sql= "INSERT INTO wishlist (wishlistID, trackID, customerID) VALUES ('', $trackID, $ID)";
    $result =mysqli_query($conn,$sql);

    if (mysqli_affected_rows($conn)>0) {
        echo "Congratulations!This track is successfully added to your wishlist!";
        echo '<p><a href="viewwishlist.php">View your wishlist</a></p>';

    } else {
        echo "<p>Failed to add song to cart.</p>";
    }
}

}   

?>