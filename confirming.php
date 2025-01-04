<?php
session_start();
if (isset($_SESSION['ID'])) {
   $ID = $_SESSION['ID'];
}
require_once('DBconnect.php');
$u = ""; 

if (isset($_POST['trackID'])) {
    $u = $_POST['trackID'];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Track</title>
    <script>
        alert('Are you sure you want to continue?');
    </script>
</head>
<body>
    <form action="music.php" method="POST">
        <label for="password">Password</label><br>
        <input type="password" id="password" name="password" placeholder="Enter your password" required><br><br>

        <input type="hidden" name="trackID" value="<?php echo htmlspecialchars($u, ENT_QUOTES, 'UTF-8'); ?>">

        <button type="submit">Submit</button>
    </form>
</body>
</html>