<?php
session_start();
if (isset($_SESSION['ID'])) {
    $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');

$sql = "SELECT * from customer";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Favourite Artists</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Customer details</h1>
    <?php if (mysqli_num_rows($result) > 0){
               echo "<table class='transactions'>";
               echo "<tr>
                      <th>Name</th>
                      <th>ID</th>
                      <th>Email</th>
                      <th>Area</th>
                      <th>Country</th>
                    </tr>";
               while ($row = mysqli_fetch_assoc($result)){ 
                  echo "<tr>
                         <td>" . htmlspecialchars($row['name']) . "</td>
                         <td>" . htmlspecialchars($row['ID']) . "</td>
                         <td>" . htmlspecialchars($row['email']) . "</td>
                         <td>" . htmlspecialchars($row['area']) . "</td>
                         <td>" . htmlspecialchars($row['country']) . "</td>
                         </tr>";

               }
               echo "</table>";
            }


    ?>
</div>
</body>
</html>