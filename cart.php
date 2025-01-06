<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}

//echo "User ID: " . $ID;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Track</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 300;
            padding: 20px;
            height: 100vh;
            
            margin: 20px; 

        }
        .container {
            margin: 0 auto;
            max-width: 400px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            text-align: center;
        }
        .viewcart-btn {
    background-color:rgb(10, 125, 44); 
    color: #fff; 
    border: none; 
    padding: 10px 20px; 
    font-size: 16px;
    border-radius: 5px; 
    cursor: pointer; 
    transition: background-color 0.3s ease; 
}

.viewcart-btn:hover {
    background-color:rgb(6, 82, 29); 
}



    </style>

    </head>
<body>
<div class="container">
<?php 
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
            echo"Track is already added to cart ";
            echo"<br><br>";
            echo"<form action='viewcart.php' method='post'>
        <button type='submit' class='viewcart-btn'>View your cart</button>
    </form>";

    } else if($roww['count'] > 0){
        //check if already bought
        echo"You already bought this track :) ";
        echo"<br><br>";
        echo"<form action='bought.php' method='post'>
        <button type='submit' class='viewcart-btn'>View your purchased tracks</button>
    </form>";

    }
    else{

        $sql="INSERT INTO cart VALUES('','$u','$ID')";

        $result2 = mysqli_query($conn, $sql);

        if (mysqli_affected_rows($conn)>0) {
            echo "Congratulations!This track is successfully added to your cart! ";
            echo"<br><br>";
            echo"<form action='viewcart.php' method='post'>
        <button type='submit' class='viewcart-btn'>View your cart</button>
    </form>";
    
           

        } else {
            echo "<p>Failed to add song to cart.</p>";
        }
    }
    
}   

?>
</div>
</body>
</html>


