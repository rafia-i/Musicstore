<?php
if (isset($_POST['artistID'])) {
    $v = $_POST['artistID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remove Artist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
        }
        label {
            font-weight: bold;
            display: block;
            margin-bottom: 10px;
        }
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            display: block;
            width: 100%;
            text-align: center;
        }
        button:hover {
            background-color: #c0392b;
        }
        .alert {
            text-align: center;
            font-size: 16px;
            color: #555;
            margin-bottom: 20px;
        }
    </style>
    <script>
        alert('Are you sure you want to remove the artist from your favourites?');
    </script>
    
</head>
<body>
    <div class="container">
        <h1>Remove Artist</h1>
        <div class="alert">Please verify your password to proceed.</div>
        <form action="remove-artist.php" method="POST">
            <input type="password" id="password" name="password" placeholder="Enter your password" required>
            <input type="hidden" name="artistID" value="<?php echo htmlspecialchars($v, ENT_QUOTES, 'UTF-8'); ?>">
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>