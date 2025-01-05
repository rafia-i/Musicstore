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
        a {
        color:rgb(25, 210, 118);
        text-decoration: none;
        font-weight: bold;
        transition: color 0.3s ease;
        }

        a:hover {
        color:rgb(13, 161, 67);
        text-decoration: underline;
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

        button {
        background-color:rgb(22, 154, 112);
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 5px 10px;
        font-size: 13px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        }

       button:hover {
       background-color:rgb(6, 120, 21);
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
    $sql="SELECT t.name, t.link, t.trackID, t.price, a.name as artistName from tracks t join genre g on g.genreid=t.genreid
    join artist a on t.artistID=a.artistID 
    where g.name='$u' and t.composed_date<=NOW() order by t.name";
    $result =mysqli_query($conn,$sql);
    
    
    
    if (mysqli_num_rows($result) != 0) {
        
        echo "<ul>"; 

        while ($row = mysqli_fetch_assoc($result)) {
            $trackName = htmlspecialchars($row['name'], ENT_QUOTES, 'UTF-8');
            $artistName = htmlspecialchars($row['artistName'], ENT_QUOTES, 'UTF-8');
            $ytLink = htmlspecialchars($row['link'], ENT_QUOTES, 'UTF-8');
            $trackID = htmlspecialchars($row['trackID'], ENT_QUOTES, 'UTF-8');
            $price = htmlspecialchars($row['price'], ENT_QUOTES, 'UTF-8');
            echo "<li><b>$trackName</b> -by $artistName (BDT $price ) <br><br> <a href='$ytLink' target='_blank'>Watch preview</a></li>";
            echo"<br>";

            //add to playlist

            //echo "<form action='confirming.php' method='POST'>
            //<input type='hidden' name='trackID' value='$trackID'>
            //<button type='submit'>Add to your playlist</button>
            //</form>";

            //echo "<br>";

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
<div class='btn-container'>
    <form action='home.php' method='POST'>
    <button class='back-button' type='submit'>Back to home</button>
    </form></div>

</div>
</body>
</html>
