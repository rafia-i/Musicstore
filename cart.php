<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}


//echo "User ID: " . $ID;

require_once('DBconnect.php');
$u = ""; 

if (isset($_POST['trackID'])) {
    $u = $_POST['trackID'];

    //query for already in cart
    
    $sql0 = "SELECT COUNT(*) as count FROM cart WHERE customerID = $ID AND trackID = $u";
    $r=mysqli_query($conn, $sql0);
    $row = mysqli_fetch_assoc($r);

    //query for already bought
    $sql1 = "SELECT COUNT(*) as count FROM invoice WHERE customerID = $ID AND trackID = $u";
    $res=mysqli_query($conn, $sql1);
    $roww = mysqli_fetch_assoc($res);

    if ($row['count'] > 0) {  
            //checking cart     
            echo"Track is already added to cart";

    } else if($roww['count'] > 0){
        //check if already bought
        echo"You already bought this track :)";

    }
    else{

        $sql="INSERT INTO cart VALUES('','$u','$ID')";

        $result2 = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn)>0) {
            echo "Congratulations!This track is successfully added to your cart!";
            echo '<p><a href="viewcart.php">View your cart</a></p>';

        } else {
            echo "<p>Failed to add song to cart.</p>";
        }
    }
    
}   

?>


