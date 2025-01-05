<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wishlist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 20px;
            
        }
       /* .message {
            background-color: #e8f5e9;
            border: 1px solidrgb(233, 242, 233);
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }*/
        .error {
            background-color: #ffebee;
            border: 1px solid #ef9a9a;
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 5px;
        }
        a {
            color:rgb(53, 168, 21);
            text-decoration: none;
            font-weight: bold;
        }
        a:hover {
            text-decoration: underline;
        }
        .container {
            text-align: center;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        .btn-container {
            text-align: center;
            margin-top: 20px;
                            
        }
        .back-button {
        background-color: #4CAF50; 
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        }
        .back-button:hover {
        background-color: #45a049; 
        }
    </style>
</head>
<body>
<div class="container">
<?php 
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
<div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>
</div>
</body>
</html>