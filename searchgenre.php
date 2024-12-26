<!--RAFIA-->
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
        .container {
            background-color: #45a049;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            
            
            border-radius: 8px;
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
       
    </style>
</head>
<body>

<div class="container">
        <h1>Here are the tracks we found</h1>
    </div>

<div class="container_again">


<?php
require_once('DBconnect.php');
if(isset($_POST['search_term'])) {
    $u=$_POST['search_term'];
    $sql="SELECT t.name, t.link, t.trackID from tracks t join genre g on g.genreid=t.genreid where g.name='$u' order by t.name";
    $result =mysqli_query($conn,$sql);
    
    
    
    if (mysqli_num_rows($result) != 0) {
        
        echo "<ul>"; 

        while ($row = mysqli_fetch_assoc($result)) {
            $trackName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $ytLink = htmlspecialchars($row['link'], ENT_QUOTES, 'UTF-8');
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            echo "<li>$trackName - <a href='$ytLink' target='_blank'>Watch preview</a></li>";
            echo"<br>";

            //add to playlist

            echo "<form action='confirming.php' method='POST'>
            <input type='hidden' name='trackID' value='$trackID'>
            <button type='submit'>Add to your playlist</button>
            </form>";

            echo "<br>";

            //add to cart
            echo "<form action='cart.php' method='POST'>
            <input type='hidden' name='trackID' value='$trackID'>
            <button type='submit'>Add to cart</button>
            </form>";

            echo"<br><br>";
        }

        echo "</ul>";

    } else {
        echo "Sorry, we seem to have bo song in this genre.";
    }
}
?>

</div>
</body>
</html>
