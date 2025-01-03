<!--RAFIA-->
<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['trackIDs'], $_POST['paymentMethod'], $_POST['password'])) {
        $trackIDs = explode(',', $_POST['trackIDs']); // Array of track IDs
        $paymentMethod = $_POST['paymentMethod'];
        $password = $_POST['password'];

        //pass of cutomerid
        $sql = "SELECT password FROM customer WHERE ID = $ID";
        $result = mysqli_query($conn, $sql);

        //check if right pass
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $dbPassword = $row['password'];

            if ($password === $dbPassword) {
                // Password matches, proceed with the payment and insert data into the database
                $date = date('Y-m-d');
                $totalPrice = 0;
                $boughtTracks=[];
                //$quantity = count($trackIDs);
                

                foreach ($trackIDs as $trackID) {                    
                    $sql = "SELECT price, name, artistID, genreID FROM tracks WHERE trackID = $trackID";
                    $trackResult = mysqli_query($conn, $sql);
                    if($trackRow = mysqli_fetch_assoc($trackResult)) {
                        $price = $trackRow['price'];
                        $artistID = $trackRow['artistID'];
                        $genreID= $trackRow['genreID'];
                        $trackname= $trackRow['name'];
                        $boughtTracks[]= $trackRow['name'];
                        $totalPrice += $price;
                        //foreach ($trackIDs as $trackID) {

                            $sql = "SELECT price, artistID FROM tracks WHERE trackID = $trackID";


                            $trackResult = mysqli_query($conn, $sql);
                            while ($Row = mysqli_fetch_assoc($trackResult)){
                                $price = $Row['price'];
                                $artistID = $Row['artistID'];
                                //$totalPrice += $price;
                                //inserting into invoice table
                                $insertSQL = "INSERT INTO invoice (invoiceID, artistID, customerID, trackID, genreID, date, totalprice, paymentmethod) 
                                              VALUES ('', $artistID, $ID, $trackID, $genreID, '$date',  $price, '$paymentMethod')";
                                mysqli_query($conn, $insertSQL);
                                //removing from cart because purchasing
                                $removesql="DELETE FROM CART where trackID=$trackID and customerID=$ID";
                                mysqli_query($conn, $removesql);

                                //NAFEE-updating points
                                $pointsql="UPDATE customer SET points=$price/10 WHERE ID=$ID";
                                $pointsrun=mysqli_query($conn, $pointsql);
                            }

                            
                            
                        
                    }

                }
                

                //display invoice
                echo "
                <html lang='en'>
                <head>
                    <meta charset='UTF-8'>
                    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                    <title>Invoice</title>
                    <style>
                        body {
                            font-family: Arial, sans-serif;
                            background-color: #f4f4f4;
                            margin: 0;
                            padding: 0;
                            color: #333;
                        }
                        .invoice-container {
                            max-width: 800px;
                            margin: 50px auto;
                            background: #fff;
                            padding: 20px;
                            border-radius: 8px;
                            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
                        }
                        h1 {
                            text-align: center;
                            color: #4CAF50;
                        }
                        .invoice-details, .tracks-list {
                            margin-top: 20px;
                            padding: 10px;
                            background-color: #f9f9f9;
                            border-radius: 5px;
                        }
                        .invoice-details p, .tracks-list p {
                            margin: 5px 0;
                        }
                        .tracks-list ul {
                            list-style: none;
                            padding-left: 0;
                        }
                        .tracks-list li {
                            padding: 8px;
                            border-bottom: 1px solid #ddd;
                        }
                        .total-price {
                            font-size: 1.2em;
                            font-weight: bold;
                            color: #e53935;
                        }
                        .footer {
                            text-align: center;
                            margin-top: 30px;
                            font-size: 0.9em;
                            color: #888;
                        }
                        .btn-container {
                            text-align: center;
                            margin-top: 20px;
                            
                        }
                        .back-button {
                            background-color: #4CAF50; /* Green */
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
                            background-color: #45a049; /* Darker green */
                        }

                        .btn-container2 {
                            text-align: center;
                            margin-top: 20px;

                        }
                        .go-button {
                            background-color: #4CAF50; /* Green */
                            color: white;
                            padding: 10px 20px;
                            font-size: 16px;
                            border: none;
                            border-radius: 5px;
                            cursor: pointer;
                            text-align: center;
                            text-decoration: none;
                        }
                        .go-button:hover {
                            background-color: #45a049; /* Darker green */
                        }
                    </style>
                    </head>
                    <body>
                    <div class='invoice-container'>
                        <h1>Invoice</h1>
                        <div class='invoice-details'>
                            
                            <p><strong>Date:</strong> $date</p>
                            <p><strong>Payment Method:</strong> $paymentMethod</p>
                            
                        </div>

                        <div class='tracks-list'>
                            <h2>Selected Tracks:</h2>
                            <ul>";
                
                    foreach ($boughtTracks as $b) {
                    
                        echo "<li>$b</li>";
                    }

                    echo "</ul></div>";

                    echo "
                        <div class='total-price'>
                            <p>Total Price: $totalPrice BDT</p>
                        </div>
                        <div class='footer'>
                            <p>Thank you for your purchase!</p>
                        </div>
                    </div>

                    <div class='btn-container'>
                    <form action='home.php' method='POST'>
                    <button class='back-button' type='submit'>Back to home</button>
                    </form></div>

                    <div class='btn-container2'>
                    <form action='bought.php' method='POST'>
                    <button class='go-button' type='submit'>See all the tracks that you bought</button>
                    </form></div>



                    </body>
                    </html>";
            

            } else {
                // Password is incorrect
                echo "<p style='color: red;'>Incorrect password. Payment not processed.</p>";
            }
        } else {
            // Customer not found
            echo "<p style='color: red;'>Customer not found. Payment not processed.</p>";
        
        }
    } else {
        echo "<p style='color: red;'>Invalid data. Payment not processed.</p>";
    }
}
?>
                
