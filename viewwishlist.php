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
    <title>Search Songs</title>
    <style>
    
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 0;
        padding: 0;
    }

    .container_again {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        padding: 15px;
        margin-bottom: 10px;
        background-color:rgb(169, 239, 167);
        border-radius: 8px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        font-size: 1rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    li span {
        font-style: italic;
        color: #555;
    }

    strong {
        color: #333;
    }

    form {
        display: flex;
        flex-direction: column;
    }
/*
    button {
        background-color: #4CAF50;
        color: white;
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 1rem;
    }

    button:hover {
        background-color: #45a049;
    }*/

    .wishlist-empty {
        text-align: center;
        color: #777;
        font-size: 1.2rem;
    }
    footer {
        position: absolute;
        bottom: 10px;
        left: 50%;
        transform: translateX(-50%);
        font-size: 1rem;
        color: #777;
        background-color: #fff;
        padding: 10px;
        text-align: center;
        width: 90%; 
        border-radius: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    .btn-container {
            text-align: center;
            margin-top: 20px;
                            
        }
        .back-button {
        background-color:#f4f4f4;
        color: green;
        padding: 5px 10px;
        font-size: 16px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        text-align: center;
        text-decoration: none;
        
        }
        .back-button:hover {
        background-color:#f4f4f4;
        }
        
    
    .Delete button {
    background-color:rgba(170, 23, 13, 0.95); 
    color: white; /* White text */
    font-size: 12px; /* Size of the text */
    
}
</style>

   
</head>
<body>



<div class="container_again">


<?php



//is wishlist empty or not
$sql="SELECT t.name as track_name, t.trackID, t.composed_date, a.artistID, a.name as artist_name ,t.price, c.ID 
     from wishlist w join tracks t on t.trackID=w.trackID join customer c on w.customerID=c.ID join artist a on a.artistID=t.artistID where c.ID=$ID
     order by t.composed_date asc"; 
$result=mysqli_query($conn,$sql);


if (mysqli_num_rows($result) != 0) {
    echo"My wishlist";
    echo "<form action='' method='POST'>";
    echo "<ul>"; 
    //show my cart
    while ($row = mysqli_fetch_assoc($result)) {
            $trackName = htmlspecialchars($row['track_name'], ENT_QUOTES, 'UTF-8'); 
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            $artistName= htmlspecialchars($row['artist_name'], ENT_QUOTES, 'UTF-8');
            $composedDate = htmlspecialchars($row['composed_date'], ENT_QUOTES, 'UTF-8');

            //difference between current and release date
            date_default_timezone_set('Asia/Dhaka');
            $currentDate = new DateTime();
            $releaseDate = new DateTime($composedDate);

            $currentDate->setTime(0, 0, 0);
            $releaseDate->setTime(0, 0, 0);
            $interval = $currentDate->diff($releaseDate);

            if ($currentDate==$releaseDate) {
                // If the date is today, shift track from wishlist cart

                //remove from wishlist
                $removesql="DELETE FROM wishlist where trackID=$trackID and customerID=$ID";
                mysqli_query($conn, $removesql);

                //add to cart
                $insertSQL = "INSERT INTO cart (cartID, trackID, customerID) 
                            VALUES ('', $trackID, $ID)";
                mysqli_query($conn, $insertSQL);

                //show updated wishlist after refreshing
                header("Refresh:5");



                
            } else {
                if ($interval->m > 0) {
                    $releasingIn = $interval->m . " month/s";
                } elseif ($interval->d > 0) {
                    $releasingIn = $interval->d . " day/s" ;
                }
                //show the wishlist
                echo"<li><strong>$artistName- $trackName</strong><span>(releasing in $releasingIn) </span></li>";
                echo"<form action='' method='POST'>";
                echo "<div class='Delete'>        
                 <button type='submit' name='delete'>Remove from wishlist</button><br><br>
                 <input type='hidden' name='trackID' value='$trackID'>

                 </form>";
                echo"<br><br>";
            }


            
            
        }
        echo "</form>";

        echo "</ul>";
        echo"</div>";
        echo"<footer>Tracks added to your wishlist will automatically transfer to your cart after being released :)</footer>";
        

    }else {
        echo "Your wishlist is empty :(";
    }
    
//delete
if (isset($_POST['delete'])) {
    if (isset($_POST['trackID'])) {
        $trackID = $_POST['trackID'];

        
        $deleteQuery = "DELETE FROM wishlist WHERE trackID=$trackID AND customerID=$ID";
        mysqli_query($conn, $deleteQuery);
        
        if(mysqli_affected_rows($conn) > 0) {
            //echo"<script>alert('items have been deleted succesfully.');</script>";
            header("Location: " . $_SERVER['PHP_SELF']);
        }
    }
    
}
?>
<div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>
</body>
</html>