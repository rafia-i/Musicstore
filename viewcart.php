<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Songs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #333;
            background-color: #f4f4f4;
        }
       
        
        .container_again{
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            box-shadow: 0 2px 4px rgba(2, 128, 52, 0.76);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color:  #f4f4f4;
        }
        .checkout button {
            padding: 0.5rem;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            
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



<div class="container_again">


<?php
require_once('DBconnect.php');


//is cart empty or not
$sql="SELECT t.name, t.trackID, t.artistID, t.price from tracks t join cart c on t.trackID=c.trackID where c.customerID=$ID";
$result=mysqli_query($conn,$sql);


//$totalPrice = 0; 
if (mysqli_num_rows($result) != 0) {
    echo"My cart";
    echo "<form action='' method='POST'>";
    echo "<ul>"; 
    //show my cart
    while ($row = mysqli_fetch_assoc($result)) {
            $trackName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8'); 
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            $artistID= htmlspecialchars($row['artistID'], ENT_QUOTES, 'UTF-8');
            echo "<li><input type='checkbox' name='selectedTracks[]' value='$trackID'> $trackName - $price BDT</li>";
            echo"<br><br>";
            
        }
        echo "<div class='checkoutOrDelete'>
                 
                 <button type='submit' name='delete'>Delete Selected Items</button><br><br>
                 <button type='submit' name='checkout'>Checkout</button></div>

                 </form>";

        echo "</ul>";
        

    }else {
        echo "Your cart is empty :(";
    }

?>
</div>


<?php 
//delete
if (isset($_POST['delete'])) {
    if (isset($_POST['selectedTracks']) && !empty($_POST['selectedTracks'])) {
        $selectedTracks = $_POST['selectedTracks'];

        foreach ($selectedTracks as $trackID) {
            $deleteQuery = "DELETE FROM cart WHERE trackID=$trackID AND customerID=$ID";
            mysqli_query($conn, $deleteQuery);
        }
        if(mysqli_affected_rows($conn) > 0) {
            //echo"<script>alert('items have been deleted succesfully.');</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    }else {
        echo "<script>alert('No items selected for deletion');</script>";
}
}


if (isset($_POST['checkout'])) {
    if (isset($_POST['selectedTracks']) && !empty($_POST['selectedTracks'])) {
        $selectedTracks = $_POST['selectedTracks'];

        $trackIDs = implode(',', $selectedTracks);
        header("Location: payment.php?tracks=" . urlencode($trackIDs));
        exit;
    }else {
        //echo"no items selected for checkout";
        echo"<script>alert('No items selected for checkout');</script>";
    }
}
?>

<div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>
</body>
</html>