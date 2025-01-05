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
    <title>Document</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #333;
        }

        .container {
            margin: 2rem auto;
            padding: 1rem;
            width: 90%;
            max-width: 600px;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
        }

        .container h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            text-align: center;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            background-color: #e9f5e9;
            margin: 0.5rem 0;
            padding: 0.8rem;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border: 1px solid #d4e9d4;
        }

        

        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9rem;
        }

        button:hover {
            background-color: #45a049;
        }

        .message {
            text-align: center;
            font-size: 1rem;
            color: #666;
            margin-top: 1rem;
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

    
    </style>
</head>
<body>
    
        <?php
        //upcoming tracks 
        $sql="SELECT t.trackID, t.name as track_name, t.composed_date, a.name as artist_name from tracks t join artist a on t.artistId=a.artistID join favourites f on a.artistID=f.artistID 
        where f.customerID= $ID and t.composed_date>Now() order by t.composed_date asc";

        $result=mysqli_query($conn,$sql);
        if (mysqli_num_rows($result) == 0) {
            echo"Sorry, no upcoming releases have been listed of your favourite artists :(";
        }else{
            echo"<div class='container'>";
           // echo "<form action='wishlist.php' method='POST'>";
            echo"Upcoming releases of your fav artists:";
            echo"<ul>";

            while($row=mysqli_fetch_assoc($result)){

                $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
                $trackName = htmlspecialchars($row['track_name'], ENT_QUOTES, 'UTF-8');
                $artistName = htmlspecialchars($row['artist_name'], ENT_QUOTES, 'UTF-8');
                $composedDate = htmlspecialchars($row['composed_date'], ENT_QUOTES, 'UTF-8');

                //difference between current and release date
                date_default_timezone_set('Asia/Dhaka');
                $currentDate = new DateTime();
                $releaseDate = new DateTime($composedDate);

                $currentDate->setTime(0, 0, 0);
                $releaseDate->setTime(0, 0, 0);

                $interval = $currentDate->diff($releaseDate);
                $releasingIn = "";

                //if ($currentDate->format('Y-m-d') === $releaseDate->format('Y-m-d')) {
                    // If the release date is today
                    //$releasingIn = "today";

                    
                    if ($currentDate < $releaseDate) {
                        if ($interval->m > 0) {
                            $releasingIn = $interval->m . " month/s";
                        } elseif ($interval->d > 0) {
                            $releasingIn = $interval->d . " day/s";
                        }
                    }
            
                    // Skip tracks with invalid intervals
                    if (empty($releasingIn)) {
                        continue;
                    }
                echo "<form action='wishlist.php' method='POST'>";
                echo"<li><strong>$artistName- $trackName</strong><span>(releasing in  $releasingIn ) </span></li>";
                echo"<button type='submit' name=wishlist value='$trackID'>Add to wishlist</button>";
                echo"<input type='hidden' name='trackID' value='$trackID'>";
                echo"<br><br>";
                echo "</form>";
            }
            echo "</ul>";
            echo"</div>";

           echo" <div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>";
            echo"<footer>Tracks added to your wishlist will automatically transfer to your cart after being released :)</footer>";
        }
        
        
    

?>
</body>
</html>