<?php
require_once('DBConnect.php');

if (isset($_POST['prices']) && isset($_POST['name'])) {
    $prices = $_POST['prices'];
    $name = $_POST['name'];

   
    $stmt = $conn->prepare("UPDATE tracks SET price = '$prices' WHERE name = '$name'");
    

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            header("Location: Home-admin.php");
            exit(); 
        } else {
            $error_message = "No track found with that name.";
        }
    } else {
        $error_message = "Error updating price: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Price</title>
    <style>
        body {
            font-family: sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f0f0f0;
        }

        .container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="number"] {
            width: calc(100% - 12px); 
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .error-message {
            color: red;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Track Price</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="name">Track Name:</label>
            <input type="text" id="name" name="name" required><br><br>

            <label for="prices">New Price:</label>
            <input type="number" id="prices" name="prices" step="50" required><br><br>

            <input type="submit" value="Update Price">
            <?php
            if (isset($error_message)) { 
                echo '<div class="error-message">' . $error_message . '</div>';
            }
            ?>
        </form>
    </div>
</body>
</html>